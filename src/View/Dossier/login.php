<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var array $users
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var \Yiisoft\User\CurrentUser $currentUser
 */

$this->setTitle($applicationParams->name);
?>

<?php if (!$currentUser->isGuest()): ?>
    <script>window.location = "/";</script>
<?php endif; ?>
<div id="dossier-login-form">
<fieldset>
    <legend>Login</legend>
    <label for="username">Username: </label>
    <input type="text" id="username" name="username" required/>
    <div id="username-msg" class='login-msg' style="margin-top: 0px; margin-bottom: 0px;">Account inesistente</div>
    <label for="password">Password: </label>
    <input type="password" id="password" name="password" required/>
    <div id="password-msg" class='login-msg' style="margin-top: 0px; margin-bottom: 5px;">Password errata</div>
    <button type="submit" class="button" onclick="checkUserExistance(event)">Login</button>
    <div style="font-size:12px;">Non possiedi ancora un account? Registrati <a href="/dossier/register"> QUI</a>.</div>

    <div id="add-task-wrapper" style="width: 70%; padding: 0; text-align: center; margin: 0 auto;">
        <span id="add-task" class="button">Password dimenticata?</span>
    </div>
    <div id="forgotten-psw-wrapper" style="display:none;">
        <div class="fpsw-msg" style="margin-bottom: 10px">
            Prego, inserire l'indirizzo mail associato all'account del quale si desidera recuperare i dati di accesso.<br/>
            Una nuova password verrà generata e sarà spedita via mail all'indirizzo sopra indicato.
        </div>
        <label for="fpsw-email" style='width:auto;'>Email: </label>
        <input type="text" name="fpsw-email" id="fpsw-email" style='width:200px;'/>
        <br/>
        <button id="forgotten-psw-submit" class="button" style="margin: 10px 0">Richiedi</button>
        <img id="loader-fpsw" src="<?= $aliases->get('@baseUrl/img/loader.gif') ?>" class="loader-fpsw"/>
        <div id="error-msg" style="display:none;">La mail specificata non corrisponde a nessun account</div>
        <div id="success-msg" style='display:none;'>I dati di accesso sono stata inviati all'indirizzo specificato.<br/>Prego, controllare la propria casella Email.<br/>La pagina verr&agrave; ricaricata tra 5 secondi.</div>
    </div>

    <div id="add-user-wrapper" style="width: 70%; padding: 0; text-align: center; margin: 0 auto;">
        <span id="add-task" class="button">Username dimenticato?</span>
    </div>
    <div id="forgotten-user-wrapper" style="display:none;">
        <div class="fpsw-msg" style="font-size: 12px; line-height: 130%; margin: 10px 0">
            Prego, inserire l'indirizzo mail associato all'account del quale si desidera recuperare i dati di accesso.<br/>
            L'username utilizzato verrà spedito via mail all'indirizzo sopra indicato.
        </div>
        <label for="fpsw-email" style='width:auto;'>Email: </label>
        <input type="text" name="fpsw-email" id="fuser-email" style='width:200px;'/>
        <br/>
        <button id="forgotten-user-submit" class="button" style="margin-top: 10px">Richiedi</button>
        <img id="loader-fuser" src="<?= $aliases->get('@baseUrl/img/loader.gif') ?>" class="loader-fuser" style="display: none"/>
        <div id="success-msg-user" style='display:none; line-height: 130%; margin-top: 10px; font-size: 13px;'>I dati di accesso sono stata inviati all'indirizzo specificato.<br/>Prego, controllare la propria casella Email.<br/>La pagina verr&agrave; ricaricata tra 5 secondi.</div>
    </div>
</fieldset>
</div>



<script>

    function checkUserExistance(event) {
        clearMessages();
        const username = $("#username").val(),
            password = $("#password").val();
        let cacheRequest = '-1';
        if (localStorage['conai_cache']) {
            cacheRequest = JSON.parse(localStorage['conai_cache'])['dataCreazioneCache'];
        }
        if ($("#username").val() !== '' && $("#password").val() !== '') {
            event.preventDefault();
            $.ajax({
                url: "/dossier/checkUserExistance",
                type: "POST",
                data: {
                    username,
                    password,
                    cacheRequest,
                    '_csrf': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    var result = data;
                    switch (result.result) {
                        case "NO_USER":
                            $("#username-msg").css("visibility", "visible");
                            break;
                        case "WRONG_PASS":
                            $("#password-msg").css("visibility", "visible");
                            break;
                        case "INVALID":
                            alert("Si è verificato un errore di comunicazione con il server");
                            break;
                        default:
                            if (result?.cache_generated !== 'false') {
                                localStorage.setItem('conai_cache', JSON.stringify(result.cache_generated));
                            }
                            location.href = '/dossier/index';
                            break;
                    }
                }
            });
        } else {
            return false;
        }
    }

    function clearMessages() {
        $("#username-msg").css("visibility", "hidden");
        $("#password-msg").css("visibility", "hidden");
    }

    $(document).ready(function () {

        $("#add-task-wrapper").click(function () {
            if ($("#forgotten-psw-wrapper").is(":hidden")) {
                $("#forgotten-psw-wrapper").slideDown("slow");
            } else {
                $("#forgotten-psw-wrapper").slideUp("slow");
            }
        });

        $("#add-user-wrapper").click(function () {
            if ($("#forgotten-user-wrapper").is(":hidden")) {
                $("#forgotten-user-wrapper").slideDown("slow");
            } else {
                $("#forgotten-user-wrapper").slideUp("slow");
            }
        });

        $("#forgotten-psw-submit").bind("click", function (e) {
            e.preventDefault();
            $("#loader-fpsw").css("display","block");
            var mail = $("#fpsw-email").val();
            if (mail !== '') {
                $.ajax({
                    url: "/dossier/send-password",
                    type: "POST", data: {mail: mail, '_csrf': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        $("#loader-fpsw").css("display","none")
                        var result = JSON.parse(data);
                        switch (result) {
                            case "NO_USER":
                                $("#error-msg").fadeIn("slow");
                                setTimeout(function () {
                                    $("#error-msg").fadeOut("slow");
                                }, 3000);
                                break;
                            case "INVALID":
                                alert("Prego, compilare correttamente il campo Email.");
                                break;
                            default:
                                $("#success-msg").fadeIn("slow");
                                setTimeout(function(){
                                    location.reload();
                                }, 5000);
                                break;
                        }
                    }
                });
            } else {
                alert("Prego, compilare correttamente il campo Email.");
                return false;
            }
        });

        $("#forgotten-user-submit").bind("click", function (e) {
            e.preventDefault();
            $("#loader-fuser").css("display","block");
            var mail = $("#fuser-email").val();
            $.ajax({
                url: "/dossier/send-username",
                type: "POST", data: {mail: mail, '_csrf': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $("#loader-fuser").css("display","none")
                    var result = data;
                    $("#success-msg-user").fadeIn("slow");
                    setTimeout(function(){
                        location.reload();
                    }, 5000);
                }
            });
        });
    });

</script>

