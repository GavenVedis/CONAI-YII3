<?php

declare(strict_types=1);

use App\ApplicationParams;
use App\User\IdentityRepository;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\Definitions\Reference;
use Yiisoft\Session\Session;
use Yiisoft\Session\SessionInterface;
use Yiisoft\User\CurrentUser;

/** @var array $params */

return [
    ApplicationParams::class => [
        '__construct()' => $params['application'],
    ],
    IdentityRepositoryInterface::class => IdentityRepository::class,
    CurrentUser::class => [
        'withSession()' => [Reference::to(SessionInterface::class)]
    ],
];
