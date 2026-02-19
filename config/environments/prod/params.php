<?php

declare(strict_types=1);

return [
    'yiisoft/session' => [
        'session' => [
            'options' => [
                'cookie_secure' => 1,
                'cookie_lifetime' => 0,
                'gc_maxlifetime' => 3600,
            ],
            'handler' => null,
        ]
    ],
];
