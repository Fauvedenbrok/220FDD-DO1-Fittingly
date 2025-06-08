<?php
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



function init_translator() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_GET['lang'])) {
        $_SESSION['lang'] = $_GET['lang'];
    }
    $lang = $_SESSION['lang'] ?? 'nl';
    return new Translator($lang);
}