<?php
namespace App\Model;

use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Query\Query;

class UtentiDossier
{
    public function __construct(
        private ConnectionInterface $db
    ) {}

    public function findAll(): array
    {
        return (new Query($this->db))
            ->from('UtentiDossier')
            ->all();
    }

    public function findById(int $id): ?array
    {
        return (new Query($this->db))
            ->from('UtentiDossier')
            ->where(['id' => $id])
            ->one();
    }
}
