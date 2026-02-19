<?php


/**
 * @var App\Utility\UtilityFaseTwo $utilityFaseTwo
 * @var App\Model\Entity\CasiSuccessoDTO $caso
 * @var App\Model\Repository\DatiLeve $datiLeve
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var array $benefici
 */
$images = [
    'image-1' => '@' . preg_replace('#^data:image/[^;]+;base64,#', '', $utilityFaseTwo->getBase64FromImage('/img/image-1.png')),
    'image-29' => '@' . preg_replace('#^data:image/[^;]+;base64,#', '', $utilityFaseTwo->getBase64FromImage('/img/image-29.png')),
    'image-35' => '@' . preg_replace('#^data:image/[^;]+;base64,#', '', $utilityFaseTwo->getBase64FromImage('/img/image-35.png')),
];

?>
<style>
  .page-break {
    page-break-before: always;
  }
</style>
<table border="0" cellpadding="4" cellspacing="4">
    <tr>
        <td align="left">
            <img src="<?= $images['image-1'] ?>" width="127">
        </td>
        <td align="center">
            <img src="<?= $images['image-29'] ?>" width="90">
        </td>
        <td align="right">
            <img src="<?= $images['image-35'] ?>" width="182">
        </td>
    </tr>
</table>

<h1 style="text-align: left;color: #2c6489"><?= $caso->nome_prodotto ?></h1>
<p style="text-align: left;color: #2c6489"><?= $caso->azienda ?></p>

<table border="0" cellpadding="4" cellspacing="4" width="100%">
    <tr>
        <td width="25%">
            <?php if ($caso->product_image): ?>
				<?php if (str_contains($caso->product_image, 'http:') || str_contains($caso->product_image, 'https:')): ?>
					<img src="<?= $caso->product_image ?>"/>
				<?php else: ?>
					<img src="<?= '@' . preg_replace('#^data:image/[^;]+;base64,#', '', $utilityFaseTwo->getBase64FromImage("/". $caso->product_image)) ?>"/>
				<?php endif; ?>
            <?php else: ?>
            &nbsp;
            <?php endif; ?>
        </td>
        <td width="75%">
            <h3 style="text-align: left;"><?= $caso->categoria ?></h3>
            <p style="font-style: italic; text-align: left;color: #2c6489"><?= $caso->materiale ?></p>
            <p style="text-align: left;"><?= html_entity_decode($caso->descrizione_prodotto) ?></p>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><h3 style="text-align: left;">Leve di prevenzione</h3></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <table width="100%">
                <tr>
                    <?php

                    foreach (explode(",", $caso->leve) as $id_leva):
                        $leva_per2 = explode("x2", $id_leva);
                        if (count($leva_per2) == 2) {
                            $leva = $datiLeve->findById((int)$leva_per2[0]);
                        } else {
                            $leva = $datiLeve->findById((int)$id_leva);
                        }
                        ?>
                        <td>
                            <img src="<?= '@' . preg_replace('#^data:image/[^;]+;base64,#', '', $utilityFaseTwo->getBase64FromImage("/" . $leva->path_immagine)) ?>" width="30px">
                        </td>
                        <td><?= $leva->descrizione ?> <?= count($leva_per2) == 2 ? 'x2' : '' ?></td>
                    <?php
                    endforeach; ?>
                </tr>
            </table>

        </td>
    </tr>
</table>
<div class="page-break"></div>
<table border="0" cellpadding="4" cellspacing="4" width="100%">
    <tr>

        <td colspan="2"><h3 style="text-align: left;">Risultati</h3></td>
    </tr>
    <tr>

        <td colspan="2">
            <p style="text-align: left;">
                <b>Campo di applicazione:</b> <?= $caso->campo_applicazione ?><br>
                <b>Fonte:</b> Eco Tool CONAI
            </p>
            <?php
            if ($caso->impatti != null || $caso->mps_image != null): ?>
                <p style="text-align: left;">I risultati dell'analisi del ciclo di vita (LCA semplificata)
                    dell'imballaggio secondo
                    i tre indicatori ambientali: emissioni di CO<sub>2</sub>, consumi energetici e consumi idrici.</p>
            <?php
            endif; ?></td>
    </tr>
    <?php
    if ($caso->mps_image != null): ?>
        <tr>

            <td colspan="2">Un altro indicatore &egrave; il Material for recycling (gi&agrave; MPS). Valuta la quantit&agrave; di
                materia prima seconda generabile dalle operazioni di valorizzazione dell'imballaggio a fine vita,
                considerando lo scenario medio italiano. Tale materiale pu&ograve; così rientrare come materia prima
                all'interno di un altro processo produttivo. Pi&ugrave; &egrave; alto questo valore, maggiore &egrave;
                la quantit&agrave; di materia prima secondaria generata.
                <br><br></td>
        </tr>
    <?php
    endif; ?>
    <tr>
        <td colspan="2">
            <table width="100%">
                <tr>
                    <td <?= $caso->mps_image != null ? 'width="35%"': 'width="25%"' ?>>
                        <?php
                        if ($caso->mps_image != null): ?>
                            <?php if (str_contains($caso->mps_image, 'http:') || str_contains(
                                    $caso->mps_image,
                                    'https:'
                                )): ?>
								<img src="<?= $caso->mps_image ?>"/>
							<?php else: ?>
								<img src="<?= '@' . preg_replace('#^data:image/[^;]+;base64,#', '', $utilityFaseTwo->getBase64FromImage("/" . $caso->mps_image)) ?>"/>
							<?php endif; ?>
                        <?php
                        else: ?>
                            &nbsp;
                        <?php
                        endif; ?>
                    </td>
                    <td>
                        <table width="100%" style="font-size:12pt;line-height:12pt">
                            <?php
                            foreach ($benefici as $beneficio): ?>

                                <tr style="align-content: center">
                                    <td style="text-align: right;">
                                        <img src="<?= '@' . preg_replace('#^data:image/[^;]+;base64,#', '', $utilityFaseTwo->getBase64FromImage($aliases->get($beneficio['img']))) ?>" width="48pt">
                                    </td>
                                    <td style="text-align: right;" width="15%">
                                        <div style="font-size:6pt">&nbsp;</div>
                                        <b><?= $beneficio['label'] ?></b>
                                    </td>
                                    <td width="75%">
                                        <div style="font-size:1pt">&nbsp;</div>
                                        <table width="100%" style="line-height: 12pt;font-size:6pt">
                                            <tr>
                                                <td width="100%">
                                                    <table width="<?= $beneficio['value']['dopo']['value'] ?>%" style="background-color: <?= $beneficio['value']['dopo']['color-background'] ?>">
                                                        <tr>
                                                            <td>Dopo</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%">
                                                    <table width="<?= $beneficio['value']['prima']['value'] ?>%" style="background-color: <?= $beneficio['value']['prima']['color-background'] ?>">
                                                        <tr>
                                                            <td>Prima</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>

                            <?php
                            endforeach; ?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
