<?php

declare(strict_types=1);

use App\Layout\Conai\MainAsset;
use Yiisoft\Html\Html;

/**
 * @var App\ApplicationParams $applicationParams
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var string $content
 * @var string|null $csrf
 * @var Yiisoft\View\WebView $this
 * @var Yiisoft\Router\CurrentRoute $currentRoute
 * @var Yiisoft\Router\UrlGeneratorInterface $urlGenerator
 * @var Yiisoft\User\CurrentUser $currentUser
 * @var App\Utility\UtilityFaseTwo $utilityFaseTwo
 */

$assetManager->register(MainAsset::class);

$this->addCssFiles($assetManager->getCssFiles());
$this->addCssStrings($assetManager->getCssStrings());
$this->addJsFiles($assetManager->getJsFiles());
$this->addJsStrings($assetManager->getJsStrings());
$this->addJsVars($assetManager->getJsVars());

$this->beginPage();

if ($currentUser->isGuest()) {
    $dossierUrl = ["/dossier/login"];
    $dossierCasi = ["/dossier/login"];
} else {
    $dossierUrl = ["/dossier/index"];
    $dossierCasi = ["/dossier/casi"];
}
$menu_links = [
    ['title' => "Homepage", 'url_direct' => "/"],
    ['title' => "Istruzioni per l'uso", 'url_direct' => $aliases->get('@baseUrl/documents/Conai_EcoTool_istruzioni_03.pdf')],
    ['title' => "Regolamento bando", 'url_direct' => $aliases->get('@baseUrl/documents/Regolamento_2025.pdf')]
];
if (isset($currentUser->tipo_utente) && $currentUser->tipo_utente !== 'EDI') {
    $menu_links[] = ['title' => "Casi di esempio", 'url' => "site/esempi"];
}
$menu_links[] = ['title' => "Info e contatti", 'url' => "site/contact"];
$menu_links[] = ['title' => "Informativa privacy", 'url_direct' => $aliases->get('@baseUrl/documents/privacy.pdf')];

