<?php
use Yiisoft\Db\Mysql\Connection as MysqlConnection;
use Yiisoft\Db\Mysql\Driver;

/** @var array $params */

return [
    'db.conai' => [
        'class' => MysqlConnection::class,
        '__construct()' => [
            'driver' => new Driver(
                $params['db.conai']['dsn'],
                $params['db.conai']['username'],
                $params['db.conai']['password'],
            ),
        ],
    ],

    'db.conai_guest' => [
        'class' => MysqlConnection::class,
        '__construct()' => [
            'driver' => new Driver(
                $params['db.conai_guest']['dsn'],
                $params['db.conai_guest']['username'],
                $params['db.conai_guest']['password'],
            ),
        ],
    ],


];
