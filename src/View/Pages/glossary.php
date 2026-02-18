<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var Yiisoft\Aliases\Aliases $aliases
 */

$this->setTitle($applicationParams->name . " - Glossary");
?>

<h1>Glossario</h1>

<div class="row elenco-glossario mb-3" style="font-size: 1rem">
    <a href="#glossario_1">Consumo d'acqua</a><br/>
    <a href="#glossario_2">Dati primari</a><br/>
    <a href="#glossario_3">Ecodesign</a><br/>
    <a href="#glossario_4">Formato</a><br/>
    <a href="#glossario_5">GER (Gross Energy Requirement)</a><br/>
    <a href="#glossario_6">GWP (Global Warming Potential)</a><br/>
    <a href="#glossario_16">Material for recycling</a><br/>
    <a href="#glossario_15">Imballaggio multistrato (o multilayer)</a><br/>
    <a href="#glossario_7">Imballaggio poliaccoppiato (composito)</a><br/>
    <a href="#glossario_8">Imballaggio primario</a><br/>
    <a href="#glossario_9">Imballaggio secondario</a><br/>
    <a href="#glossario_10">Imballaggio terziario</a><br/>
    <a href="#glossario_11">Life Cycle Assessment (LCA)</a><br/>
    <a href="#glossario_12">Life Cycle Assessment semplificata (LCA semplificata o "spedita")</a><br/>
    <a href="#glossario_13">Sistema di imballo</a><br/>
    <a href="#glossario_14">Unit&agrave; funzionale</a><br/>
</div>