?>
<!DOCTYPE html>
<html lang="<?= Html::encode($applicationParams->locale) ?>">
<head>
    <meta charset="<?= Html::encode($applicationParams->charset) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= $csrf ?>">
    <link rel="icon" href="<?= $aliases->get('@baseUrl/img/conai_ico.png') ?>" type="image/x-icon">
    <title><?= Html::encode($this->getTitle()) ?></title>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/bootstrap/css/bootstrap.min.css', 'css') ?>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/tempus-dominus/css/tempus-dominus.min.css', 'css') ?>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/fa/css/all.css', 'css') ?>
    <?= $utilityFaseTwo->generaUrlHTML('/css/select2.min.css', 'css') ?>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/jquery_3.7.1.min.js', 'js') ?>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/jquery-ui.min.js', 'js') ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container" id="page" style="max-width: 100%;">

    <div id="header" class="row">
        <div class="col internal-box">
            <div class="header-logged-out">
                <div class="loghi">
                    <img class="conai-logo" src="<?= $aliases->get('@baseUrl/img/image-1.png') ?>"/>
                    <img class="eco-logo" src="<?= $aliases->get('@baseUrl/img/image-29.png') ?>"/>
                    <img class="pensare-logo" src="<?= $aliases->get('@baseUrl/img/image-35.png') ?>"/>
                </div>
                <div class="barra-menu">
                    <div class="hamburger-icon" refer-menu="menu-orizzontale">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="image-wrapper" <?= (!$currentUser->isGuest()) ? 'onclick="javascript:openUser()"' : '' ?>>
                        <?php
                        if ($currentUser->isGuest()): ?>
                            <img class="image-2" src="<?= $aliases->get('@baseUrl/img/image-5.png') ?>"/>
                        <?php
                        endif; ?>
                    </div>
                </div>
                <?php
                if (!$currentUser->isGuest()): ?>
                    <?php
                $user_logged = $currentUser->getIdentity()->getUser();

                    if ($user_logged->tipo_utente !== 'EDI') {
                        $menu_links[] = ['title' => 'I miei casi inviati', 'url' => 'dossier/casi&reset_filter=1'];
                        $menu_links[] = ['title' => 'I miei casi in bozza', 'url' => 'dossier/bozze&reset_filter=1'];
                        if ($applicationParams->casi_successo):
                            $menu_links[] = ['title' => 'I miei casi di successo', 'url' => 'dossier/casi_successo&reset_filter=1'];
                        endif;
                        $menu_links[] = ['title' => 'Crea nuovo caso', 'url' => 'compare/new&nuovo_caso=1'];
                    } else {
                        $menu_links[] = ['title' => 'Crea Lettera', 'url' => 'admin/scheda'];
                    }
                    $immagine_account = $user_logged->immagine_profilo;
                    if ($user_logged->tipo_utente === 'LCE' || $user_logged->tipo_utente === 'CON') {
                        $voci_menu_amministrazione = [
                            ['title' => 'Anagrafica Utente', 'url' => 'admin/utenti']
                        ];
                        $voci_menu_amministrazione[] = [
                            'title' => 'Gestione candidature',
                            'url' => 'admin/casiInviati'
                        ];
                        $voci_menu_amministrazione[] = [
                            'title' => 'Gestione bozze',
                            'url' => 'admin/casiBozze'
                        ];
                        $voci_menu_amministrazione[] = ['title' => 'Attivit&agrave; di Prevenzione', 'url' => 'admin/prevenzione'];
                        $voci_menu_amministrazione[] = ['title' => 'Gestione storico database', 'url' => 'admin/versionidb'];
                        $voci_menu_amministrazione[] = ['title' => 'Crea Lettera', 'url' => 'admin/scheda'];
                        $voci_menu_amministrazione[] = ['title' => 'Statistiche Backend', 'url' => 'admin/statistiche'];

                        array_unshift($menu_links, [
                            'title' => 'Amministrazione',
                            'submenu' => [
                                'class' => 'amministrazione',
                                'voci' => $voci_menu_amministrazione
                            ]
                        ]);
                    }
                    ?>
                    <div class="account" style="display: none">
                        <div class="overlap-group">
                            <div class="ellipse immagine-account" <?php
                            if ($immagine_account) {
                                $immagine_account_splitted = explode("/", $immagine_account);
                                $web_immagine_account = $aliases->get('@uploadDestination') . $immagine_account_splitted[count(
                                        $immagine_account_splitted
                                    ) - 1];
                                echo "style='background: url(\"$web_immagine_account\") 50% 50% / contain no-repeat'";
                            }
                            ?>>
                                <img src="<?= $aliases->get('@baseUrl/img/matita.png') ?>"/>
                                <input type="file" accept="image/*" style="display: none"
                                       name="header-immagine-account"/>
                            </div>
                            <div class="text-wrapper"
                                 style="color: white; margin: 0 auto;"><?= $user_logged->referente ?></div>
                            <div class="rectangle"></div>
                            <div class="text-wrapper" style="margin-top: -30px;">
                                <a href="/dossier/index">Il mio
                                    account</a>
                            </div>
                            <div class="rectangle"></div>
                            <div class="text-wrapper" style="margin-top: -30px">
                                <a href="/site/logout">Logout</a>
                            </div>
                        </div>
                    </div>
                <?php
                endif; ?>
                <div class="menu-orizzontale" style="display:none">
                    <div class="overlap">

                        <?php
                        for ($i = 0; $i < count($menu_links); $i++): ?>
                            <?php
                            $sub_url = '';
                            if (isset($menu_links[$i]['url'])) {
                                $sub_url = $menu_links[$i]['url'];
                            } elseif (isset($menu_links[$i]['url_direct'])) {
                                $sub_url = $menu_links[$i]['url_direct'];
                            }
                            $path = $sub_url;
                            if (isset($menu_links[$i]['view'])) {
                                $path .= "&view=" . $menu_links[$i]['view'];
                            }

                            ?>

                            <?php
                            if (isset($menu_links[$i]['submenu'])): ?>
                                <div class="text-wrapper-2 <?= isset($menu_links[$i]['submenu']) ? 'open-' . $menu_links[$i]['submenu']['class'] : '' ?>" <?= $i == 0 ? 'style="border-top: 2px solid white"' : '' ?>>
                                    <?= $menu_links[$i]['title'] ?> <span class="arrow-right">&#8680;</span>
                                    <div class="menu-orizzontale-<?= $menu_links[$i]['submenu']['class'] ?>"
                                         style="display: none; <?= $i == 0 ? 'border-top: 1px solid white;' : '' ?>">
                                        <div class="overlap">
                                            <?php
                                            foreach ($menu_links[$i]['submenu']['voci'] as $submenu): ?>
                                                <a class="text-wrapper-2" href="<?= $submenu['url'] ?>"><?= $submenu['title'] ?>
                                                </a>
                                            <?php
                                            endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            else: ?>
                                <a class="text-wrapper-2" href="<?= $path ?>"><?= $menu_links[$i]['title'] ?></a>
                            <?php
                            endif; ?>
                        <?php
                        endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- header -->

