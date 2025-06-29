<?php

namespace Controllers;

use Models\UserAccounts;
use Core\Validator;
use Core\Session;

require_once __DIR__ . '../Core/validator.php';
require_once __DIR__ . '../Core/Database.php';
require_once __DIR__ . '../Models/UserAccounts.php';
require_once __DIR__ . '../Core/Session.php';



/**
 * Class LoginCustomerController
 *
 * Handles customer login and logout functionality.
 */
class LoginCustomerController
{
    /**
     * Handles the login process for a customer.
     *
     * Validates input, checks credentials, sets session variables, and redirects
     * the user based on their access rights.
     *
     * @return void
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            $required = ['EmailAddress', 'UserPassword'];
            $validation = new Validator();
            if ($validation->isEmpty($data, $required)) {
                Session::set('login_error', "Vul alle verplichte velden in.");
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

            $hashed_password = $user['UserPassword'];
            if (!password_verify($data['UserPassword'], $hashed_password)) {
                Session::set('login_error', 'Ongeldig wachtwoord');
                header("Location: /public_html/inloggen.php");
                exit;
            }

            // Set session variables
            Session::set('user_email', $user['EmailAddress']);
            Session::set('account_access_rights', $user['AccountAccessRights']); // Save access rights


            // Redirect based on access rights
            if (strtolower(trim($user['AccountAccessRights'])) === 'admin') {
                header("Location: /public_html/admin/adminportal.php");
            } else {
                header("Location: /public_html/index.php");
            }
            exit;
        }
    }

    /**
     * Logs out the current user and redirects to the previous page or homepage.
     *
     * @return void
     */
    public function logout(): void
    {
        Session::remove('user_email');
        Session::remove('account_access_rights');

        $redirect = '/public_html/index.php';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $redirect = $_SERVER['HTTP_REFERER'];
            $redirect = preg_replace('/(\?|&)action=logout(&|$)/', '$1', $redirect);
            $redirect = rtrim($redirect, '?&');
        }
        header("Location: $redirect");
        exit;
    }

    /**
     * Logs out the current admin user and redirects to the homepage.
     *
     * @return void
     */
    public function adminlogout(): void
    {
        Session::remove('user_email');
        Session::remove('account_access_rights');

        header("Location: /public_html/index.php");
        exit;
    }
}
