<?php


use Controllers\LoginCustomerController;

require_once "../Controllers/LoginCustomerController.php";

$controller = new LoginCustomerController();

$action = $_GET['action'] ?? 'login';

if ($action === 'logout') {
    $controller->logout();
} else {
    $controller->login();
}