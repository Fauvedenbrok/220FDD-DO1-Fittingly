<?php


use Controllers\RegistrationCustomerController;

require_once "../Controllers/RegistrationCustomerController.php";

$controller = new RegistrationCustomerController();
$controller->register();
header("Location: /public_html/klantregistratie.php?message=thankyou");