<?php if($table->isDownloadable()): ?>
    <div class="table-download">
        <a data-tooltip="Сохранить в xlsx" href="<?= $table->getDownloadUrl(); ?>"><i class="far fa-file-excel"></i></a>
    </div>
<?php endif; ?>
