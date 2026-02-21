<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var array $users
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var Yiisoft\User\CurrentUser $currentUser
 * @var string|null $csrf
 */

$this->setTitle($applicationParams->name);
?>

<?php if (!$currentUser->isGuest()): ?>
    <script>window.location = "/";</script>
<?php endif; ?>
<form id="dossier-register-form" name="dossier-register-form" method="post" action="/dossier/createAccount">
    <input type="hidden" name="_csrf" value="<?= $csrf ?>" />
    <fieldset>
        <legend>Registrazione Nuovo Account</legend>
        <div class="row">
            <label for="companyname" class="col-sm-3 col-form-label">Ragione Sociale</label>
            <div class="col col-sm-7">
                <input type="text" class="form-control" id="companyname" name="companyname" required/>
            </div>
        </div>
        <div class="row">
            <label for="piva" class="col-sm-3 col-form-label">Partita IVA</label>
            <div class="col col-sm-2">
                <span class="fakeInput disableText" style="float: left">IT</span>
            </div>
            <div class="col-8 col-sm-5">
                <input type="text" class="form-control" id="piva" name="piva" pattern="^[0-9]{11}$"
                       title="La Partita IVA deve essere composta da 11 cifre" required/>
            </div>
        </div>
        <div class="row">
            <label for="name" class="col-sm-3 col-form-label">Referente compilazione</label>
            <div class="col col-sm-7">
                <input type="text" class="form-control" id="name" name="name" pattern="^([^0-9]+)(\s[^0-9]+)*$" title="Il campo non deve contenere cifre" required/>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-3 col-form-label">Tipologia Azienda</label>
            <div class="col col-sm-7" style="text-align: left; line-height: 1.5rem;">
                <input type="radio" value="1" name="tipologia_azienda" checked>
                Utilizzatore di imballaggio<br>
                <input type="radio" value="0" name="tipologia_azienda">
                Produttore di imballaggio
            </div>
        </div>
        <div class="row">
            <label for="companyemail" class="col-sm-3 col-form-label">Riferimento Email</label>
            <div class="col col-sm-7">
                <input type="text" class="form-control" id="companyemail" name="companyemail" pattern="^[\w\.\-]+@\w+[\w\.\-]*\.\w{2,4}$" title="Inserire una email valida" required/>
            </div>
        </div>
        <div class="row">
            <label for="companytel" class="col-sm-3 col-form-label">Riferimento Telefonico</label>
            <div class="col col-sm-7">
                <input type="text" class="form-control" id="companytel" name="companytel" title="Inserire un numero telefonico valido" pattern="^[0-9]{7,20}$" required/>
            </div>
        </div>
        <div class="row">
            <label for="companymobile" class="col-sm-3 col-form-label">Riferimento Mobile</label>
            <div class="col col-sm-7">
                <input type="text" class="form-control" id="companymobile" name="companymobile" title="Inserire un numero telefonico valido" pattern="^[0-9]{7,20}$" required/>
            </div>
        </div>
        <div class="row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col col-sm-7">
                <input type="text" class="form-control" id="username" name="username" required/>
            </div>
        </div>
        <div class="row login-msg" id="username-msg">
            Username gi&agrave; esistente
        </div>
        <div class="row">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col col-sm-7">
                <input type="password" class="form-control" id="password" name="password" required/>
            </div>
        </div>
        <div class="row">
            <label for="confirm-password" class="col-sm-3 col-form-label">Conferma Password</label>
            <div class="col col-sm-7">
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required/>
            </div>
        </div>
        <div class="row login-msg" id="confirm-password-msg">
            La Password non corrisponde
        </div>
        <div class="row" id="span-privacy">
            <label for="privacy-checkbox" class="col-sm-7 col-form-label">Ho letto ed accettato <a tabindex="6"
                                                                                                   href="<?= $aliases->get('@baseUrl/docs/privacy.pdf') ?>"
                                                                                                   target="_BLANK">l'informativa
                    sulla privacy</a></label>
            <div class="col col-sm-3">
                <input id="privacy-checkbox" type="checkbox" value="1" name="privacy-checkbox" required>
            </div>
        </div>

        <div class="row" id="span-conditions">
            <label for='conditions-checkbox' class="col-sm-7 col-form-label"> Esprimo il mio <a tabindex="6"
                                                                                                href="javascript:popup('conditions');">consenso
                    all'utilizzo dei dati</a></label>
            <div class="col col-sm-3">
                <input id="conditions-checkbox" type="checkbox" value="1" name="conditions-checkbox" required>
            </div>
        </div>
        <div class="row"  id="span-newsletter">
            <label for='newsletter-checkbox' class="col-sm-7 col-form-label">Desidero ricevere <a tabindex="6"
                                                                                                  href="javascript:popup('newsletter');">le
                    comunicazioni</a> del Conai</label>
            <div class="col col-sm-3">
                <input id="newsletter-checkbox" type="checkbox" value="1" name="newsletter-checkbox">
            </div>
        </div>
        <button type="submit" class="button" onclick="checkUsernameAndPassword(event)">Registrati</button>
    </fieldset>
