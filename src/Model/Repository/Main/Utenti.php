<?php
namespace App\Model\Repository\Main;

use App\Model\Entity\Main\UtentiDTO;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Exception\Exception;
use Yiisoft\Db\Query\Query;

class Utenti
{
    public function __construct(
        private ConnectionInterface $db
    ) {}


    public function findByUsername(string $username): ?UtentiDTO
    {
        $utente = (new Query($this->db))
            ->from('Utenti')
            ->where(['user' => $username])
            ->one();

        return $utente ? UtentiDTO::fromRow($utente) : null;
    }

    public function setPassword(int $utente_id, string $encPass): bool
    {
        try {
            $this->db->createCommand()
                ->update('Utenti', ['password' => $encPass], ['utente_id' => $utente_id])
                ->execute();
            return true;
        } catch (Exception|\Throwable $e) {
            return false;
        }
    }
}
