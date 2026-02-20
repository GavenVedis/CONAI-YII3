<?php

declare(strict_types=1);

use App\Controller\DossierController;
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

    /* site controller */
    Route::methods([Method::GET], '/site/ecopacking')
        ->action([GenericController::class, 'ecopacking'])
        ->name('site/ecopacking'),

    Route::methods([Method::GET], '/site/glossary')
        ->action([GenericController::class, 'glossary'])
        ->name('site/glossary'),

    Route::methods([Method::GET], '/site/contact')
        ->action([GenericController::class, 'contact'])
        ->name('site/contact'),

    /* guest controller */
    Route::methods([Method::GET], '/guest/successi')
        ->action([GuestController::class, 'successi'])
        ->name('guest/successi'),

    Route::methods([Method::GET], '/guest/get-statistiche/{anno}')
        ->action([GuestController::class, 'getStatistiche'])
        ->name('guest/get-statistiche'),

    Route::methods([Method::GET], '/guest/statistiche')
        ->action([GuestController::class, 'statistiche'])
        ->name('guest/statistiche'),

    Route::methods([Method::GET], '/guest/successo/{id}')
        ->action([GuestController::class, 'successo'])
        ->name('guest/successo'),

    Route::methods([Method::GET], '/share__{base64}')
        ->action([GuestController::class, 'extract'])
        ->name('guest/extract'),

    Route::methods([Method::GET], '/guest/generaPdf/{id}')
        ->action([GuestController::class, 'genera_pdf'])
        ->name('guest/generaPdf'),

    /* dossier controller */
    Route::methods([Method::GET], '/dossier/index')
        ->action([DossierController::class, 'index'])
        ->name('dossier/index'),

    Route::methods([Method::POST], '/dossier/login')
        ->action([DossierController::class, 'login'])
        ->name('dossier/login'),

    Route::methods([Method::POST], '/dossier/checkUserExistance')
        ->action([DossierController::class, 'checkUserExistance'])
        ->name('dossier/checkUserExistance'),

    Route::methods([Method::POST], '/dossier/send-username')
        ->action([DossierController::class, 'sendUsername'])
        ->name('dossier/send-username'),
];
