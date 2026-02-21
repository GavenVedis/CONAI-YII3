<?php

namespace App\Model\Entity\Main;

readonly class UtentiDossierDTO
{
    public function __construct(
        public int $utentedossier_id,
        public string $referente,
        public string $email,
        public string $username,
        public string $password,
        public string $tipo_utente,
        public string $immagine_profilo,
        public string $tipologia_azienda,
        public string $ragione_sociale,
        public int $tipo_referente,
        public string $piva,
        public bool $privacy,
        public string $telefono,
        public string $telefono_mobile,
        public int $newsletter
    ){}

    public static function fromRow(array $row, string $tipo_utente, string $immagine_profilo, ?AziendeDTO $azienda): self
    {
        return new self(
            utentedossier_id: (int) $row['utentedossier_id'],
            referente: $row['referente'],
            email: $row['email'],
            username: $row['username'],
            password: $row['password'],
            tipo_utente: $tipo_utente,
            immagine_profilo: $immagine_profilo,
            tipologia_azienda: $azienda ? ($azienda->tipologia_azienda == 1 ? 'Utilizzatore imballaggio' : 'Produttore imballaggio') : '',
            ragione_sociale: $azienda ? $azienda->ragione_sociale : '',
            tipo_referente: (int)$row['tipo_referente'],
            piva: $azienda ? $azienda->piva : '',
            privacy: (int)$row['privacy'] == 1,
            telefono: $row['telefono'],
            telefono_mobile: $row['telefono_mobile'],
            newsletter: (int)$row['newsletter']
        );
    }
}
