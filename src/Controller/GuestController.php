<?php

namespace App\Controller;

use App\ApplicationParams;
use App\Model\Repository\CasiSuccesso;
use App\Model\Repository\DatiLeve;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Safe\Exceptions\UrlException;
use TCPDF;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Db\Exception\Exception;
use Yiisoft\Db\Exception\InvalidConfigException;
use Yiisoft\Http\Status;
use Yiisoft\Router\CurrentRoute;
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
        private ResponseFactoryInterface $responseFactory
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @param CurrentRoute $currentRoute
     * @param LoggerInterface $logger
     * @return ResponseInterface
     * @throws Exception
     * @throws InvalidConfigException
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
    }

    private function renderSuccesso(int $id): \Yiisoft\DataResponse\DataResponse
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
