<?php

namespace App\Model\Entity\Guest;

readonly class StatisticheGuestDTO
{
    public function __construct(
        public int $id,
        public string $anno,
        public int $aziende_partecipanti,
        public int $casi_presentati,
        public int $casi_premiati,
        public int $casi_incentivati,
        public int $montepremi,
        public string $leve_attivate,
        public float $co2_prima,
        public float $co2_dopo,
        public float $ger_prima,
        public float $ger_dopo,
        public float $h2o_prima,
        public float $h2o_dopo
    ){}

    public static function fromRow(array $row): self
    {
        return new self(
            id: (int) $row['id'],
            anno: $row['anno'],
            aziende_partecipanti: $row['aziende_partecipanti'] ?? 0,
            casi_presentati: $row['casi_presentati'] ?? 0,
            casi_premiati: $row['casi_premiati'] ?? 0,
            casi_incentivati: $row['casi_incentivati'] ?? 0,
            montepremi: $row['montepremi'] ?? 0,
            leve_attivate: $row['leve_attivate'],
            co2_prima: $row['co2_prima'] ?? 0,
            co2_dopo: $row['co2_dopo'] ?? 0,
            ger_prima: $row['ger_prima'] ?? 0,
            ger_dopo: $row['ger_dopo'] ?? 0,
            h2o_prima: $row['h2o_prima'] ?? 0,
            h2o_dopo: $row['h2o_dopo'] ?? 0
        );
    }
}
