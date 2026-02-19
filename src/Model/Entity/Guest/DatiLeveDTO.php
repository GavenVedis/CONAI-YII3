<?php

namespace App\Model\Entity\Guest;

readonly class DatiLeveDTO
{

    public function __construct(
        public int $id,
        public string $path_immagine,
        public string $descrizione,
        public string $colore_legenda
    ){}

    public static function fromRow(array $row): self
    {
        return new self(
            id: (int) $row['id'],
            path_immagine: $row['path_immagine'],
            descrizione: $row['descrizione'],
            colore_legenda: $row['colore_legenda']
        );
    }
}
