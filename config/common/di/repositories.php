<?php

use App\Model\Repository\DatiLeve;
use App\Model\Repository\Utenti;
use App\Model\Repository\UtentiDossier;
use App\User\IdentityRepository;
use Yiisoft\Definitions\Reference;

return [
    UtentiDossier::class => [
        'class' => UtentiDossier::class,
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
];
