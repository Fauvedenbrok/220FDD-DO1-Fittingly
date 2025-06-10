<?php

/**
 * Defines the Translator class, which handles loading and retrieving translations.
 * $translations [] holds the loaded translations as an associative array.
 */
class Translator
{
    public $translations = [];

    public function __construct($lang = 'nl')
    {
        $file = __DIR__ . "/$lang.php";
        if (file_exists($file)) {
            $this->translations = include $file;
        } else {
            die("Language file not found: $file");
        }
    }

    public function get(string $key): string
    {
        return $this->translations[$key] ?? "[[$key]]";
    }
}


/**
 * Initializes the Translator object based on the user's language preference.
 * Will start a sessions if one isn't already active.
 * If a language is specified in the url, it stores it into the session.
 */
function init_translator()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_GET['lang'])) {
        $_SESSION['lang'] = $_GET['lang'];
    }
    $lang = $_SESSION['lang'] ?? 'nl';
    return new Translator($lang);
}
