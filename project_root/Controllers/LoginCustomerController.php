<?php

namespace Controllers;
use Models\UserAccounts;
use Core\Validator;
use Core\Session;

require_once "../Core/validator.php";
require_once "../Core/Database.php";
require_once "../Models/UserAccounts.php";

class LoginCustomerController {
    public function login(): void{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $_POST;

            $required = ['EmailAddress', 'UserPassword'];
            $validation = new Validator();
            if ($validation->isEmpty($data, $required)) {
                $_SESSION['login_error'] = "Vul alle verplichte velden in.";
                header("Location: /public_html/inloggen.php");
                exit;
            }

            if (!$validation->isValidEmail($data['EmailAddress'])) {
                Session::set('login_error', 'Ongeldig e-mailadres.');
                header("Location: /public_html/inloggen.php");
                exit;
            }

            $user = UserAccounts::getUserAccountByEmail($data['EmailAddress']);

            if (!$user) {
                Session::set('login_error', 'Geen gebruiker gevonden met dit e-mailadres.');
                header("Location: /public_html/inloggen.php");
                exit;
            }

            $hashed_password = $user['userPassword'];
            if (!password_verify($data['UserPassword'], $hashed_password)) {
                Session::set('login_error', 'Ongeldig wachtwoord');
                header("Location: /public_html/inloggen.php");
                exit;
            }

        }
    }

}