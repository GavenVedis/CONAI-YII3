<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var array $users
 * @var Yiisoft\Aliases\Aliases $aliases
 */

$this->setTitle($applicationParams->name);
?>

<div class="home container">
    <div class="row">
        <div class="col">
            <p class="title-page">Benvenuto in Ecopack Conai</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col mb-3">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <a href="/dossier/index">
                            <img src="<?= $aliases->get('@baseUrl/img/attrezzi.png') ?>"/>
                        </a>
                    </p>
                    <h5 class="card-title">Accesso al Bando</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 col mb-3">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <a href="/guest/successi">
                            <img src="<?= $aliases->get('@baseUrl/img/premio.png') ?>"/>
                        </a>
                    </p>
                    <h5 class="card-title">Casi di successo</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 col mb-3">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <a href="/guest/statistiche">
                            <img src="<?= $aliases->get('@baseUrl/img/statistiche.png') ?>"/>
                        </a>
                    </p>
                    <h5 class="card-title">Statistiche</h5>
                </div>
            </div>
        </div>
    </div>
    <?php if ($applicationParams->nuova_homepage): ?>
        <div class="row">
            <div class="col-6 col-md-4 mb-md-3 align-content-center">
                <p class="mb-3" style="font-size: 20px">CONAI pubblica il regolamento del bando CONAI per l'ecodesign 2025</p>
                <p class="mb-3" style="font-size: 16px"><a href="<?= $aliases->get('@baseUrl/documents/Regolamento_2025.pdf') ?>" target="_blank" style="color: rgb(46, 146, 53);">Regolamento 2025</a></p>
                <p class="mb-3" style="font-size: 16px"><a href="<?= $aliases->get('@baseUrl/documents/df62f7ac237075ad848605c866b739a1AS_SC251116-20211109-CONAI_Dichiarazione_VerificaBando%20Ecodesign%202021_rev.01.pdf') ?>" target="_blank" style="color: rgb(46, 146, 53);">Verificato da DNV</a></p>
            </div>
            <div class="col-6 col-md-4 mb-md-3">
                <p style="font-size: 20px">Video tutorial Area Bando:</p>
                <div style="text-align: center; margin: auto;">
                    <iframe width="100%" height="247"
                            src="https://www.youtube.com/embed/V6meC0tP5zg?rel=0&amp;autohide=1&amp;showinfo=0"
                            allowfullscreen="">
                    </iframe>
                </div>
            </div>
            <div class="col-6 col-md-4 mb-md-3 align-content-center">
                <p class="mb-3" style="font-size: 20px">Link utili</p>
                <p class="mb-3" style="font-size: 16px"><a href="/site/ecopacking" target="_blank" style="color: rgb(46, 146, 53);">Le leve di ecodesign</a></p>
                <p class="mb-3" style="font-size: 16px"><a href="/site/glossary" target="_blank" style="color: rgb(46, 146, 53);">Glossario</a></p>
            </div>
        </div>
    <?php endif; ?>
</div>
