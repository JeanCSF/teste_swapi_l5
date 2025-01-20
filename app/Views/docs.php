<?php
$this->layout("master_template");

use app\Helpers\Translator;

$translator = new Translator($_SESSION['language'] ?? 'en');
?>

<head>
    <title>Star Wars API Docs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui.css" />
</head>
<div class="text-center my-5">
    <a href="/"><?= $translator->translate('back') ?></a>
</div>
<div id="swagger-ui" style="margin: 0 auto;">
</div>
<?php $this->start('scripts') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui-bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui-standalone-preset.js"></script>
<script>
    window.onload = function() {
        const ui = SwaggerUIBundle({
            url: '/docs.json',
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout",
        });

        window.ui = ui;
    }
</script>
<?php $this->stop() ?>