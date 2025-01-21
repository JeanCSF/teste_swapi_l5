<?php
$this->layout("master_template");

use app\Helpers\Translator;

$translator = new Translator($_SESSION['language'] ?? 'en');
?>

<head>
    <title>Star Wars Films</title>
</head>
<div class="d-flex justify-content-end mb-3">
    <div class="d-flex flex-column align-items-end">
        <div class="mb-3" style="width: 250px;">
            <input
                type="text"
                id="searchInput"
                class="form-control"
                placeholder="<?= $translator->translate('search') ?>"
                oninput="filterMovies()">
        </div>
        <div>
            <p class="mr-3"><?= $translator->translate('sort_by') ?>:</p>
            <select id="sort" class="form-control" onchange="search()" style="width: 250px;">
                <option value="date_asc"><?= $translator->translate('date') ?> (Asc)</option>
                <option value="date_desc"><?= $translator->translate('date') ?> (Desc)</option>
                <option value="ep_asc"><?= $translator->translate('episode') ?> (Asc)</option>
                <option value="ep_desc"><?= $translator->translate('episode') ?> (Desc)</option>
                <option value="title"><?= $translator->translate('title') ?></option>
            </select>
        </div>
    </div>
</div>

<div class="row mb-3 p-3" style="margin: 0 auto;">
    <div id="cards">
    </div>
</div>
<?php $this->start('scripts') ?>
<script src="/assets/js/main.js"></script>
<?php $this->stop() ?>