<div id="elenco_questionario" class="row elenco-glossario text-md-left" style="font-size: 1rem">
    <div class="col-12 mb-3">
        <a href="#glossario_1" id="glossario_1">Consumo d'acqua:</a>
        indicatore, espresso in litri (l) o kilogrammi (kg), che valuta la quantit&agrave; di acqua di processo impiegata nella produzione e nella commercializzazione dei beni di consumo, che non torna, a valle del processo, alla fonte dalla quale proviene. Si tratta della cosiddetta quota di "blue water", una componente dell'indicatore "water footprint", calcolato secondo quanto riportato in <a href="http://www.waterfootprint.org" target="_new">www.waterfootprint.org</a>.
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_2" id="glossario_2">Dati primari:</a>
        i dati primari sono riferiti ad informazioni specifiche aziendali che riguardano, ad esempio,
        i valori di consumo energetico diretto derivanti dal processo produttivo degli imballaggi.
        Nel caso dei dati primari si fa esplicitamente riferimento al processo produttivo e non al prodotto in s&eacute;.
        All'interno dell'Eco Tool CONAI, infatti, &egrave; possibile inserire i valori di miglioramento di processo relativi
        al consumo di eneregia elettrica (espresso in kWh), al consumo di gas naturale per produrre energia termica (espresso in Nm<sup>3</sup>) e a quello idrico (in litri o kg).
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_3" id="glossario_3">Ecodesign:</a>
        approccio che considera gli aspetti ambientali dell'intero ciclo di vita di un prodotto/servizio in un'ottica integrata
        rispetto alle altre variabili di progetto, a partire dall'estrazione delle materie prime necessarie alla sua produzione
        durante la fase di utilizzo, per arrivare alla destinazione finale al termine della vita utile. Al fine di rafforzare questo principio,
        l'Ecodesign viene spesso interpretato come "Life Cycle Design".
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_4" id="glossario_4">Formato:</a>
        &egrave; l'oggetto di riferimento dell'analisi a cui tutti i dati inseriti dovranno essere rapportati.
        Nel caso degli imballaggi, il formato &egrave; spesso riconducibile al quantitativo di prodotto contenuto,
        espresso con le unit&agrave; di misura della massa (kg/g di prodotto) o del volume (l/ml/cl di prodotto).<br/>
        Alcuni esempi:<br/>
        <ul>
            <li>confezione di biscotti da 250g: il formato &egrave; individuabile come "250 grammi (g)";</li>
            <li>bottiglia d'acqua naturale da 50cl: il formato &egrave; individuabile come "50 centilitri (cl) o 0,5litri (l)".</li>
        </ul>
        Altre volte il formato pu&ograve; essere definito in base alla funzione che l'imballaggio svolge,
        dunque riferirsi ad unit&agrave; di misura differenti, quali quella dello spazio
        (superficie in cm<sup>2</sup>/m<sup>2</sup>; solitamente utilizzata per i poliaccoppiati).<br/>
        Esempio: imballaggio poliaccoppiato in bobina: il formato &egrave; individuabile come "1 metro quadro (m<sup>2</sup>)".<br/>
        Nella terminologia classica dell'analisi del ciclo di vita, il formato pu&ograve; essere ricondotto all'unit&agrave;
        funzionale alla quale si riferisce l'analisi.
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_5" id="glossario_5">GER (Gross Energy Requirement - consumo totale di energia):</a>
        indicatore, espresso in MJ (Megajoule), dell'energia totale utilizzata durante tutto
        il ciclo di vita di una <a href="#14">unit&agrave; funzionale</a> del prodotto/servizio.
        Contribuiscono a tale indicatore le quote di energia consumata per alimentare i processi produttivi (combustibili, energia elettrica),
        quelle per produrre i vettori energetici utilizzati nei processi e per le fasi di trasporto;
        inoltre, nell'Eco Tool CONAI, l'energia <i>feedstock</i>
        (contenuto energetico delle materie prime in ingresso al sistema utilizzate come materiali e non come combustibili,
        come ad esempio la quota di petrolio da cui derivano i polimeri) &egrave; compresa nel GER.
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_6" id="glossario_6">GWP (Global Warming Potential):</a>
        indicatore, espresso in massa di CO<sub>2</sub> equivalente, che valuta l'emissione di tutti i gas che contribuiscono
        all'effetto serra congiuntamente alla CO<sub>2</sub> secondo i fattori di caratterizzazione
        del <a href="http://www.ipcc.ch" target="_new">IPCC</a>. Nell'analisi del ciclo di vita, il GWP corrisponde al carbon footprint.
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_16" id="glossario_16">Material for recycling:</a>
        l’indice esprime la massa di materiale generabile a seguito di operazioni di
        raccolta, selezione, riciclo e compostaggio dell’imballaggio a fine vita. Valuta
        quantitativamente la riciclabilità dell’imballaggio considerando nell’algoritmo la
        fascia del contributo diversificato di plastica e carta, la certificazione di
        compostabilità ai sensi della EN 13432, la resa dei processi di riciclaggio della
        plastica, la conversione e la stabilizzazione del rifiuto da imballaggio
        biodegradabile a compost ed infine la percentuale di avviato a riciclaggio a fine
        vita per ciascuna tipologia di imballaggio e materiale approvato dai Consorzi di
        filiera e da CONAI.
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_15" id="glossario_15">Imballaggio multistrato (o multilayer):</a>
        imballaggio formato da pi&ugrave; strati di materiali plastici diversi accoppiati tra loro.
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_7" id="glossario_7">Imballaggio poliaccoppiato (composito):</a>
        si tratta di un imballaggio costituito in modo strutturale da diversi materiali poliaccoppiati, non separabili manualmente.
        Ad esempio, sono imballaggi poliaccoppiati i seguenti articoli: cartone per bevande
        (poliaccoppiato: carta, plastica e alluminio), sacchetto composto da un foglio di alluminio accoppiato con carta, ecc.
        Nell'Eco Tool CONAI gli imballaggi poliaccoppiati andranno inseriti in funzione del materiale prevalente in peso (alluminio, carta o plastica).
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_8" id="glossario_8">Imballaggio primario:</a>
        "imballaggio concepito in modo da costituire, nel punto di vendita, un'unit&agrave; di vendita per l'utente finale o per il consumatore". In generale l'imballaggio primario &egrave; quello che confeziona il singolo prodotto pronto al consumo (ad es. bottiglia o flacone).
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_9" id="glossario_9">Imballaggio secondario:</a>
        "imballaggio concepito in modo da costituire, nel punto di vendita, il raggruppamento di un certo numero di unit&agrave; di vendita, indipendentemente dal fatto che sia venduto come tale all'utente finale o al consumatore, o che serva soltanto a facilitare il rifornimento degli scaffali nel punto di vendita. Esso pu&ograve; essere rimosso dal prodotto senza alterarne le caratteristiche". In generale l'imballaggio secondario &egrave; quello che raggruppa un certo numero di singoli prodotti pronti al consumo. Il prodotto, una volta tolto dall'imballaggio secondario, si presenta nel suo imballaggio primario, inalterato e pronto all'uso (ad es. espositore o fardello).
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_10" id="glossario_10">Imballaggio terziario:</a>
        "imballaggio concepito in modo da facilitare la manipolazione ed il trasporto di merci, dalle materie prime ai prodotti finiti, di un certo numero di unit&agrave; di vendita oppure di imballaggi multipli per evitare la loro manipolazione e i danni connessi al trasporto, esclusi i container per i trasporti stradali, ferroviari, marittimi e aerei". In generale l'imballaggio terziario &egrave; destinato a proteggere e a facilitare la movimentazione delle merci durante il trasporto (ad es. pallet o cassa).
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_11" id="glossario_11">Life Cycle Assessment (LCA):</a>
        procedimento scientifico ed oggettivo di valutazione dei carichi energetici e ambientali relativi al sistema analizzato, effettuato attraverso l'identificazione delle risorse energetiche, dei materiali usati e dei rifiuti rilasciati nell'ambiente lungo tutto il ciclo di vita del prodotto in un'ottica "dalla culla alla culla". La metodologia LCA trova le sue origini negli anni &apos;70 come sviluppo dell'analisi energetica, dove le variabili squisitamente energetiche vengono integrate con quelle tipicamente ambientali durante l'intero ciclo di vita. Attualmente, le norme ISO 14040 e 14044 rappresentano lo standard internazionale a cui ogni analista fa riferimento per sviluppare ed, eventualmente, far verificare ogni studio LCA.
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_12" id="glossario_12">Life Cycle Assessment semplificata (LCA semplificata o "spedita"):</a>
        strumento di analisi del ciclo di vita in grado di fornire in maniera rapida l'ecoprofilo di un prodotto o servizio attraverso un set ristretto di indicatori ambientali e di banche dati internazionali di riferimento.
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_13" id="glossario_13">Sistema di imballo:</a>
        strumento di analisi del ciclo di vita in grado di fornire in maniera rapida l'ecoprofilo di un prodotto o servizio attraverso un set ristretto di indicatori ambientali e di banche dati internazionali di riferimento.
        insieme di tutte le componenti di imballaggio, imballaggio primario, secondario e terziario.<br/>
        Alcuni esempi:
        <table class="table table-responsive table-glossario">
            <thead>
            <tr>
                <th>Tipologia imballaggio</th>
                <th>Imballaggio primario</th>
                <th>Imballaggio secondario/terziario</th>
                <th>&nbsp;</th>
                <th>Sistema di imballo</th>
            </tr>
            </thead>
            <tbody style="vertical-align: middle">

            <tr>
                <td>
                    <b>Bottiglia d'acqua minerale</b>
                </td>
                <td>
                    <ul>
                        <li>bottiglia
                        <li>tappo
                        <li>etichetta
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>fardello (film che avvolge 6 bottiglie)
                        <li>pallet
                        <li>film per pallettizzazione
                    </ul>
                </td>
                <td>
                    <img src="<?= $aliases->get('@baseUrl/img/arrow.png') ?>" />
                </td>
                <td>
                    <ul>
                        <li>bottiglia
                        <li>tappo
                        <li>etichetta
                        <li>fardello
                        <li>pallet
                        <li>film per pallettizzazione
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Vasetto per marmellata</b>
                </td>
                <td>
                    <ul>
                        <li>vasetto
                        <li>tappo
                        <li>etichetta
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>vassoio
                        <li>fardello (film che avvolge pi&ugrave; vasetti)
                        <li>pallet
                        <li>film per pallettizzazione
                    </ul>
                </td>
                <td>
                    <img src="<?= $aliases->get('@baseUrl/img/arrow.png') ?>" />
                </td>
                <td>
                    <ul>
                        <li>vasetto
                        <li>tappo
                        <li>etichetta
                        <li>vassoio
                        <li>film
                        <li>pallet
                        <li>film per pallettizzazione
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Scatoletta di tonno</b>
                </td>
                <td>
                    <ul>
                        <li>scatoletta
                        <li>chiusura
                        <li>eventuale cartoncino che avvolge pi&ugrave; scatolette
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>espositore
                        <li>fardello (film che avvolge pi&ugrave; scatolette o confezioni)
                        <li>pallet
                        <li>film per pallettizzazione
                    </ul>
                </td>
                <td>
                    <img src="<?= $aliases->get('@baseUrl/img/arrow.png') ?>" />
                </td>
                <td>
                    <ul>
                        <li>scatoletta
                        <li>chiusura
                        <li>eventuale cartoncino che avvolge pi&ugrave; scatolette
                        <li>espositore
                        <li>fardello
                        <li>pallet
                        <li>film per pallettizzazione
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-12 mb-3">
        <a href="#glossario_14" id="glossario_14">Unit&agrave; funzionale:</a>
        l'unit&agrave; funzionale rappresenta l'oggetto di riferimento dell'analisi
        a cui tutti i dati inseriti nel questionario dovranno essere rapportati.
        Per maggiori informazioni vedi <a href="#glossario_4">"formato"</a>.
    </div>
