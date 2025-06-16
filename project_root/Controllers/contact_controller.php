<?php

require_once 'Mailer.php';
require_once __DIR__ . '/../../public_html/Lang/translator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $bedrijf = $_POST['bedrijf'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $bericht = $_POST['bericht'];

    $data = ['naam' => $naam, 'bedrijf' => $bedrijf, 'email' => $email, 'tel' => $tel, 'bericht' => $bericht];

}
try{
$config = require __DIR__ . '/../../project_root/config.php';
$translator = init_translator();

$mailer = new Mailer($config, $translator);

$mailer->sendContactMail($data);

header("Location: ../../public_html/contact.php?send=succes");
}
catch(Exception $e){
    header("Location: ../../public_html/contact.php?send=failed");
}