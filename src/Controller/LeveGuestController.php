<?php

namespace App\Controller;

use App\Model\Repository\Guest\DatiLeve;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class LeveGuestController
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private DatiLeve $datiLeveGuest
    ) {
    }

    public function index(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        $logger->debug('Rendering posts list');
        return $this->viewRenderer->render(__DIR__ . '/Leve/template', ['leve' => $this->datiLeveGuest->findAll()]);
    }


    /*public function actionView(ServerRequestInterface $request): ResponseInterface
    {
        // render a single post
    }*/
}
