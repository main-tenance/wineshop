<div class="form__item" style="width: <?= $filter['width']; ?>">
    <div class="form__label"><?= $filter['caption']; ?></div>
    <div class="form__widget">
        <input class="<?= implode(' ', $filter['class']); ?>" type="date"
               name="<?= $filter['code']; ?>" value="<?= $filter['value']; ?>" <?= $filter['attr']; ?>>
    </div>
</div>
