<?php

/**
 * contact_controller.php
 *
 * Handles the processing of the contact form.
 * Collects form data, sends an email using the Mailer class, and redirects based on success or failure.
 */

require_once 'Mailer.php';
require_once __DIR__ . '/../../public_html/Lang/Translator.php';

/**
 * If the request method is POST, collect the form data and send an email.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $bedrijf = $_POST['bedrijf'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $bericht = $_POST['bericht'];

    $data = ['naam' => $naam, 'bedrijf' => $bedrijf, 'email' => $email, 'tel' => $tel, 'bericht' => $bericht];

}
try{
    /**
     * Load configuration and translator, create Mailer instance, and send the contact email.
     * Redirects to the contact page with a success or failure message.
     */
$config = require __DIR__ . '/../../project_root/config.php';
$translator = init_translator();

$mailer = new Mailer($config, $translator);

$mailer->sendContactMail($data);

header("Location: ../../public_html/contact.php?send=succes");
}
catch(Exception $e){
    header("Location: ../../public_html/contact.php?send=failed");
}