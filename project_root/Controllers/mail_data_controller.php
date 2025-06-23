<?php

require_once __DIR__ . '../Core/Validator.php';

use Core\Validator;

/**
 * mail_data_controller.php
 *
 * Handles the processing of contact form data for sending emails.
 * Collects form input, builds the email message, and sends it to the customer.
 */

 // Set the subject for the email
$subject = "Fittingly contactformulier";

    // Collect form data from POST request
    $name = $_POST ['naam'];
    if(Validator::isValidEmail($_POST ['email'])){
    $email = $_POST ['email'];
    }
    $subject = "Fittingly Contactformulier";
    $message = $_POST ['bericht'];
    $data = [
        'tel' => $_POST ['tel'],
        'bedrijf' => $_POST ['bedrijf'],
        'bericht' => $message
    ];

    // Create a new SendMail instance and send the email to the customer
    $mail = new SendMail();
    $mailMessage = $mail->buildMailToCustomer($name, $data);
    $result = $mail->sendMailCustomer($email, $mailMessage, $subject);

    
