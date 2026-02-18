<?php

declare(strict_types=1);

use App\Controller\GenericController;
use App\Controller\HomePageController;
use App\Controller\LeveGuestController;
use Yiisoft\Http\Method;
use Yiisoft\Router\Route;

return [
    Route::methods([Method::GET], '/')
        ->action([HomePageController::class, 'index'])
        ->name('site/index'),

    Route::methods([Method::GET], '/view/{id}')
        ->action([HomePageController::class, 'view'])
        ->name('site/view'),

    Route::methods([Method::GET], '/site/ecopacking')
        ->action([GenericController::class, 'ecopacking'])
        ->name('site/ecopacking'),

    Route::methods([Method::GET], '/site/glossary')
        ->action([GenericController::class, 'glossary'])
        ->name('site/glossary'),

    Route::methods([Method::GET], '/leve-guest')
        ->action([LeveGuestController::class, 'index'])
        ->name('guest/leve'),
];
