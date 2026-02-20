<?php

use Yiisoft\Mailer\Symfony\Mailer as SymfonyMailer;
use Symfony\Component\Mailer\Transport;

/** @var array $params */

return [
    SymfonyMailer::class => static function () use ($params) {
        $transport = Transport::fromDsn(
            sprintf(
                'smtp://%s:%s@%s:%s?encryption=%s',
                urlencode($params['mailer']['user']),
                urlencode($params['mailer']['psw']),
                $params['mailer']['host'],
                $params['mailer']['port'],
                $params['mailer']['encr']
            )
        );

        return new SymfonyMailer($transport);
    },


];
