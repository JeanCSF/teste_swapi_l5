<?php
$this->layout("master_template");
use app\Helpers\Translator;

$translator = new Translator($_GET['lang'] ?? 'en');
?>

<head>
    <title>500 - <?php echo $translator->translate('server_error'); ?></title>
</head>

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-12 text-center">
            <h1 class="display-3 text-danger">500</h1>
            <h2 class="mb-4"><?php echo $translator->translate('server_error'); ?></h2>
            <p class="lead"><?php echo $translator->translate('server_error_desc'); ?></p>
            <a href="/" class="btn btn-primary"><?php echo $translator->translate('back_home'); ?></a>
        </div>
    </div>
</div>
