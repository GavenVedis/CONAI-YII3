<?php
namespace App\Model\Repository\Main;

use App\Model\Entity\Main\UtentiDossierDTO;
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
            ->where(['utentedossier_id' => $id])
            ->one();
    }

    public function findByUsername(string $username): ?UtentiDossierDTO
    {
        $user = (new Query($this->db))
            ->from('UtentiDossier')
            ->where(['username' => $username])
            ->one();
        return $user ? UtentiDossierDTO::fromRow($user) : null;
    }
}
