<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var Yiisoft\Aliases\Aliases $aliases
 */

$this->setTitle($applicationParams->name . " - Contatti");
?>

<div class="contatti">
    <div class="row">
        <div class="col">
            <h2>Info e Contatti</h2>
        </div>
    </div>
    <div class="row">
        <p>
            Per qualsiasi informazione o proposta di miglioramento è possibile contattarci ai seguenti riferimenti:
        </p>
    </div>
    <div class="row" style="line-height: 2rem;">
        <p>
            <img src="<?= $aliases->get('@baseUrl/img/telefono-contatti.png') ?>" width="22px"/> <b>Telefono</b><br>02.54044242 / 02.54044256 / 02.54044253
        </p>
    </div>
    <div class="row" style="line-height: 2rem;">
        <p>
            <img src="<?= $aliases->get('@baseUrl/img/email-contatti.png') ?>" width="22px"/> <b>Email</b><br><a href="mailto:<?= $applicationParams->conaiInfoMail ?>"><?= $applicationParams->conaiInfoMail ?></a>
        </p>
    </div>
</div>
