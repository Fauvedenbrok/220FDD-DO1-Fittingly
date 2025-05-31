<?php


use Controllers\LoginCustomerController;

require_once "../Controllers/LoginCustomerController.php";

$controller = new LoginCustomerController();
$controller->login();
header("Location: /public_html/inloggen.php?message=thankyou");