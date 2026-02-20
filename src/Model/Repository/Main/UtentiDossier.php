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

    public function getImmagineProfilo(int $id) {
        $immagine_profilo = (new Query($this->db))
            ->from('utentidossier_foto')
            ->where(['utentedossier_id' => $id])
            ->one();
        return $immagine_profilo ? $immagine_profilo['immagine_profilo'] : null;
    }

    public function findById(int $id): ?UtentiDossierDTO
    {
        $user = (new Query($this->db))
            ->from('UtentiDossier')
            ->where(['utentedossier_id' => $id])
            ->one();
        if ($user) {
            $utenti = (new Query($this->db))
                ->from('Utenti')
                ->where(['user' => $user['username']])
                ->one();
            $azienda = (new Query($this->db))
                ->from('aziende')
                ->where(['id' => $user['id_azienda']])
                ->one();
        }

        return $user ? UtentiDossierDTO::fromRow($user, $utenti ? $utenti['tipo_utente'] : 'USER', $user ? $this->getImmagineProfilo($id) : null, $azienda ?? null) : null;
    }

    public function findByUsername(string $username): ?UtentiDossierDTO
    {
        $user = (new Query($this->db))
            ->from('UtentiDossier')
            ->where(['username' => $username])
            ->one();
        if ($user) {
            $utenti = (new Query($this->db))
                ->from('Utenti')
                ->where(['user' => $username])
                ->one();
            $azienda = (new Query($this->db))
                ->from('aziende')
                ->where(['id' => $user['id_azienda']])
                ->one();
        }
        return $user ? UtentiDossierDTO::fromRow($user, $utenti ? $utenti['tipo_utente'] : 'USER', $user ? $this->getImmagineProfilo($user['utentedossier_id']) : null, $azienda ?? null) : null;
    }

    public function findByEmail(string $mail)
    {
        $user = (new Query($this->db))
            ->from('UtentiDossier')
            ->where(['email' => $mail])
            ->one();
        if ($user) {
            $utenti = (new Query($this->db))
                ->from('Utenti')
                ->where(['user' => $user['username']])
                ->one();
            $azienda = (new Query($this->db))
                ->from('aziende')
                ->where(['id' => $user['id_azienda']])
                ->one();
        }
        return $user ? UtentiDossierDTO::fromRow($user, $utenti ? $utenti['tipo_utente'] : 'USER', $user ? $this->getImmagineProfilo($user['utentedossier_id']) : null, $azienda ?? null) : null;
    }
}
