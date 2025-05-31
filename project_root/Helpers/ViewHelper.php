<?php

namespace Helpers;

class ViewHelper
{
    // Escape HTML veilig //
    public static function e($value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

    // HTML escape + regelbreuken //
    public static function eWithBreaks($value): string
    {
        return nl2br(self::e($value));
    }
}
