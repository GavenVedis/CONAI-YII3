<?php

use App\Model\Repository\Guest\CasiSuccesso;
use App\Model\Repository\Guest\DatiLeve;
use App\Model\Repository\Guest\StatisticheGuest;
use App\Model\Repository\Main\Aziende;
use App\Model\Repository\Main\Utenti;
use App\Model\Repository\Main\UtentiDossier;
use Yiisoft\Definitions\Reference;

return [
    UtentiDossier::class => [
        'class' => UtentiDossier::class,
        '__construct()' => [
            'db' => Reference::to('db.conai'),
        ],
    ],

    Aziende::class => [
        'class' => Aziende::class,
        '__construct()' => [
            'db' => Reference::to('db.conai'),
        ],
    ],

    Utenti::class => [
        'class' => Utenti::class,
        '__construct()' => [
            'db' => Reference::to('db.conai'),
        ],
    ],

    DatiLeve::class => [
        'class' => DatiLeve::class,
        '__construct()' => [
            'db' => Reference::to('db.conai_guest'),
        ],
    ],

    CasiSuccesso::class => [
        'class' => CasiSuccesso::class,
        '__construct()' => [
            'db' => Reference::to('db.conai_guest'),
        ],
    ],

    StatisticheGuest::class => [
        'class' => StatisticheGuest::class,
        '__construct()' => [
            'db' => Reference::to('db.conai_guest'),
        ],
    ],
];
