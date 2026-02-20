<?php

declare(strict_types=1);

use App\ApplicationParams;
use App\Utility\UtilityFaseTwo;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Db\Mysql\Dsn;
use Yiisoft\Definitions\Reference;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\User\CurrentUser;
use Yiisoft\Yii\View\Renderer\CsrfViewInjection;

return [
    'application' => require __DIR__ . '/application.php',

    'yiisoft/aliases' => [
        'aliases' => require __DIR__ . '/aliases.php',
    ],

    'yiisoft/session' => [
        'session' => [
            'options' => [
                'cookie_secure' => 0,
            ],
            'handler' => null,
        ]
    ],

    'yiisoft/view' => [
        'basePath' => null,
        'parameters' => [
            'assetManager' => Reference::to(AssetManager::class),
            'applicationParams' => Reference::to(ApplicationParams::class),
            'aliases' => Reference::to(Aliases::class),
            'urlGenerator' => Reference::to(UrlGeneratorInterface::class),
            'currentRoute' => Reference::to(CurrentRoute::class),
            'currentUser' => Reference::to(CurrentUser::class),
            'utilityFaseTwo' => Reference::to(UtilityFaseTwo::class)
        ],
    ],

    'yiisoft/yii-view-renderer' => [
        'viewPath' => null,
        'layout' => '@src/Layout/Conai/layout.php',
        'injections' => [
            Reference::to(CsrfViewInjection::class),
        ],
        'aliases' => Reference::to(Aliases::class),
    ],

    'db.conai' => [
        'dsn' => new Dsn('mysql', getenv('DB_HOST'), getenv('DB_NAME'), '3306', ['charset' => 'utf8mb4']),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
    ],

    'db.conai_guest' => [
        'dsn' => new Dsn('mysql', getenv('DB_HOST'), getenv('DB_GUEST_NAME'), '3306', ['charset' => 'utf8mb4']),
        'username' => getenv('DB_GUEST_USERNAME'),
        'password' => getenv('DB_GUEST_PASSWORD'),
    ],

    'mailer' => [
        'user' => 'noreply@ecotoolconai.org',
        'psw' => 'koLn!sa5k%k19q#G',
        'host' => 'authsmtp.securemail.pro',
        'port' => '465',
        'encr' => 'ssl'
    ]
];
