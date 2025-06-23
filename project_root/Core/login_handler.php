<?php

/**
 * login_handler.php
 *
 * Handles login and logout actions for customers and admins.
 * - Loads the LoginCustomerController.
 * - Determines the requested action (login, logout, adminlogout) from the URL.
 * - Calls the appropriate controller method based on the action.
 */

use Controllers\LoginCustomerController;

require_once "../Controllers/LoginCustomerController.php";

// Instantiate the login controller
$controller = new LoginCustomerController();

// Determine the action from the URL (default is 'login')
$action = $_GET['action'] ?? 'login';

// Call the appropriate method based on the action
if ($action === 'logout') {
    $controller->logout();
} elseif ($action === 'adminlogout') {
    $controller->adminlogout();
} else {
    $controller->login();
}
