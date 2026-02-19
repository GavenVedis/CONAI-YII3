<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var array $link_utili
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var \Yiisoft\User\CurrentUser $currentUser
 */

$this->setTitle($applicationParams->name);
$logged_user = null;
if (!$currentUser->isGuest()) {
    $logged_user = $currentUser->getIdentity()->getUser();
}
?>

<?php if ($currentUser->isGuest()): ?>
    <script>window.location = "/dossier/login";</script>
<?php endif; ?>
<?php if ($logged_user): ?>

<div class="dossier container">
    <div class="row">
        <div class="col-lg-4 colonna-sinistra">
            <div class="card mb-3">
                <div class="riquadro-immagine-profilo" <?php
                if ($logged_user->immagine_profilo) {
                    $immagine_account_splitted = explode("/", $logged_user->immagine_profilo);
                    $web_immagine_account = $applicationParams->uploadDestination . $immagine_account_splitted[count($immagine_account_splitted) - 1];
                    echo "style='background: url(\"$web_immagine_account\") 50% 50% / contain no-repeat'";
                }
                ?>>
                    <img src="<?= $aliases->get('@baseUrl/img/matita.png') ?>"/>
                    <input type="file" accept="image/*" style="display: none" name="header-immagine-account"/>
                </div>
                <div class="card-body">
                    <form id="dossier-account-form" name="dossier-account-form" method="post"
                          action="/dossier/updateAccount">
                        <h5 class="card-title text-center"><?= $logged_user->referente ?></h5>
                        <h5 class="card-title text-center"><?= $logged_user->tipologia_azienda ?></h5>
                        <input type="hidden"
                               value="<?= $logged_user->username ?>"
                               name="Dossier[username]"
                        />
                        <h5 class="card-text mt-4 mb-3">Ragione sociale: <span
                                class="campo-bloccato active"><?= $logged_user->ragione_sociale ?></span><span
                                class="campo-editabile">
                                <input type="text"
                                       id="companyname"
                                       name="Dossier[companyname]"
                                       value="<?= $logged_user->ragione_sociale ?>"
                                       pattern="^.*\S.*$"
                                       title="La ragione sociale non pu&ograve; essere vuota"
                                       <?= $logged_user->tipo_referente == 0 ? 'readonly="true"' : '' ?>
                                       required/>
                            </span>
                        </h5>
                        <h5 class="card-text mb-3">P.IVA: IT<span
                                class="campo-bloccato active"><?= $logged_user->piva ?></span><span
                                class="campo-editabile">
                            <input type="text"
                                   name="Dossier[piva]"
                                   title="La Partita IVA deve essere composta da 11 cifre"
                                   value="<?= $logged_user->piva ?>"
                                   pattern="^[0-9]{11}$"
                                   <?= $logged_user->tipo_referente == 0 ? 'readonly="true"' : '' ?>
                                   required/>
                        </span>
                        </h5>
                        <h5 class="card-text mb-3">Referente: <span
                                class="campo-bloccato active"><?= $logged_user->referente ?></span><span
                                class="campo-editabile">
                            <input type="text"
                                   id="name"
                                   name="Dossier[name]"
                                   pattern="^[^0-9]+\s[^0-9]+$"
                                   title="Il nome del referente deve essere nel formato [NOME] [COGNOME] o [COGNOME] [NOME] e non deve contenere caratteri numerici"
                                   value="<?= $logged_user->referente ?>"
                                   required/>

                        </span>
                        </h5>
                        <h5 class="card-text mb-3">
                            <img src="<?= $aliases->get('@baseUrl/img/icona-email.png') ?>"/> e-mail: <span
                                class="campo-bloccato active"><?= $logged_user->email ?></span><span
                                class="campo-editabile">
                                <input type="text"
                                       id="companyemail"
                                       name="Dossier[companyemail]"
                                       pattern="^[\w\.\-]+@\w+[\w\.\-]*\.\w{2,4}$"
                                       title="Inserire una mail valida nel formato example@example.com"
                                       value="<?= $logged_user->email ?>"
                                       required/>
                            </span>
                        </h5>
                        <h5 class="card-text mb-3">
                            <img src="<?= $aliases->get('@baseUrl/img/icona-telefono.png') ?>"/> Telefono: <span
                                class="campo-bloccato active"><?= $logged_user->telefono ?></span><span
                                class="campo-editabile">
                                <input type="text"
                                       id="companytel"
                                       name="Dossier[companytel]"
                                       pattern="^[0-9]{7,20}$"
                                       title="Inserire un numero telefonico valido compreso tra i 7 e i 20 caratteri"
                                       value="<?= $logged_user->telefono ?>"
                                       required/>
                            </span>
                        </h5>
                        <h5 class="card-text mb-3">
                            <img src="<?= $aliases->get('@baseUrl/img/icona-telefono.png') ?>"> Mobile: <span
                                class="campo-bloccato active"><?= $logged_user->telefono_mobile ?></span><span
                                class="campo-editabile">
                                <input type="text"
                                       id="companymobile"
                                       name="Dossier[companymobile]"
                                       pattern="^[0-9]{7,20}$"
                                       title="Inserire un numero telefonico valido compreso tra i 7 e i 20 caratteri"
                                       value="<?= $logged_user->telefono_mobile ?>"
                                       required/>
                            </span>
                        </h5>
                        <h5 class="card-text mb-3">
                            <img src="<?= $aliases->get('@baseUrl/img/newsletter.png') ?>"/> Comunicazioni
                            CONAI? <span
                                class="campo-bloccato active"><?= $logged_user->newsletter ? 'Attiva' : 'Disattiva' ?></span><span
                                class="campo-editabile">
                                <input type="checkbox"
                                       id="newsletter"
                                       name="Dossier[newsletter]"
                                       title="Desideri ricevere le comunicazioni del CONAI?"
                                       <?php
                                       if ($logged_user->newsletter == 1): ?>
                                           checked
                                       <?php
                                       endif; ?>
                                />
                            </span>
                        </h5>
                        <h5 class="card-text mb-3 campo-password campo-editabile">
                            Password: <input type="password" id="password" class="account-input"
                                             name="Dossier[password]"/>
                        </h5>
                        <h5 class="card-text mb-3 campo-password campo-editabile">
                            Conferma Password: <input type="password" id="confirm-password" class="account-input"
                                                      name="Dossier[confirm-password]"/>
                            <div id="confirm-password-msg" class='login-msg'>La Password non corrisponde</div>
                        </h5>
                    </form>
                    <h5 class="card-text text-center">
                        <div class="modifica-dati-utente-button active">
                            Modifica dati utente
                        </div>
                        <div class="modifica-dati-utente-button">
                            Annulla modifica dati utente
                        </div>
                    </h5>
                    <h5 class="card-text mb-3 text-center">
                        <div class="modifica-password-utente-button active">
                            Cambia password
                        </div>
                        <div class="modifica-password-utente-button">
                            Annulla cambia password
                        </div>
                    </h5>
                    <h5 class="card-text mb-3 text-center conferma-cambio">
                        <div class="conferma-cambio-button">
                            Salva
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 colonna-azioni">
            <?php if ($logged_user->tipo_utente !== 'EDI'): ?>
                <div class="row<?= !$applicationParams->casi_successo ? ' diviso-3':''?>">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">I miei casi inviati</h5>
                                <p class="card-text">
                                    <a href="/dossier/casi&reset_filter=1">
                                        <img src="<?= $aliases->get('@baseUrl/img/icona-casi.png') ?>"/>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row<?= !$applicationParams->casi_successo ? ' diviso-3':''?>">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">I miei casi in bozza</h5>
                                <p class="card-text">
                                    <a href="/dossier/bozze&reset_filter=1">
                                        <img src="<?= $aliases->get('@baseUrl/img/icona-casi.png') ?>"/>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($applicationParams->casi_successo): ?>
                    <div class="row<?= !$applicationParams->casi_successo ? ' diviso-3':''?>">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">I miei casi di successo</h5>
                                    <p class="card-text">
                                        <a href="/dossier/casi_successo&reset_filter=1">
                                            <img src="<?= $aliases->get('@baseUrl/img/icona-casi.png') ?>"/>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row<?= !$applicationParams->casi_successo ? ' diviso-3':''?>">
                    <div class="col">
                        <div class="card nuovo-caso">
                            <div class="card-body">
                                <h5 class="card-title">Crea un nuovo caso</h5>
                                <p class="card-text">
                                    <a href="/compare/new&nuovo_caso=1">
                                        <img src="<?= $aliases->get('@baseUrl/img/x-image.png') ?>"/>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col">
                        <div class="card nuova-lettera">
                            <div class="card-body">
                                <h5 class="card-title">Crea lettera</h5>
                                <p class="card-text">
                                    <a href="/scheda/index">
                                        <img src="<?= $aliases->get('@baseUrl/img/x-image.png') ?>"/>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 colonna-destra">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Link utili</h5>
                    <ul class="list-group">
                        <?php
                        foreach ($link_utili as $link => $valore): ?>
                            <li class="list-group-item">
                                <a href="<?= $valore['url'] ?>"><?= html_entity_decode($valore['title']) ?></a>
                            </li>
                        <?php
                        endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Attenzione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-no" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Attenzione</h5>
            </div>
            <div class="modal-body">
                C'&egrave; stato un aggiornamento delle politiche della privacy, si prega di visionarle e accettarle
                nuovamente.<br>
                Grazie.<br>
                <div id="span-privacy" style="margin-top: 2rem;">
                    <label for='privacy-checkbox' style='width:350px;font-weight:normal;'>Ho letto ed accettato <a
                            tabindex="6" href="<?= $aliases->get('@baseUrl/docs/privacy.pdf') ?>" target="_BLANK">l'informativa
                            sulla privacy</a></label>
                    <input id="privacy-checkbox" type="checkbox" value="1" name="privacy-checkbox" required
                           onclick="javascript:privacyConfirmed()">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    let cambioPassword = false,
        cambioDati = false,
        modal = false,
        modalPrivacy = false,
        privacyUpdated = <?= $logged_user->privacy == 0 ? 'true' : 'false' ?>;

    function privacyConfirmed() {
        const current_user = "<?= $logged_user->utentedossier_id ?>",
            privacy_check = document.getElementById("privacy-checkbox");
        if (privacy_check.checked) {
            $.ajax({
                type: "POST",
                url: '/conai/ConfirmPrivacy',
                dataType: 'json',
                data: {
                    current_user: current_user
                },
                success: function (resp) {
                    if (resp.status === 'OK') {
                        location.reload();
                    }
                }
            })
        }
    }

    $(document).ready(function () {
        modal = new bootstrap.Modal(document.getElementById('infoModal'));
        modalPrivacy = new bootstrap.Modal(document.getElementById('privacyModal'));

        if (privacyUpdated) {
            modalPrivacy.show();
        }

        $(".dossier .riquadro-immagine-profilo img").click(function (e) {
            $(".dossier .riquadro-immagine-profilo input[name='header-immagine-account']").val('');
            $(".dossier .riquadro-immagine-profilo input[name='header-immagine-account']").click();
        });

        $(".dossier .riquadro-immagine-profilo input[name='header-immagine-account']").change(function (e) {
            const file = e.target.files[0];
            if (file && file.type.indexOf("image") !== -1) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $(".dossier .riquadro-immagine-profilo, #header .immagine-account").each(function (index, elem) {
                        elem.style.background = "url('" + event.target.result + "')";
                        elem.style.backgroundRepeat = 'no-repeat';
                        elem.style.backgroundSize = 'contain';
                        elem.style.backgroundPositionX = 'center';
                        elem.style.backgroundPositionY = 'center';
                    });
                    inviaImmagine(file);
                };

                reader.readAsDataURL(file);
            }
        });

        $(".dossier .riquadro-immagine-profilo").bind('drop', function (e) {
            e.preventDefault();

            const files = e.originalEvent.dataTransfer.files;

            if (files.length > 0 && files[0].type.indexOf("image") !== -1) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $(".dossier .riquadro-immagine-profilo, #header .immagine-account").each(function (index, elem) {
                        elem.style.background = "url('" + event.target.result + "')";
                        elem.style.backgroundRepeat = 'no-repeat';
                        elem.style.backgroundSize = 'contain';
                        elem.style.backgroundPositionX = 'center';
                        elem.style.backgroundPositionY = 'center';
                    });
                    inviaImmagine(files[0]);
                };

                reader.readAsDataURL(files[0]);
            }
        });

        $(".dossier .modifica-dati-utente-button").click(function (ev) {
            $("form .campo-bloccato, .modifica-dati-utente-button, .dossier form .campo-editabile:not(.campo-password)").toggleClass("active");
            cambioDati = !cambioDati;
            if (cambioPassword || cambioDati) {
                $(".dossier .conferma-cambio").addClass('active');
            } else {
                $(".dossier .conferma-cambio").removeClass('active');
            }
        });

        $(".dossier .modifica-password-utente-button").click(function (ev) {
            $(".dossier .modifica-password-utente-button, .dossier form .campo-password.campo-editabile").toggleClass("active");
            cambioPassword = !cambioPassword;
            if (cambioPassword || cambioDati) {
                $(".dossier .conferma-cambio").addClass('active');
            } else {
                $(".dossier .conferma-cambio").removeClass('active');
            }
        });

        $(".dossier .conferma-cambio-button").click(function (ev) {
            const valueForm = new FormData();
            let validita = true;
            const infoModal = document.getElementById('infoModal');
            const infoModalErrors = $("<p>").text('Si prega di verificare i campi compilati:').append($("<ul>").addClass("lista-errori")[0]);

            $(".dossier input[name^='Dossier[']").each(function (index, elem) {
                let campoValido = elem.checkValidity();
                if (['Dossier[password]', 'Dossier[confirm-password]'].includes(elem.getAttribute("name")) && !cambioPassword) {
                    $(elem).val('');
                    campoValido = true;
                }
                if (!campoValido) {
                    validita = false;
                    infoModalErrors.find('.lista-errori').append($("<li>").text(elem.getAttribute('title')));
                } else {
                    if (['Dossier[password]', 'Dossier[confirm-password]'].includes(elem.getAttribute("name")) && !cambioPassword) {
                        $(elem).val('');
                    }
                    if (elem.getAttribute("name") === 'Dossier[newsletter]') {
                        if ($(elem).is(":checked")) {
                            $(elem).val('1');
                        } else {
                            $(elem).val('0');
                        }
                    }
                    valueForm.append(elem.getAttribute("name"), $(elem).val());
                    if (!['hidden', 'password'].includes(elem.getAttribute('type'))) {
                        const elementoLabel = elem.parentElement.parentElement.getElementsByClassName("campo-bloccato");
                        if (elementoLabel) {
                            if (elem.getAttribute("name") === 'Dossier[newsletter]') {
                                if ($(elem).is(":checked")) {
                                    elementoLabel[0].innerHTML = 'Attiva';
                                } else {
                                    elementoLabel[0].innerHTML = 'Disattiva';
                                }
                            } else {
                                elementoLabel[0].innerHTML = $(elem).val();
                            }
                        }
                    }
                }
            });

            if (!validita) {
                infoModal.getElementsByClassName("modal-title")[0].innerHTML = 'Errore';
                infoModal.getElementsByClassName("modal-body")[0].innerHTML = infoModalErrors[0].innerHTML;
                modal.show();
                return false;
            }
            valueForm.append("operation-type", 'ACCOUNT');

            $.ajax({
                type: "POST",
                url: '/index.php?r=dossier/UpdateAccount',
                data: valueForm,
                processData: false,
                contentType: false,
                success: function (resp) {
                    const jsonResp = JSON.parse(resp);
                    switch (jsonResp.status) {
                        case 'SUCCESS':
                            infoModal.getElementsByClassName("modal-title")[0].innerHTML = 'Successo';
                            infoModal.getElementsByClassName("modal-body")[0].innerHTML = '<p>I dati del tuo account sono stati modificati con successo.</p>';
                            if (cambioDati) {
                                $("form .campo-bloccato, .modifica-dati-utente-button, .dossier .conferma-cambio, .dossier form .campo-editabile:not(.campo-password)").toggleClass("active");
                                cambioDati = !cambioDati;
                            }
                            if (cambioPassword) {
                                $(".dossier .modifica-password-utente-button, .dossier .conferma-cambio, .dossier form .campo-password.campo-editabile").toggleClass("active");
                                cambioPassword = !cambioPassword;
                            }
                            if (cambioPassword || cambioDati) {
                                $(".dossier .conferma-cambio").addClass('active');
                            } else {
                                $(".dossier .conferma-cambio").removeClass('active');
                            }

                            break;
                        case 'INVALID':
                            infoModal.getElementsByClassName("modal-title")[0].innerHTML = 'Invalido';
                            infoModal.getElementsByClassName("modal-body")[0].innerHTML = `
                        <p>I dati inseriti non risultano validi.<br/>La modifica dell'account è stata interrotta.
                        <br>
Se credi di aver inserito correttamente tutti i dati, per favore, contatta <a href="mailto:<?= $applicationParams->adminEmail ?>">l'amministratore di sistema</a> per risolvere il problema.
                        </p>`;
                            break;
                        case 'ERROR':
                            infoModal.getElementsByClassName("modal-title")[0].innerHTML = 'Errore';
                            infoModal.getElementsByClassName("modal-body")[0].innerHTML = `
                        <p>Si &egrave; verificato un errore durante il processo di salvataggio dei dati.<br/>
                La modifica dell'account è stata interrotta.
                        <br>
                        Per favore contatta <a href="mailto:<?=$applicationParams->adminEmail?>">l'amministratore di sistema</a> per risolvere il problema.
                        </p>`;
                            break;
                    }
                    modal.show();
                }
            });
        });

        $(".dossier #password").bind("blur", function () {
            if ($(".dossier #password").val() !== '') {
                $(".dossier #confirm-password").attr("required", "required");
            } else {
                $(".dossier #confirm-password").removeAttr("required");
            }
            checkPasswordMatch();
        });

        $(".dossier #confirm-password").bind("blur", function () {
            if ($("#confirm-password").val() !== '') {
                $(".dossier #password").attr("required", "required");
            } else {
                $(".dossier #password").removeAttr("required");
            }
            checkPasswordMatch();
        });

        function checkPasswordMatch() {
            const password = $(".dossier #password").val(),
                confPass = $(".dossier #confirm-password").val();
            if (password !== '' && confPass !== '' && password !== confPass) {
                $(".dossier #confirm-password").attr("data-invalid", "invalid");
                $(".dossier #confirm-password-msg").css("visibility", "visible");
            } else {
                $(".dossier #confirm-password").removeAttr("data-invalid");
                $(".dossier #confirm-password-msg").css("visibility", "hidden");
            }
        }
    });
</script>
<?php endif; ?>
