<?php


use Controllers\RegistrationCustomerController;

require_once "../Controllers/registration_customer_controller.php";

$controller = new RegistrationCustomerController();
$controller->register();
header("Location: /public_html/klantregistratie.php?message=thankyou");