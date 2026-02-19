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
        public string $categoria,
        public ?string $product_image,
        public ?string $mps_image,
        public ?string $impatti,
        public string $descrizione_prodotto,
        public string $leve,
        public string $campo_applicazione
    ){}

    public static function fromRow(array $row): self
    {
        return new self(
            id: (int) $row['id'],
            nome_prodotto: $row['nome_prodotto'],
            anno: $row['anno'],
            materiale: $row['materiale'],
            azienda: $row['azienda'],
            categoria: $row['categoria'],
            product_image: $row['product_image'] ?? null,
            mps_image: $row['mps_image'] ?? null,
            impatti: $row['impatti'] ?? null,
            descrizione_prodotto: $row['descrizione_prodotto'],
            leve: $row['leve'],
            campo_applicazione: $row['campo_applicazione']
        );
    }
}
