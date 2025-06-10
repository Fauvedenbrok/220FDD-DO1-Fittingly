<?php

namespace Helpers;

/** Class ViewHelper
 * Deze klasse bevat statische methodes om content veilig weer te geven in HTML.
 * Vooral bedoeld om XSS-aanvallen te voorkomen door correcte HTML escaping toe te passen.
 */
class ViewHelper
{
    /** Maakt een string veilig voor gebruik in HTML door speciale tekens te escapen.
     * @$value     De waarde die geëscaped moet worden (wordt eerst omgezet naar string).
     * @string     De veilig geëscapete string.
     * @function htmlspecialchars
     *  - Zet "<" om naar `&lt;`, `"` naar `&quot;`, enz.
     *  - ENT_QUOTES escapt zowel enkele als dubbele aanhalingstekens.
     *  - UTF-8 zorgt voor correcte tekenverwerking.
     */
    public static function e($value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

     /** Voert HTML escaping uit én behoudt regelafbrekingen door ze te vervangen met `<br>`.
     * @$value     De waarde met eventueel meerdere regels.
     * @string     De veilig geëscapete string met `<br>` i.p.v. echte line breaks.
     *
     * @function nl2br     Zet "\n" om naar `<br>`.
     * @self::e()          Gebruikt eerst ViewHelper::e om HTML veilig te maken.
     *
     */
    public static function eWithBreaks($value): string
    {
        return nl2br(self::e($value));
    }
}
