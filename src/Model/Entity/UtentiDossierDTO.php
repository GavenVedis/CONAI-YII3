<?php

namespace App\Model\Entity;

readonly class UtentiDossierDTO
{
    public function __construct(
        public int $utentedossier_id,
        public string $referente,
        public string $email,
        public string $username
    ){}

    public static function fromRow(array $row): self
    {
        return new self(
            utentedossier_id: (int) $row['utentedossier_id'],
            referente: $row['referente'],
            email: $row['email'],
            username: $row['username'],
        );
    }
}
