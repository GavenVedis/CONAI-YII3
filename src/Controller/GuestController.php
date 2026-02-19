<?php

namespace App\Controller;

use App\ApplicationParams;
use App\Model\Repository\Guest\CasiSuccesso;
use App\Model\Repository\Guest\DatiLeve;
use App\Model\Repository\Guest\StatisticheGuest;
use App\Utility\UtilityFaseTwo;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Safe\Exceptions\UrlException;
use TCPDF;
use Yiisoft\Aliases\Aliases;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\Db\Exception\Exception;
use Yiisoft\Db\Exception\InvalidConfigException;
use Yiisoft\Http\Status;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\User\CurrentUser;
use Yiisoft\View\Exception\ViewNotFoundException;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class GuestController
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private Aliases $aliases,
        private CasiSuccesso $casiSuccesso,
        private ApplicationParams $applicationParams,
        private DatiLeve $datiLeve,
        private ResponseFactoryInterface $responseFactory,
        private StatisticheGuest $statisticheGuest,
        private CurrentUser $currentUser,
        private UtilityFaseTwo $utilityFaseTwo
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @param CurrentRoute $currentRoute
     * @param LoggerInterface $logger
     * @return ResponseInterface
     * @throws UrlException
     * @throws \Throwable
     */
    public function extract(ServerRequestInterface $request, CurrentRoute $currentRoute, LoggerInterface $logger): ResponseInterface {
        $base64 = (string)$currentRoute->getArgument('base64', '');

        if ($base64) {
            $url = \Safe\base64_decode($base64);
            if (str_contains($url, 'guest/successo/')) {
                $id = str_replace('guest/successo/', '', $url);
                if (filter_var($id, FILTER_VALIDATE_INT) !== false) {
                    return $this->renderSuccesso($id);
                }
            }
        }
        $response = $this->responseFactory->createResponse();
        return $response
            ->withStatus(Status::PERMANENT_REDIRECT)
            ->withHeader('Location', $this->applicationParams->domainName);
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function getStatistiche(ServerRequestInterface $request, CurrentRoute $currentRoute, LoggerInterface $logger): ResponseInterface
    {
        $anno = (string)$currentRoute->getArgument('anno', date('Y'));
        $statistiche = $this->statisticheGuest->findByAnno($anno);
        $leve_attivate = [];

        if (!$this->currentUser->isGuest()) {
            if ($this->currentUser->tipo_utente === 'LCE' || $this->currentUser->tipo_utente === 'CON') {
                $leve = json_decode($statistiche->leve_attivate);
                foreach ($leve as $indice => $valore) {
                    if ($valore == 0) continue;
                    $dati_leva = $this->datiLeve->findByIdentificativo($indice);
                    $leve_attivate[] = [
                        'label' => $dati_leva->descrizione,
                        'value' => $valore,
                        'colore' => $dati_leva->colore_legenda
                    ];
                }
            }
        }
        $contatori = [
            ['id' => 0, 'value' => $statistiche->aziende_partecipanti],
            ['id' => 1, 'value' => $statistiche->casi_presentati],
            ['id' => 2, 'value' => $statistiche->casi_premiati],
            ['id' => 3, 'value' => $statistiche->montepremi]
        ];

        $response = $this->responseFactory->createResponse();

        return $this->utilityFaseTwo->responseAsJson($response, [
            'contatore' => $contatori,
            'leve_attivate' => $leve_attivate,
            'benefici' => [
                [
                    'id' => 0,
                    'value' => [
                        'prima' => $statistiche->co2_prima,
                        'dopo' => $statistiche->co2_dopo
                    ],
                ],
                [
                    'id' => 1,
                    'value' => [
                        'prima' => $statistiche->ger_prima,
                        'dopo' => $statistiche->ger_dopo
                    ]
                ],
                [
                    'id' => 2,
                    'value' => [
                        'prima' => $statistiche->h2o_prima,
                        'dopo' => $statistiche->h2o_dopo
                    ]
                ]
            ]
        ]);
    }

    public function statistiche(ServerRequestInterface $request, CurrentRoute $currentRoute, LoggerInterface $logger): ResponseInterface {
        $anni = [];
        list($statistiche, $benefici) = $this->statisticheGuest->getLast($anni);
        $leve_attivate = [];
        $is_admin = false;
        if (!$this->currentUser->isGuest()) {
            if ($this->currentUser->tipo_utente === 'LCE' || $this->currentUser->tipo_utente === 'CON') {
                $is_admin = true;
                $leve = json_decode($statistiche->leve_attivate);
                foreach ($leve as $indice => $valore) {
                    if ($valore == 0) continue;
                    $dati_leva = $this->datiLeve->findByIdentificativo($indice);
                    $leve_attivate[] = [
                        'label' => $dati_leva->descrizione,
                        'value' => $valore,
                        'colore' => $dati_leva->colore_legenda
                    ];
                }
            }
        }
        return $this->viewRenderer->render($this->aliases->get('@view/Guest/statistiche'), [
            'anni' => $anni,
            'aziende_partecipanti' => $statistiche->aziende_partecipanti,
            'casi_presentati' => $statistiche->casi_presentati,
            'casi_premiati' => $statistiche->casi_premiati,
            'casi_incentivati' => $statistiche->casi_incentivati,
            'montepremi' => $statistiche->montepremi,
            'leve_attivate' => $leve_attivate,
            'benefici' => $benefici,
            'is_admin' => $is_admin
        ]);
    }

    public function successi(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        $params = $request->getQueryParams();
        $categoria = $params['categoria'] ?? '';
        $anno_bando = $params['anno_bando'] ?? '';
        $azienda = $params['azienda'] ?? '';
        $materiale = $params['materiale'] ?? '';
        $leve = $params['leve'] ?? '';
        $brand_prodotto = $params['brand_prodotto'] ?? '';
        $results = $this->casiSuccesso->getPages($categoria, $anno_bando, $azienda, $materiale, $leve, $brand_prodotto);
        return $this->viewRenderer->render($this->aliases->get('@view/Guest/successi'), [
            'categorie' => $this->casiSuccesso->getCategorie($categoria, $anno_bando, $azienda, $materiale, $leve, $brand_prodotto),
            'anni_bando' => $this->casiSuccesso->getAnniBando($anno_bando, $categoria, $azienda, $materiale, $leve, $brand_prodotto),
            'aziende' => $this->casiSuccesso->getAziende($azienda, $anno_bando, $categoria, $materiale, $leve, $brand_prodotto),
            'nomi_prodotto' => $this->casiSuccesso->getNomiProdotto($azienda, $anno_bando, $categoria, $materiale, $leve, $brand_prodotto),
            'materiali' => $this->casiSuccesso->getMateriali($materiale, $anno_bando, $azienda, $categoria, $leve, $brand_prodotto),
            'leve' => $this->casiSuccesso->getLeve($leve, $anno_bando, $azienda, $materiale, $categoria, $brand_prodotto),
            'elementi' => $results
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function successo(ServerRequestInterface $request, CurrentRoute $currentRoute, LoggerInterface $logger): ResponseInterface
    {
        $id = (int)$currentRoute->getArgument('id', 34);
        return $this->renderSuccesso($id);
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws ViewNotFoundException
     * @throws Exception
     */
    public function genera_pdf(ServerRequestInterface $request, CurrentRoute $currentRoute, LoggerInterface $logger): ResponseInterface
    {
        $id = (int)$currentRoute->getArgument('id', 34);
        list($caso, $benefici) = $this->casiSuccesso->generaParametriCasoSuccesso($id);
        $html = $this->viewRenderer->renderPartialAsString($this->aliases->get('@view/Guest/_successo_pdf'), [
            'caso' => $caso,
            'benefici' => $benefici ?? [],
            'datiLeve' => $this->datiLeve
        ]);
        $pdf = new TCPDF('L', 'cm', PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor("Ecopack");
        $pdf->SetTitle("Ecopack - Caso di successo - " . $caso->nome_prodotto);
        $pdf->SetSubject("Ecopack - Caso di successo - " . $caso->nome_prodotto);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(1);
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->AddPage();

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->lastPage();
        $pdf->Output($caso->anno . "_" . mb_convert_encoding($caso->nome_prodotto, 'UTF-8', 'ISO-8859-1') . '.pdf', 'D');
        die();
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    private function renderSuccesso(int $id): DataResponse
    {
        list($caso, $benefici) = $this->casiSuccesso->generaParametriCasoSuccesso($id);
        return $this->viewRenderer->render($this->aliases->get('@view/Guest/successo'), [
            'caso' => $caso,
            'share_link' => $this->applicationParams->domainName . "share__" . base64_encode("guest/successo/$id"),
            'benefici' => $benefici ?? [],
            'datiLeve' => $this->datiLeve
        ]);
    }

}
