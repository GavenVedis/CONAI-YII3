<?php

namespace App\User;

use App\Model\Entity\Main\UtentiDossierDTO;
use App\Model\Repository\Main\UtentiDossier;
use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;

final readonly class Identity implements IdentityInterface
{

    public function __construct(private UtentiDossierDTO $user)
    {
    }

    public function getId(): string
    {
        return $this->user->utentedossier_id;
    }

    public function getUser(): UtentiDossierDTO
    {
        return $this->user;
    }

    public function getAuthKey(): ?string
    {
        return null;
    }

    public function validateAuthKey(string $authKey): bool
    {
        return true;
    }

    public function validatePassword(string $password): bool
    {
        return md5($password) == $this->user->password;
    }
}

class IdentityRepository implements IdentityRepositoryInterface
{
    public function __construct(
        private readonly UtentiDossier $utentiDossier
    ) {}

    public function findIdentity(string|int $id): ?Identity
    {
        $utente = $this->utentiDossier->findById((int)$id);
        return $utente ? new Identity($utente) : null;
    }

    public function findByUsername(string $username): ?Identity
    {
        $utente = $this->utentiDossier->findByUsername($username);
        return $utente ? new Identity($utente) : null;
    }
}
