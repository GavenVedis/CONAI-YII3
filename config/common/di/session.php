<?php
use Yiisoft\Db\Mysql\Connection as MysqlConnection;
use Yiisoft\Db\Mysql\Driver;
use Yiisoft\Session\Session;
use Yiisoft\Session\SessionInterface;

/** @var array $params */

return [
    SessionInterface::class => [
        'class' => Session::class,
        '__construct()' => [
            'options' => $params['yiisoft/session']['session']['options'],
            'handler' => $params['yiisoft/session']['session']['handler'],
        ],
        'reset' => function () {
            $this->sessionId = null;
            $this->close();
        },
    ],

];
