<?php

namespace Helpers;

/**
 * Class ViewHelper
 *
 * This class provides static methods to safely display content in HTML.
 * Mainly intended to prevent XSS attacks by applying proper HTML escaping.
 */
class ViewHelper
{
    /**
     * Makes a string safe for use in HTML by escaping special characters.
     *
     * @param mixed $value The value to be escaped (will be cast to string).
     * @return string The safely escaped string.
     *
     * Uses htmlspecialchars:
     *  - Converts "<" to `&lt;`, `"` to `&quot;`, etc.
     *  - ENT_QUOTES escapes both single and double quotes.
     *  - UTF-8 ensures correct character encoding.
     */
    public static function e($value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escapes HTML and preserves line breaks by converting them to `<br>`.
     *
     * @param mixed $value The value that may contain multiple lines.
     * @return string The safely escaped string with `<br>` instead of real line breaks.
     *
     * Uses nl2br to convert "\n" to `<br>`.
     * Uses self::e() to make the string HTML safe first.
     */ 
    public static function eWithBreaks($value): string
    {
        return nl2br(self::e($value));
    }
}
