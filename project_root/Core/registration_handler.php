<?php
require_once "../Controllers/registration_customer_controller.php";

use Controllers\RegistrationCustomerController;

$controller = new RegistrationCustomerController();
$controller->register(); 