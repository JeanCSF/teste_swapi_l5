<?php

namespace app\Helpers;

use Exception;

class Translator
{
    private $language;
    private $translations;

    public function __construct($language = 'en')
    {
        $this->language = $language;
        $filePath = dirname(__DIR__, 2) . "/public/assets/lang/{$language}.json";

        if (!file_exists($filePath)) {
            $filePath = dirname(__DIR__, 2) . "/public/assets/lang/en.json";
            if (!file_exists($filePath)) {
                throw new Exception("Language file not found for default and specified language.");
            }
        }

        $this->translations = json_decode(file_get_contents($filePath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON in language file: " . json_last_error_msg());
        }
    }

    public function translate($key)
    {
        return $this->translations[$key] ?? $key;
    }

    public function getTranslations(){
        return $this->translations;
    }
}