</div>
<br/>
<h1>Indicatori</h1>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/co2.jpg') ?>" style="max-width: 150px" alt="co2"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><a href="#glossario_6"><b>GWP (Global Warming Potential):</b></a></p>
        <p>indicatore, espresso in massa di CO<sub>2</sub> equivalente, che valuta l'emissione di tutti i gas che contribuiscono all'effetto serra
            congiuntamente alla CO<sub>2</sub> secondo i fattori di caratterizzazione del
            <a href="https://www.ipcc.ch/" target="_new">IPCC</a>. Nell'analisi del ciclo di vita, il GWP corrisponde al carbon footprint.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/energia.jpg') ?>" style="max-width: 150px" alt="energia"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><a href="#glossario_5"><b>GER (Gross Energy Requirement - consumo totale di energia):</b></a></p>
        <p>indicatore, espresso in MJ (Megajoule), dell'energia totale utilizzata durante tutto il ciclo di vita di una
            <a href="#glossario_14">unit&agrave; funzionale</a>
            del prodotto/servizio. Contribuiscono a tale indicatore le quote di energia consumata per alimentare i processi produttivi
            (combustibili, energia elettrica), quelle per produrre i vettori energetici utilizzati nei processi e per le fasi di trasporto;
            inoltre, nell'Eco Tool CONAI, l'energia <i>feedstock</i>
            (contenuto energetico delle materie prime in ingresso al sistema utilizzate come materiali e non come combustibili,
            come ad esempio la quota di petrolio da cui derivano i polimeri) &egrave; compresa nel GER.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/acqua.jpg') ?>" style="max-width: 150px" alt="acqua"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><a href="#glossario_1"><b>Consumo d'acqua:</b></a></p>
        <p>indicatore, espresso in litri (l) o kilogrammi (kg), che valuta la quantit&agrave; di acqua di processo impiegata nella produzione e nella commercializzazione dei beni di consumo, che non torna, a valle del processo, alla fonte dalla quale proviene. Si tratta della cosiddetta quota di "blue water", una componente dell'indicatore "water footprint", calcolato secondo quanto riportato in <a href="https://www.waterfootprint.org" target="_new">www.waterfootprint.org</a>.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/mps.png') ?>" style="max-width: 150px" alt="mps"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><a href="#"><b>L'MPS (Materia Prima Secondaria generata):</b></a></p>
        <p>indica la quantit&agrave; di materia prima seconda che può essere generata grazie alle operazioni di riciclo del'imballaggio. Più è riciclabile il tuo imballaggio, maggiore è la quanti&agrave; di materia prima seconda generabile.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/circolarita.png') ?>" style="max-width: 150px" alt="circolarita"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><a href="#"><b>L'indicatore di circolarit&agrave;:</b></a></p>
        <p>ti mostra il confronto tra la scheda imballaggio e la nuova simulazione, in termini di circolarit&agrave;, intesa come capacit&agrave; dell'imballaggio di recuperare i materiali conservandone le caratteristiche fisiche. Più l'imballaggio è riutilizzabile, e/o composto da materiale riciclato, e/o riciclabile, e sar&agrave; circolare.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/FAR_New_liv4.png') ?>" style="max-width: 150px" alt="facilitazione_riciclo"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><a href="#"><b>L'Indice Facilitazione delle Attivita' di Riciclo:</b></a></p>
        <p>su una scala percentuale suddivisa in quattro fasce (da 0 a 25%, da 26% a 50%, da 51% a 75%, da 76% a 100%), fornisce un'indicazione grafica e qualitativa della riciclabilita' dell'imballaggio.</p>
    </div>
