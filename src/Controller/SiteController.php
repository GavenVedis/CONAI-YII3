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
        private Aliases $aliases
    ) {
    }

    public function index(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        return $this->viewRenderer
            ->render($this->aliases->get('@view/HomePage/index'), []);
    }

}
