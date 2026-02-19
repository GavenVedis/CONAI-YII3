<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class GenericController
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private Aliases $aliases
    ) {
    }

    public function ecopacking(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        return $this->viewRenderer->render($this->aliases->get('@view/Pages/ecopacking'), []);
    }

    public function glossary(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        return $this->viewRenderer->render($this->aliases->get('@view/Pages/glossary'), []);
    }

    public function contact(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        return $this->viewRenderer->render($this->aliases->get('@view/Pages/contact'), []);
    }

}
