<?php

declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var Yiisoft\Aliases\Aliases $aliases
 */

$this->setTitle($applicationParams->name . " - Successi");
$enable_sottocategoria = false;
?>

<div id="successi-page" class="successi">
    <div class="row">
        <div class="col">
            <h2>Casi di successo</h2>
        </div>
    </div>
    <div class="row justify-content-md-center mb-3" style="margin-top: 1rem; margin-bottom: 1rem;">
        <div class="col col-lg-5">
            <fieldset>
                <legend>Casi di successo</legend>
                <div class="row mb-3">
                    <label for="categoria" class="col-sm-3 col-form-label">Categoria</label>
                    <div class="col col-sm-7">
                        <select class="form-control" id="categoria" name="categoria">
                            <option value="">Seleziona...</option>
                            <?php
                            foreach ($categorie as $key => $value): ?>
                                <option value="<?= $key ?>" <?= $value['selected'] ? 'selected' : '' ?>><?= $value['label'] ?></option>
                            <?php
                            endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php
                if ($enable_sottocategoria): ?>
                    <div class="row mb-3">
                        <label for="sottocategoria" class="col-sm-3 col-form-label">Sottocategoria</label>
                        <div class="col col-sm-7">
                            <select class="form-control" id="sottocategoria" name="sottocategoria">
                            </select>
                        </div>
                    </div>
                <?php
                endif; ?>
                <div class="row mb-3">
                    <label for="anno_bando" class="col-sm-6 col-form-label">Anno di intervento</label>
                    <div class="col col-sm-4">
                        <select class="form-control" id="anno_bando" name="anno_bando">
                            <option value="">Seleziona...</option>
                            <?php
                            foreach ($anni_bando as $key => $value): ?>
                                <option value="<?= $key ?>" <?= $value['selected'] ? 'selected' : '' ?>><?= $value['label'] ?></option>
                            <?php
                            endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="azienda" class="col-sm-3 col-form-label">Azienda</label>
                    <div class="col col-sm-7">
                        <select class="form-control" id="azienda" name="azienda">
                            <option value="">Seleziona...</option>
                            <?php
                            foreach ($aziende as $key => $value): ?>
                                <option value="<?= $key ?>" <?= $value['selected'] ? 'selected' : '' ?>><?= $value['label'] ?></option>
                            <?php
                            endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="brand_prodotto" class="col-sm-3 col-form-label">Brand / Prodotto</label>
                    <div class="col col-sm-7">
                        <select class="form-control" id="brand_prodotto" name="brand_prodotto">
                            <option value="">Seleziona...</option>
                            <?php
                            foreach ($nomi_prodotto as $key => $value): ?>
                                <option value="<?= $key ?>" <?= $value['selected'] ? 'selected' : '' ?>><?= $value['label'] ?></option>
                            <?php
                            endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="materiale" class="col-sm-3 col-form-label">Materiale</label>
                    <div class="col col-sm-7">
                        <select class="form-control" id="materiale" name="materiale">
                            <option value="">Seleziona...</option>
                            <?php
                            foreach ($materiali as $key => $value): ?>
                                <option value="<?= $key ?>" <?= $value['selected'] ? 'selected' : '' ?>><?= $value['label'] ?>
                                    (<?= $value['num'] ?>)
                                </option>
                            <?php
                            endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="leve" class="col-sm-3 col-form-label">Leve</label>
                    <div class="col col-sm-7">
                        <select class="form-control" id="leve" name="leve">
                            <option value="">Seleziona...</option>
                            <?php
                            foreach ($leve as $key => $value): ?>
                                <option value="<?= $key ?>" <?= $value['selected'] ? 'selected' : '' ?>><?= $value['label'] ?>
                                    (<?= $value['num'] ?>)
                                </option>
                            <?php
                            endforeach; ?>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row mb-3 justify-content-between" style="border-bottom: 1px solid #2C6489">
        <div class="col col-lg-2" style="font-size: 1.25rem; text-align: left">
            <p><b>Risultati: </b><i style="font-size: 1rem">(<?= count($elementi)?> elementi trovati)</i></p>
        </div>
        <div class="col col-lg-2" style="text-align: right">
            <div class="row mb-3">
                <label for="cerca" class="col-sm-3 col-form-label"
                       style="text-align: right;font-size: 1rem">Cerca</label>
                <div class="col col-sm-9">
                    <input type="text" class="form-control" id="cerca" name="cerca"/>
                </div>
            </div>
        </div>
    </div>
    <div class="risultati-container" style="max-height: 450px;overflow-y: scroll;overflow-x: hidden">
        <?php
        foreach ($elementi as $caso_successo): ?>
            <div class="row mb-3 riga-elemento" style="background-color: #98CAEB;margin: 0 auto;">
                <div class="col col-lg-6" style="display: flex;align-items: center">
                    <div class="row">
                        <div class="col"
                             style="text-align: left;display: flex;flex-direction: column;place-items: flex-start;align-items: flex-start;">
                            <h4><?= strtoupper($caso_successo->categoria) ?></h4>
                            <p class="link-to" style="color: black;font-size: 1.5rem;margin-bottom: .5rem;"
                               onclick="javascript:goToSuccesso('<?= $caso_successo->id ?>')">
                                <b><?= $caso_successo->nome_prodotto ?></b></p>
                            <p style="font-size: .75rem;margin-bottom: .5rem;"><?= strtoupper(
                                    $caso_successo->azienda
                                ) ?> / <?= strtoupper($caso_successo->nome_prodotto) ?>/ <?= $caso_successo->anno ?></p>
                            <p style="font-size: .75rem"><i><?= $caso_successo->materiale ?></i></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>
</div>
<script type="text/javascript">
    function goToSuccesso(idCaso) {
        location.href = '/guest/successo/' + idCaso;
    }

    $(document).ready(function() {
        $('fieldset select').change(function(e) {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            if (e.target.value === '') {
                params.delete(e.target.name);
            } else {
                params.set(e.target.name, e.target.value);
            }

            url.search = params.toString();

            window.history.replaceState({}, '', url);
            location.href = url;
        });

        $('#cerca').bind('input', function() {
            var searchValue = $(this).val().toLowerCase();
            const selettoreRicerca = '.risultati-container .riga-elemento';

            if (searchValue.length < 3) {
                $(selettoreRicerca).removeClass('hidden');
                return;
            }

            $(selettoreRicerca).each(function() {
                var itemText = $(this).find('.link-to').text().toLowerCase();
                if (itemText.includes(searchValue)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        });
    });
</script>

