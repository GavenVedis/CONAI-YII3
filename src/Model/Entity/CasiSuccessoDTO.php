<?php

namespace App\Model\Entity;

readonly class CasiSuccessoDTO
{
    public function __construct(
        public int $id,
        public string $nome_prodotto,
        public string $anno,
        public string $materiale,
        public string $azienda,
        public string $categoria
    ){}

    public static function fromRow(array $row): self
    {
        return new self(
            id: (int) $row['id'],
            nome_prodotto: $row['nome_prodotto'],
            anno: $row['anno'],
            materiale: $row['materiale'],
            azienda: $row['azienda'],
            categoria: $row['categoria']
        );
    }
}
