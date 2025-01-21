<?php

namespace app\Config;

use app\Helpers\Translator;

date_default_timezone_set('America/Sao_Paulo');

session_start();
$_SESSION['language'] = $_SESSION['language'] ?? 'en';
if (isset($_GET['lang'])) {
    $language = $_GET['lang'];
    $_SESSION['language'] = $language;
}
