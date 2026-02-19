<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var Yiisoft\Aliases\Aliases $aliases
 */

$this->setTitle($applicationParams->name . " - Leve di ecodesign");
?>

<h1>Le leve di Ecodesign</h1>

<div class="row mb-3" style="font-size: 1rem">
    <div class="col-12">
        <p>
            L'Ecodesign &egrave; l'approccio che considera gli aspetti ambientali dell'intero ciclo di vita di un prodotto/servizio in un'ottica integrata rispetto alle altre variabili di progetto, a partire dall'estrazione delle materie prime necessarie alla sua produzione durante la fase di utilizzo, per arrivare alla destinazione finale al termine della vita utile. Al fine di rafforzare questo principio, l'Ecodesign viene spesso interpretato come <b>"Life Cycle Design"</b>.
        </p>
    </div>
    <div class="col-12">
        <p>
            <b>CONAI</b> individua nove leve su cui le aziende possono agire per ridurre l'impatto ambientale degli imballaggi. <br />
            Sette azioni virtuose definite nei loro contenuti e sintetizzate in specifici simboli, come segue:
        </p>
    </div>
    <div class="col-12">
        <p style="font-size: 1.5rem"><b>Leve di prevenzione</b></p>
        <p>Per misurare l'efficacia delle azioni di eco-design CONAI promuove il ricorso ad alcuni indicatori:</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_Riutilizzo.svg') ?>" style="max-width: 150px" alt="leva_riutilizzo"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Riutilizzo</b></p>
        <p>Concepimento o progettazione dell’imballaggio per poter compiere, durante il suo ciclo di vita, un numero minimo di spostamenti o rotazioni e per un uso identico a quello per il quale è stato concepito.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_Ricarica.svg') ?>" style="max-width: 150px" alt="leva_ricarica"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Ricarica</b></p>
        <p>Concepimento o progettazione dell’imballaggio, acquistato dall’utilizzatore finale, per essere riempito nuovamente dal distributore o dall’utilizzatore, con il prodotto di partenza.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_facilitazione attivita di riciclo.svg') ?>" style="max-width: 150px" alt="leva_facilitazione_riciclo"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Facilitazione delle attività di riciclo</b></p>
        <p>Semplificazione delle fasi di recupero e riciclo, anche organico, del packaging, come la separabilità dei diversi componenti (es. etichette, chiusure ed erogatori, ecc.).</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_Utilizzo materiale riciclato.svg') ?>" style="max-width: 150px" alt="leva_utilizzo_riciclato"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Utilizzo di materiale riciclato</b></p>
        <p>Sostituzione di una quota o della totalità di materia prima vergine con materia riciclata/recuperata9 per contribuire ad una riduzione del prelievo di risorse.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_Risparmio materia prima.svg') ?>" style="max-width: 150px" alt="leva_risparmio_materia_prima"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Risparmio di materia prima</b></p>
        <p>Contenimento del consumo di materie prime impiegate nella realizzazione dell’imballaggio e conseguente riduzione del peso, a parità di famiglia di materiale, di prodotto confezionato e di prestazioni.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_Risparmio materia prima vergine.svg') ?>" style="max-width: 150px" alt="leva_risparmio_materia_prima_vergine"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Risparmio di materia prima vergine</b></p>
        <p>Contenimento della massa di materia prima vergine impiegata nella realizzazione dell’imballaggio, a parità di famiglia di materiale, di prodotto confezionato e di prestazioni.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_Ottimizzazione dei processi produttivi.svg') ?>" style="max-width: 150px" alt="leva_ottimizzazione_processi_produttivi"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Ottimizzazione dei processi produttivi</b></p>
        <p>Implementazione di processi di produzione dell’imballaggio innovativi in grado di ridurre i consumi energetici per unità prodotta o di ridurre gli scarti di produzione o, in generale, di ridurre l’impiego di input produttivi.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_Ottimizzazione logistica.svg') ?>" style="max-width: 150px" alt="leva_ottimizzazione_logistica"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Ottimizzazione della logistica</b></p>
        <p>Miglioramento delle operazioni di immagazzinamento ed esposizione, ottimizzazione dei carichi sui pallet e sui mezzi di trasporto e perfezionamento del rapporto tra imballaggio primario, secondario e terziario.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/prevenzione/CONAI_Icone_Leve_2025_Semplificazione sistema imballo.svg') ?>" style="max-width: 150px" alt="leva_semplificazione_sistema_imballo"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><b>Semplificazione del sistema imballo</b></p>
        <p>Integrazione di più funzioni in una sola componente dell’imballo, eliminando un elemento e, quindi, semplificando il sistema.</p>
    </div>
</div>
