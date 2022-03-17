<div class="form__item" style="width: <?= $filter['width']; ?>">
    <div class="form__label">
        <?= $filter['caption']; ?>
    </div>
    <div class="form__widget">
        <select name="<?= $filter['code']; ?>" class="<?= implode(' ', $filter['class']); ?>" multiple>
            <option value="0">
                Фильтр не установлен
            </option>
            <?php foreach ($filter['values'] as $val): ?>
                <option value="<?= $val['ID']; ?>" <?php if ($val['ID'] == $filter['value']) echo 'selected'; ?>>
                    <?= $val['NAME']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
