<?php
namespace App\Model\Repository;

use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Query\Query;

class DatiLeve
{
    public function __construct(
        private ConnectionInterface $db
    ) {}

    public function findAll(): array
    {
        return (new Query($this->db))
            ->from('dati_leve')
            ->all();
    }

    public function findById(int $id): ?array
    {
        return (new Query($this->db))
            ->from('dati_leve')
            ->where(['id' => $id])
            ->one();
    }
}