</form>

<!--- PRIVACY --->
<div id="privacy" class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

</div>
<div class="modal fade" id="privacy" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>INFORMATIVA PRIVACY (art. 13, D.Lgs. 196/2003)</h4>
                <p>


                    I dati personali forniti dal Consorziato attraverso la compilazione del seguente form on line, o forniti
                    successivamente su richiesta del CONAI ad integrazione/modifica, verranno utilizzati da CONAI
                    (Titolare del trattamento) per l'organizzazione del Bando CONAI per la prevenzione nonché per
                    l'elaborazione del periodico Dossier Prevenzione e di altro materiale divulgativo da inserire sul sito
                    internet del Consorzio, su CD/CD-ROM, libri, su altri mezzi di comunicazione (di stampa o
                    telematici). Le modalità di presentazione delle informazioni fornite dal Consorziato potranno essere
                    modificate secondo criteri di volta in volta definiti da CONAI a seconda delle specifiche esigenze
                    istituzionali e di informazione al pubblico.
                    <br/><br/>
                    Con la compilazione del seguente form on line, il Consorziato si impegna a:
                <ul>
                    <li>fornire a CONAI le informazioni necessarie e a garantirne la veridicità;</li>
                    <li>rendere disponibili le foto e le schede tecniche dell’imballaggio nelle versioni PRIMA e DOPO l’intervento
                        effettuato;
                    </li>
                    <li>su richiesta di CONAI, rendere disponibile un campione fisico dell’imballaggio nelle versioni PRIMA e DOPO
                        l’intervento effettuato, nonché copia di eventuale documentazione utile;
                    </li>
                    <li>eventualmente, accogliere, presso i propri uffici/stabilimenti, referenti CONAI o referenti terzi incaricati
                        da CONAI, per verificare la veridicità delle informazioni comunicate.
                    </li>
                    <li>garantirela conformità degli imballaggi presentati ai requisiti essenziali definiti dalla normativa
                        vigente.
                    </li>
                </ul>

                <br/>
                I dati personali e specifici forniti dal Consorziato verranno utilizzati da CONAI (Titolare del
                trattamento) per la valutazione e selezione dei casi presentati al Bando CONAI per la
                prevenzione nonché per la valutazione dell'impatto ambientale delle azioni di prevenzione
                attuate dal Consorziato basata sull'approccio LCA (Life Cycle Assessment). Nell'ambito delle
                finalità sopraindicate i dati e i relativi risultati verranno comunicati da CONAI unicamente
                alla società debitamente selezionata ed operante come autonomo Titolare (Life Cycle
                Engineering) per essere esaminati. I casi ammessi al Bando CONAI per la prevenzione verranno
                diffusi in pubblicazioni cartacee e on line. I risultati delle attività di elaborazione del Dossier
                Prevenzione verranno diffusi in forma statistica attraverso il Dossier Prevenzione stesso e gli altri mezzi di
                comunicazione sopra citati.
                <br/><br/>

                Tali risultati potranno essere utilizzati dal Consorziato solo dopo l'assegnazione dell'incentivo economico del
                Bando CONAI per la prevenzione ovvero dopo l'ufficiale pubblicazione da parte di CONAI, citandone sempre la fonte.
                Restano fermi i diritti di accesso e gli altri diritti di privacy (art. 7 del D.Lgs. 196/2003) da
                esercitare rivolgendosi al Responsabile aziendale del trattamento domiciliato per la carica
                presso la sede CONAI di Milano. Al riguardo, si precisa, tuttavia, che non potrà essere chiesto
                il blocco del trattamento o la cancellazione in un momento successivo all’avvenuta
                pubblicazione
                </p>
                <div class=center><a href="/dossier/privacy">Scarica l'informativa sulla privacy</a></div>
            </div>
        </div>
    </div>
