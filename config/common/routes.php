<?php

declare(strict_types=1);

use App\Controller\HomePageController;
use App\Controller\LeveGuestController;
use Yiisoft\Http\Method;
use Yiisoft\Router\Route;

return [
    Route::methods([Method::GET], '/')
        ->action([HomePageController::class, 'index'])
        ->name('site/index'),
    Route::methods([Method::GET], '/leve-guest')
        ->action([LeveGuestController::class, 'index'])
        ->name('guest/leve'),
];
