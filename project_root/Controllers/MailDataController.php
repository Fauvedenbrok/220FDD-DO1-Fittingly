<?php

$subject = "Fittingly contactformulier";

    $name = $_POST ['naam'];
    $email = $_POST ['email'];
    $subject = "Fittingly Contactformulier";
    $message = $_POST ['bericht'];
    $data = [
        'tel' => $_POST ['tel'],
        'bedrijf' => $_POST ['bedrijf'],
        'bericht' => $message,
    ];

    $mail = new SendMail($name, $email, $data);