</div>

<!--- CONDITIONS --->
<div class="modal fade" id="conditions" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>ESPRIMO IL MIO CONSENSO ALL'UTILIZZO DEI DATI</h4>
                <p>
                    Compilando il seguente questionario on line, l'azienda, in persona del suo referente (autorizzato dal Legale
                    Rappresentante
                    o da un soggetto da esso delegato), ricevuta da CONAI dettagliata informativa privacy circa l'utilizzo dei
                    propri dati personali, esprime il proprio libero consenso all'utilizzo ed alla diffusione dei dati stessi
                    per le finalit&agrave; e secondo le modalit&agrave; dichiarate da CONAI e ne garantisce la veridicit&agrave;
                    impegnandosi a comunicare
                    tempestivamente le variazioni che dovessero intervenire.
                </p>
            </div>
        </div>
    </div>
</div>

<!--- NEWSLETTER --->
<div class="modal fade" id="newsletterPop" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>COMUNICAZIONI CONAI</h4>
                <p>
                    L'azienda, in persona del suo referente (autorizzato dal Legale Rappresentante o da un soggetto da esso
                    delegato),
                    esprime il proprio libero consenso all'utilizzo dei DATI GENERALI forniti per l'invio, da parte di CONAI,
                    di comunicazioni e materiale informativo.
                </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    let modalOpened = false;
    function validaCampi() {
        return false;
    }

    $(document).ready(function() {
        $('#dossier-register-form').on('submit', function() {

            //TODO: aggiungere la validazione campi PRIMA di confermare, almeno si avvisa l'utente dei campi che non vanno bene

            return false;
        });
        $('#username').bind('blur', function() {
            var username = $('#username').val();
            if (username !== '') {
                $.ajax({
                    url: '/dossier/checkUserExistance',
                    type: 'POST',
                    async: false,
                    data: {username: username, password: null, register: true, '_csrf': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data) {
                        var result = data;
                        if (result.result === 'NO_USER') {
                            $('#username-msg').hide();
                            $('#username').removeAttr('data-invalid');
                        } else {
                            $('#username-msg').show();
                            $('#username').attr('data-invalid', 'invalid');
                        }
                    },
                });
            } else {
                $('#username-msg').hide();
                $('#username').removeAttr('data-invalid');
            }
        });

        $('#confirm-password').bind('blur', function() {
            var password = $('#password').val(),
                confPass = $('#confirm-password').val();
            if (password !== '' && confPass !== '' && password !== confPass) {
                $('#confirm-password').attr('data-invalid', 'invalid');
                $('#confirm-password-msg').show();
            } else {
                $('#confirm-password').removeAttr('data-invalid');
                $('#confirm-password-msg').hide();
            }
        });

        $("#piva").bind('paste', checkAzienda);
        $("#piva").bind('input', checkAzienda);

    });

    function checkAzienda (e) {
        /* faccio la chiamata per verificare la partita iva, se coincide compilo il campo ragione sociale, altrimenti niente
         * metto un limite in base al pattern del campo
         *
        */
        if (e.target.value.match(e.target.getAttribute('pattern'))) {
            $.ajax({
                url: '/dossier/checkRagioneSociale',
                type: 'POST',
                async: false,
                data: {piva: e.target.value, '_csrf': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    const result = data;
                    if (result.ragione_sociale !== '') {
                        $("#companyname").val(result.ragione_sociale);
                    }
                },
            })

        }
    }

    function checkUsernameAndPassword(event) {

        const passInvalid = $('#confirm-password').attr('data-invalid'),
            userInvalid = $('#username').attr('data-invalid');
        if (passInvalid || userInvalid) {
            event.preventDefault();
        } else {
            setTimeout(function() {
                return true;
            }, 500);
        }

    }

    popup = function(action) {
        const _action = action || null;

        switch (_action) {
            case 'privacy':
                modalOpened = new bootstrap.Modal(document.getElementById('privacy'));
                modalOpened.show();
                break;

            case 'conditions':
                modalOpened = new bootstrap.Modal(document.getElementById('conditions'));
                modalOpened.show();
                break;

            case 'newsletter':
                modalOpened = new bootstrap.Modal(document.getElementById('newsletterPop'));
                modalOpened.show();
                break;
        }
    };

</script>

