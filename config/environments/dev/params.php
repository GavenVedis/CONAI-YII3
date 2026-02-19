<?php

declare(strict_types=1);

return [
    'traceLink' => 'phpstorm://open?url=file://{file}&line={line}',
    'yiisoft/session' => [
        'session' => [
            'options' => [
                'cookie_secure' => 0,
                'cookie_lifetime' => 0,
                'gc_maxlifetime' => 3600,
            ],
            'handler' => null,
        ]
    ],
];
