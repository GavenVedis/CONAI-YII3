<?php

namespace App\Model\Entity\Main;

readonly class UtentiDTO
{
    public function __construct(
        public int $utente_id,
        public string $nome,
        public string $email,
        public string $cognome,
        public string $password,
        public string $user,
        public string $tipo_utente
    ){}

    public static function fromRow(array $row): self
    {
        return new self(
            utente_id: (int) $row['utente_id'],
            nome: $row['nome'],
            email: $row['email'],
            cognome: $row['cognome'],
            password: $row['password'],
            user: $row['user'],
            tipo_utente: $row['tipo_utente']
        );
    }
}
