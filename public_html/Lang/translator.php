<?php
/**
 * translator.php
 *
 * Provides the Translator class and helper function for multilingual support in Fittingly.
 * - Loads translation files based on the selected language.
 * - Retrieves translated strings by key.
 * - Supports session-based language switching.
 *
 * Usage:
 * $translator = init_translator();
 * echo $translator->get('header_navbar_1');
 */

/**
 * Class Translator
 *
 * Handles loading and retrieving translations for the application.
 * Loads the appropriate language file and provides a method to get translations by key.
 *
 * Properties:
 * @property array $translations Associative array of translation keys and strings.
 */
class Translator
{
    /**
     * @var array Holds the loaded translations as an associative array.
     */
    public $translations = [];

    /**
     * Translator constructor.
     *
     * Loads the translation file for the specified language.
     * Defaults to Dutch ('nl') if no language is provided.
     *
     * @param string $lang The language code (e.g., 'nl' or 'en').
     */
    public function __construct($lang = 'nl')
    {
        $file = __DIR__ . "/$lang.php";
        if (file_exists($file)) {
            $this->translations = include $file;
        } else {
            die("Language file not found: $file");
        }
    }

    /**
     * Retrieves the translation for a given key.
     *
     * @param string $key The translation key.
     * @return string The translated string, or [[key]] if not found.
     */
    public function get(string $key): string
    {
        return $this->translations[$key] ?? "[[$key]]";
    }
}


/**
 * Initializes the Translator object based on the user's language preference.
 * - Starts a session if one isn't already active.
 * - Checks for a language parameter in the URL and stores it in the session.
 * - Returns a Translator instance for the selected language.
 *
 * @return Translator The initialized Translator object.
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
