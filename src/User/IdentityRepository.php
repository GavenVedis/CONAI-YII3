<?php

namespace App\User;

use App\Model\Repository\UtentiDossier;
use App\Model\Entity\UtentiDossierDTO;
use App\Model\Repository\Utenti;
use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;

final readonly class Identity implements IdentityInterface
{
    public function __construct(
        private UtentiDossierDTO $user
    ) {
    }

    public function getId(): string
    {
        return $this->user->utentedossier_id;
    }
}

class IdentityRepository implements IdentityRepositoryInterface
{
    public function __construct(
        private readonly UtentiDossier $utentiDossier
    ) {}

    public function findIdentity(string $username): ?IdentityInterface
    {
        $utente_dossier = $this->utentiDossier->findByUsername($username);
        if ($utente_dossier) {
            return new Identity($utente_dossier);
        }
        return null;
    }
}
