<?php

namespace App\Controller;

use App\Model\Repository\CasiSuccesso;
use App\Model\Repository\DatiLeve;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class GuestController
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private Aliases $aliases,
        private CasiSuccesso $casiSuccesso
    ) {
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

    public function successo(ServerRequestInterface $request, CurrentRoute $currentRoute, LoggerInterface $logger): ResponseInterface
    {
        $id = $currentRoute->getArgument('id', 34);

        return $this->viewRenderer->render($this->aliases->get('@view/Guest/successo'), [

        ]);
    }


}
