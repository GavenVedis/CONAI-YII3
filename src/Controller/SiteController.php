<?php

namespace App\Controller;

use App\Model\Repository\Main\UtentiDossier;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class SiteController
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private UtentiDossier $utentiDossier,
        private Aliases $aliases
    ) {
    }

    public function index(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        return $this->viewRenderer
            ->render($this->aliases->get('@view/HomePage/index'), []);
    }


    public function view(ServerRequestInterface $request, CurrentRoute $currentRoute, LoggerInterface $logger): ResponseInterface
    {
        $id = $currentRoute->getArgument('id', 34);
        return $this->viewRenderer->render(__DIR__ . '/HomePage/template', ['users' => $this->utentiDossier->findById($id)]);
    }
}
