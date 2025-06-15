<?php
// auth_admin.php — beveiligt adminpagina’s tegen ongeautoriseerde toegang

require_once __DIR__ . '/../../project_root/core/session.php';

use Core\Session;

session_start();

// Controleer of gebruiker adminrechten heeft
if (strtolower(trim(Session::get('account_access_rights') ?? '')) !== 'admin') {
    // Redirect bij geen toegang (standaard ingeschakeld)
    header("Location: /public_html/index.php");
    exit;

    // Toon access denied-melding (gebruik dit als alternatief)
    // echo "Access denied. Je hebt geen toegang tot deze pagina.";
    // exit;
}
