<?php

use App\Model\DatiLeve;
use App\Model\UtentiDossier;
use Yiisoft\Definitions\Reference;

return [
    UtentiDossier::class => [
        'class' => UtentiDossier::class,
        '__construct()' => [
            'db' => Reference::to('db.conai'),
        ],
    ],

    DatiLeve::class => [
        'class' => DatiLeve::class,
        '__construct()' => [
            'db' => Reference::to('db.conai_guest'),
        ],
    ]
];
