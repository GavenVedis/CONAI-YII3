<?php
namespace App\Model\Repository\Main;

use App\Model\Entity\Main\UtentiDossierDTO;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Exception\Exception;
use Yiisoft\Db\Exception\InvalidConfigException;
use Yiisoft\Db\Query\Query;

class UtentiDossier
{
    public function __construct(
        private readonly ConnectionInterface $db,
        private readonly Aziende $aziende,
        private readonly Utenti $utenti
    ) {}

    public function findAll(): array
    {
        return (new Query($this->db))
            ->from('UtentiDossier')
            ->all();
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function getImmagineProfilo(int $id) {
        $immagine_profilo = (new Query($this->db))
            ->from('utentidossier_foto')
            ->where(['utentedossier_id' => $id])
            ->one();
        return $immagine_profilo ? $immagine_profilo['immagine_profilo'] : null;
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function findById(int $id): ?UtentiDossierDTO
    {
        $user = (new Query($this->db))
            ->from('UtentiDossier')
            ->where(['utentedossier_id' => $id])
            ->one();
        if (!$user) {
            return null;
        }
        $utenti = $this->utenti->findByUsername($user['username']);
        $azienda = $this->aziende->findById($user['id_azienda']);
        return UtentiDossierDTO::fromRow(
            $user,
            $utenti ? $utenti->tipo_utente : 'USER',
            $this->getImmagineProfilo($user['utentedossier_id']),
            $azienda ?? null);
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function findByUsername(string $username): ?UtentiDossierDTO
    {
        $user = (new Query($this->db))
            ->from('UtentiDossier')
            ->where(['username' => $username])
            ->one();
        if (!$user) {
            return null;
        }
        $utenti = $this->utenti->findByUsername($user['username']);
        $azienda = $this->aziende->findById($user['id_azienda']);
        return UtentiDossierDTO::fromRow(
            $user,
            $utenti ? $utenti->tipo_utente : 'USER',
            $this->getImmagineProfilo($user['utentedossier_id']),
            $azienda ?? null);
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function findByEmail(string $mail)
    {
        $user = (new Query($this->db))
            ->from('UtentiDossier')
            ->where(['email' => $mail])
            ->one();
        if (!$user) {
            return null;
        }
        $utenti = $this->utenti->findByUsername($user['username']);
        $azienda = $this->aziende->findById($user['id_azienda']);
        return UtentiDossierDTO::fromRow(
            $user,
            $utenti ? $utenti->tipo_utente : 'USER',
            $this->getImmagineProfilo($user['utentedossier_id']),
                $azienda ?? null);
    }

    public function setPassword(int $utentedossier_id, string $encPass): bool
    {
        try {
            $this->db->createCommand()
                ->update('UtentiDossier', ['password' => $encPass], ['utentedossier_id' => $utentedossier_id])
                ->execute();
            return true;
        } catch (Exception|\Throwable $e) {
            return false;
        }
    }
}