<div class="row" id="main">
    <div id="content" class="col">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="box-footer">
        <div class="row" style="margin-top: 2rem;text-align: center;">
            <div class="col-md-3">
                <span>
                    <b>Sede legale:</b><br/>
                    Via Tomacelli 132<br/>
                    00186 Roma<br/>
                    Tel. 06.684141<br/>
                    Fax 06.68809630
                </span>
            </div>
            <div class="col-md-3">
                <span>
                    <b>Sede operativa:</b><br/>
                    Via Litta 520122 Milano<br/>
                    Tel. 02.54044242<br/>
                    Fax 02.54122648
                </span>
            </div>
            <div class="col-md-3">
                <span>
                    <b>C.F. / P.I.</b>&nbsp;05451271000<br/>
                    R.I. Roma<br/>
                    REA 888272<br/><br/>
                    <b>Fax dichiarazioni</b><br/>
                    02.54122656/680
                </span>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col" style="float: right; text-align: right">Ottimizzato per:</div>
                    <div class="col">
                            <span style="float: left"><img style="width: 32px;" src="<?= $aliases->get('@baseUrl/img/chrome.png') ?>"/><img
                                    style="width: 26px;" src="<?= $aliases->get('@baseUrl/img/edge.png') ?>"/></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="float: right; text-align: right">Powered by:</div>
                    <div class="col">
                            <span style="float: left"><img style="width: 32px;" src="<?= $aliases->get('@baseUrl/img/lce.png') ?>"/><img
                                    style="width: 107px;" src="<?= $aliases->get('@baseUrl/img/zproto.png') ?>"/></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/fa/js/all.min.js', 'js', true) ?>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/popperjs/js/popper.min.js', 'js') ?>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/bootstrap/js/bootstrap.bundle.min.js', 'js') ?>
    <?= $utilityFaseTwo->generaUrlHTML('/libraries-web/tempus-dominus/js/tempus-dominus.min.js', 'js') ?>
    <?= $utilityFaseTwo->generaUrlHTML('/js/select2.min.js', 'js') ?>

    <script type="text/javascript">
        <?php if (!$currentUser->isGuest()): ?>
        $(document).bind('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
        });
        $(document).bind('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
        });
        window.configSelect = {
            placeholder: '',
            allowClear: true,
            minimumInputLength: 3,
            dropdownCssClass: 'select-custom',
            formatInputTooShort: function(input, min) {
                const n = min - input.length;
                return 'Per favore inserisci ' + n + ' o più caratteri';
            },
            formatNoMatches: function() {
                return 'Nessun risultato trovato';
            },
            formatSearching: function() {
                return 'Sto cercando...';
            },
            formatLoadMore: function() {
                return 'Caricando più risultati...';
            },
            formatSelectionTooBig: function(limit) {
                let message = 'Puoi selezionare solo ' + limit + ' element';
                if (limit !== 1) {
                    message += 'i';
                } else {
                    message += 'o';
                }
                return message;
            },
            formatInputTooLong: function(input, max) {
                const overChars = input.length - max;
                let message = 'Per favore cancella ' + overChars + ' caratter';
                if (overChars !== 1) {
                    message += 'i';
                } else {
                    message += 'e';
                }
                return message;
            },

        };
        <?php endif; ?>
        function apriLink(url) {
            location.href = encodeURIComponent(url);
        }

        $(document).ready(function() {
            <?php if (!$currentUser->isGuest() && $applicationParams->chatbot): ?>
            window.renderZProtocolWidget('chat-container');
            <?php endif; ?>
            $('.hamburger-icon').click(function() {
                const referMenu = $(this).attr('refer-menu');
                $('.' + referMenu).toggle();
                $(this).toggleClass('open');
            });
            <?php if (!$currentUser->isGuest()):
            $user_logged = $currentUser->getIdentity()->getUser();
            if ($user_logged->tipo_utente === 'LCE' || $user_logged->tipo_utente === 'CON'): ?>
            $('.open-amministrazione').click(function() {
                function animateRotate(angle, selector) {
                    const elem = $(selector);
                    $({deg: 0}).animate({deg: angle}, {
                        step: function(now) {
                            elem.css({
                                transform: 'rotate(' + now + 'deg)',
                            });
                        },
                    });
                }

                const menuAmministrazione = $('.menu-orizzontale-amministrazione');
                if (menuAmministrazione.hasClass('open')) {
                    menuAmministrazione.removeClass('open');
                    menuAmministrazione.animate({'left': '0', 'opacity': '0'}, {
                        complete: function() {
                            menuAmministrazione.hide();
                        },
                    });
                    animateRotate('0', '.open-amministrazione .arrow-right');
                } else {
                    menuAmministrazione.addClass('open');
                    menuAmministrazione.show();
                    menuAmministrazione.animate({'left': '315px', 'opacity': '1'});
                    animateRotate('-180', '.open-amministrazione .arrow-right');
                }
            });
            <?php endif; ?>

            $('#header .immagine-account img').click(function(e) {
                $('#header .immagine-account input[name=\'header-immagine-account\']').val('');
                $('#header .immagine-account input[name=\'header-immagine-account\']').click();
            });

            $('#header .immagine-account input[name=\'header-immagine-account\']').change(function(e) {
                const file = e.target.files[0];
                manageImage([file]);
            });

            $('#header .immagine-account').bind('drop', function(e) {
                e.preventDefault();

                const files = e.originalEvent.dataTransfer.files;

                manageImage(files);
            });
        });

        function openUser() {
            $('#header .header-logged-out .account').toggle();
        }

        function newConfronto() {
            window.location.href = '/index.php?r=compare/new&nuovo_caso=true';
        }

        function manageImage(files) {
            if (files.length > 0 && files[0].type.indexOf('image') !== -1) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    $('.dossier .riquadro-immagine-profilo, #header .immagine-account').each(function(index, elem) {
                        elem.style.background = 'url(\'' + event.target.result + '\')';
                        elem.style.backgroundRepeat = 'no-repeat';
                        elem.style.backgroundSize = 'contain';
                        elem.style.backgroundPositionX = 'center';
                        elem.style.backgroundPositionY = 'center';
                    });
                    inviaImmagine(files[0]);
                };

                reader.readAsDataURL(files[0]);
            }
        }
        <?php else: ?>
        });
        <?php endif; ?>
    </script>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
