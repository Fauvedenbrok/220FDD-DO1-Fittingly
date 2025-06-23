<?php
/**
 * auth_admin.php
 *
 * Secures admin pages against unauthorized access.
 * - Starts the session.
 * - Checks if the user has admin access rights.
 * - Redirects to the homepage if the user is not an admin.
 *
 * Usage:
 * Include this file at the top of any admin page to restrict access to admins only.
 *
 * Dependencies:
 * - Requires the Session class from Core\Session.
 */

require_once __DIR__ . '/../../project_root/core/session.php';

use Core\Session;

session_start();

// Check if the user has admin rights
if (strtolower(trim(Session::get('account_access_rights') ?? '')) !== 'admin') {
    // Redirect if no access (default enabled)
    header("Location: /public_html/index.php");
    exit;

    // Alternative: Show access denied message
    // echo "Access denied. You do not have permission to access this page.";
    // exit;
}
