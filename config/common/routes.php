<?php

declare(strict_types=1);

use App\Controller\GenericController;
use App\Controller\GuestController;
use App\Controller\SiteController;
use App\Controller\LeveGuestController;
use Yiisoft\Http\Method;
use Yiisoft\Router\Route;

return [
    Route::methods([Method::GET], '/')
        ->action([SiteController::class, 'index'])
        ->name('site/index'),

    Route::methods([Method::GET], '/view/{id}')
        ->action([SiteController::class, 'view'])
        ->name('site/view'),

    Route::methods([Method::GET], '/site/ecopacking')
        ->action([GenericController::class, 'ecopacking'])
        ->name('site/ecopacking'),

    Route::methods([Method::GET], '/site/glossary')
        ->action([GenericController::class, 'glossary'])
        ->name('site/glossary'),

    Route::methods([Method::GET], '/site/contact')
        ->action([GenericController::class, 'contact'])
        ->name('site/contact'),

    Route::methods([Method::GET], '/guest/successi')
        ->action([GuestController::class, 'successi'])
        ->name('guest/successi'),

    Route::methods([Method::GET], '/guest/successo/{id}')
        ->action([GuestController::class, 'successo'])
        ->name('guest/successo'),

    Route::methods([Method::GET], '/leve-guest')
        ->action([LeveGuestController::class, 'index'])
        ->name('guest/leve'),
];
