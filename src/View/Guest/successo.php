<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var \App\Model\Entity\Guest\CasiSuccessoDTO $caso
 * @var \App\Model\Repository\Guest\DatiLeve $datiLeve
 * @var array $benefici
 * @var string $share_link
 */

$this->setTitle($applicationParams->name . " - Successo");
?>

<div class="pagina-successo">
    <div class="row mb-2">
        <div class="col">
            <p class="titolo-caso-successo"><?= $caso->nome_prodotto ?>
                <span style="margin-left:2rem; cursor: pointer; color: #f00" onclick="javascript:generaPdf()">
                    <i class="fa-regular fa-file-pdf"></i>
                </span>
                <span style="cursor:pointer;margin-left: 2rem;" onclick="javascript:condividiCaso()">
                    <i class="fa-solid fa-share-nodes"></i>
                </span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="azienda-caso-successo"><?= $caso->azienda ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-3 product-image">
            <?php if ($caso->product_image != null): ?>
                <?php if (str_contains($caso->product_image, 'http:') || str_contains($caso->product_image, 'https:')): ?>
                    <img src="<?= $caso->product_image ?>"/>
                <?php else: ?>
                    <img src="/<?= $caso->product_image ?>"/>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="col col-lg-9">
            <div class="row">
                <div class="col">
                    <p class="settore-caso-successo"><?= $caso->categoria ?></p>
                    <p class="materiale-caso-successo"><i><?= $caso->materiale ?></i></p>
                    <div class="descrizione-caso-successo">
                        <?= html_entity_decode($caso->descrizione_prodotto) ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="prevenzione-caso-successo">Leve di prevenzione</p>
                            <div class="row row-cols-3 elenco-leve">
                                <?php
                                foreach (explode(",", $caso->leve) as $id_leva):
                                    $leva_per2 = explode("x2", $id_leva);
                                    if (count($leva_per2) == 2) {
                                        $leva = $datiLeve->findById((int)$leva_per2[0]);
                                    } else {
                                        $leva = $datiLeve->findById((int)$id_leva);
                                    }
                                    ?>
                                    <div class="col-12 col-sm-4">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="/<?= $leva->path_immagine ?>"/>
                                            </div>
                                            <div class="col-9">
                                                <p><?= $leva->descrizione ?> <?= count($leva_per2) == 2 ? 'x2' : '' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="text-align: left;color: black">
                            <p class="risultati-caso-successo">Risultati</p>
                            <p style="font-size: 1rem">
                                <b>Campo di applicazione:</b> <?= $caso->campo_applicazione ?><br>
                                <b>Fonte:</b> Eco Tool CONAI
                            </p>
                            <?php
                            if ($caso->mps_image != null || $caso->impatti != null): ?>
                                <div class="descrizione-caso-successo">
                                    <?php
                                    if ($caso->impatti != null): ?>
                                        I risultati dell'analisi del ciclo di vita (LCA semplificata) dell'imballaggio, secondo tre indicatori ambientali: emissioni di CO₂, consumi energetici e consumi idrici.
                                        <br><br>
                                    <?php
                                    endif; ?>
                                    <?php
                                    if ($caso->mps_image != null): ?>
                                        Un altro indicatore &egrave; il Material for recycling (gi&agrave; MPS). Valuta la quantit&agrave; di materia prima seconda generabile dalle operazioni di valorizzazione dell'imballaggio a fine vita, considerando lo scenario medio italiano. Tale materiale pu&ograve; così rientrare come materia prima all'interno di un altro processo produttivo. Pi&ugrave; &egrave; alto questo valore, maggiore &egrave; la quantit&agrave; di materia prima secondaria generata.
                                        <br><br>

                                    <?php
                                    endif; ?>
                                </div>
                            <?php
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($caso->mps_image != null || $caso->impatti != null): ?>
        <div class="row graphic-images">
            <div class="col-12 col-lg-3 col-md-3">
                <?php
                if ($caso->mps_image != null):
                    if (str_contains($caso->mps_image, 'http:') || str_contains($caso->mps_image, 'https:')): ?>
                        <img src="<?= $caso->mps_image ?>"/>
                    <?php else: ?>
                        <img src="/<?= $caso->mps_image ?>"/>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-12 col-lg-7 col-md-7">
                <?php if ($caso->impatti != null):
                    foreach ($benefici as $beneficio): ?>
                        <div class="row mb-3 beneficio-row"
                             style="display: flex; align-items: center; justify-content: center;"
                             data-row="<?= $beneficio['id'] ?>">
                            <div class="col-2">
                                <img src="<?= $aliases->get($beneficio['img']) ?>"
                                     alt="<?= $beneficio['altImage'] ?>"
                                     style="max-width:100%"></div>
                            <div class="col-2"><h4
                                    style="text-align: left; font-size: .875rem"><?= $beneficio['label'] ?></h4>
                            </div>
                            <div class="col-8 pl-0">
                                <div class="<?= $beneficio['value']['dopo']['class'] ?>"
                                     style="width: <?= $beneficio['value']['dopo']['value'] ?>%;" data-value="dopo"> Dopo
                                </div>
                                <div class="<?= $beneficio['value']['prima']['class'] ?>"
                                     style="width: <?= $beneficio['value']['prima']['value'] ?>%;" data-value="prima"> Prima
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                    <div class="row" style="text-align: right">
                        <div class="col-4 pr-0"> 0%|</div>
                        <div class="col-8 pl-0">
                            <div class="row">
                                <div class="col-3"> 25%|</div>
                                <div class="col-3"> 50%|</div>
                                <div class="col-3"> 75%|</div>
                                <div class="col-3"> 100%|</div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php
    endif; ?>
</div>
<?= $this->render($aliases->get('@view/Generic/_alert_modal'), [
    'modal_label' => "Condividi",
    'body' => "<p>Il link da condividere è il seguente (cliccaci per copiarlo negli appunti):<br> <i class='link-pagina' style='cursor: pointer;' onclick='javascript:copiaInAppunti()'></i></p>"
]) ?>
<script type="text/javascript">
    function generaPdf() {
        window.open(`/guest/generaPdf/<?= $caso->id ?>`)
    }

    function condividiCaso () {
        const modale = document.getElementById('alertInfo');
        modale.querySelector('.link-pagina').innerHTML = "<b>link da condividere</b><span class='message'></span>";
        const modal = new bootstrap.Modal(modale);

        modal.show();
    }

    function copiaInAppunti () {
        navigator.clipboard.writeText('<?= $share_link ?>').then(function() {
            const modale = document.getElementById('alertInfo');
            modale.querySelector('.link-pagina .message').innerHTML = "<br>(Testo copiato negli appunti)";
        })
    }
</script>


