<?php

$subject = "Fittingly contactformulier";

    $name = $_POST ['naam'];
    $email = $_POST ['email'];
    $data = [
        'tel' => $_POST ['tel'],
        'bedrijf' => $_POST ['bedrijf'],
        'bericht' => $_POST ['bericht'],
    ];

    $mail = new SendMail($name, $email, $data);