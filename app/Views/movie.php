<?php
$this->layout("master_template");

use app\Helpers\Translator;

$translator = new Translator($_SESSION['language'] ?? 'en');
?>

<head>
    <title><?=
            $translator->translate('episode');
            echo $filmData['episode_id'] ?> - <?= $filmData['title'] ?></title>
</head>

<div class="container mt-5" id="movieContainer">
    <div class="text-center mb-5">
        <a href="/"><?= $translator->translate('back') ?></a>
        <h1 class="display-4"><?= $filmData['title'] ?></h1>
        <p class="text-muted"><?= $translator->translate('episode');
                                echo ": " . $filmData['episode_id'] ?> -
            <?= $translator->translate('release_date');
            echo $filmData['release_date'] ?>
        </p>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= $translator->translate('film_age') ?></h5>
                    <p class="card-text text-primary"><?= $filmData['film_age'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= $translator->translate('director') ?></h5>
                    <p class="card-text"><?= $filmData['director'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5><?= $translator->translate('opening_crawl') ?></h5>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $filmData['opening_crawl'] ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5><?= $translator->translate('characters') ?></h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($filmData['characters'] as $character): ?>
                            <li class="list-group-item"><?= $character ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5><?= $translator->translate('producer') ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $filmData['producer'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->start('scripts') ?>
<script src="/assets/js/main.js"></script>
<?php $this->stop() ?>