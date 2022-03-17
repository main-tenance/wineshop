<div class="form__item">
    <div class="form__label"><?= $filter['caption']; ?></div>
    <div class="form__widget">
        <input class="<?= implode(' ', $filter['class']); ?>" type="checkbox"
               style="width: <?= $filter['width']; ?>"
               name="<?= $filter['code']; ?>" <?php if ($filter['value'] == 1) echo 'checked'; ?>>
    </div>
</div>