</div>

<div class="row mb-3 align-items-center" style="font-size: 1rem">
    <div class="col-6 col-md-2 offset-3 offset-md-0">
        <img src="<?= $aliases->get('@baseUrl/img/mfr.png') ?>" style="max-width: 150px" alt="material_recycling"/>
    </div>
    <div class="col-12 col-md-10 text-md-left">
        <p style="font-size: 1.4rem"><a href="#"><b>Material for recycling:</b></a></p>
        <p>l’indice esprime la massa di materiale generabile a seguito di operazioni di
            raccolta, selezione, riciclo e compostaggio dell’imballaggio a fine vita. Valuta
            quantitativamente la riciclabilità dell’imballaggio considerando nell’algoritmo la
            fascia del contributo diversificato di plastica e carta, la certificazione di
            compostabilità ai sensi della EN 13432, la resa dei processi di riciclaggio della
            plastica, la conversione e la stabilizzazione del rifiuto da imballaggio
            biodegradabile a compost ed infine la percentuale di avviato a riciclaggio a fine
            vita per ciascuna tipologia di imballaggio e materiale approvato dai Consorzi di
            filiera e da CONAI.</p>
    </div>
</div>
<script type="text/javascript">
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        const target = $($.attr(this, 'href'));
        const header = $('#header');
        let offset = 0;
        if (header[0]) {
            offset = header.outerHeight(true);
        }

        $('html, body').animate({
            scrollTop: target.offset().top - offset
        }, 500);
    });
</script>
