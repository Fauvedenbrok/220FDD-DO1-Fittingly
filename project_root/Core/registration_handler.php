<?php

/**
 * registration_handler.php
 *
 * Handles the registration process for new customers.
 * - Loads the RegistrationCustomerController.
 * - Calls the register method to process the registration form.
 * - Redirects the user to the registration page with a thank you message after successful registration.
 */

use Controllers\RegistrationCustomerController;

require_once "../Controllers/RegistrationCustomerController.php";

$controller = new RegistrationCustomerController();
$controller->register();

if (empty($controller->message)) {
    header("Location: /public_html/klantregistratie.php?message=thankyou");
    exit();
} else {
    $_SESSION['registration_error'] = $controller->message;
    header("Location: /public_html/klantregistratie.php?message=error");
    exit();
}