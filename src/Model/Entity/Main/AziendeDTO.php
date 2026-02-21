<?php

namespace App\Model\Entity\Main;

readonly class AziendeDTO
{
    public function __construct(
        public int $id,
        public string $piva,
        public string $ragione_sociale,
        public int $tipologia_azienda
    ){}

    public static function fromRow(array $row): self
    {
        return new self(
            id: (int) $row['id'],
            piva: $row['piva'],
            ragione_sociale: $row['ragione_sociale'],
            tipologia_azienda: (int)$row['tipologia_azienda']
        );
    }
}
