<?php

namespace App\Controller;

use App\Model\Repository\UtentiDossier;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class HomePageController
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private UtentiDossier $utentiDossier
    ) {
    }

    public function index(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        $logger->debug('Rendering posts list');
        return $this->viewRenderer
            ->render(__DIR__ . '/HomePage/template', [
                'users' => $this->utentiDossier->findAll()
            ]);
    }


    public function view(ServerRequestInterface $request, CurrentRoute $currentRoute, LoggerInterface $logger): ResponseInterface
    {
        $id = $currentRoute->getArgument('id', 34);
        return $this->viewRenderer->render(__DIR__ . '/HomePage/template', ['users' => $this->utentiDossier->findById($id)]);
    }
}
