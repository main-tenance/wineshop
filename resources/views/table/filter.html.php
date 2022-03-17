<div class="filter_wrapper">
    <?php foreach ($table->getFilter() as $filter): ?>
        <?php include 'filter.' . $filter['type'] . '.html.php'; ?>
    <?php endforeach; ?>
</div>
