<?php
namespace App\Model\Repository;

use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Query\Query;

class Utenti
{
    public function __construct(
        private ConnectionInterface $db
    ) {}


    public function findByUsername(string $username): ?array
    {
        return (new Query($this->db))
            ->from('Utenti')
            ->where(['user' => $username])
            ->one();
    }
}
