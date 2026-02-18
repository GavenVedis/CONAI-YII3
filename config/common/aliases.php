<?php

declare(strict_types=1);

return [
    '@root' => dirname(__DIR__, 2),
    '@src' => '@root/src',
    '@view' => '@src/View',
    '@assets' => '@root/public/assets',
    '@assetsUrl' => '@baseUrl/assets',
    '@assetsSource' => '@root/assets',
    '@baseUrl' => '/',
    '@public' => '@root/public',
    '@runtime' => '@root/runtime',
    '@vendor' => '@root/vendor',
    '@uploadDestination' => '@baseUrl/uploads'
];
