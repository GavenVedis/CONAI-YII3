<?php
declare(strict_types=1);


/**
 * @var string $body
 * @var string $modal_label
 */
?>
<div class="modal fade" id="alertInfo" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modalLabel" id="modalLabel"><?= $modal_label ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body">
                <?= $body ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-no" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
