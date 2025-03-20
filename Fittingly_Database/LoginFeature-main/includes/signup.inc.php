<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email= $_POST["email"];
    $user_password = $_POST["user_password"];

    try{
        require_once "dbh.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_control.inc.php";

        // Error handling
        $errors = [];

        if(is_input_empty($first_name, $last_name, $email, $user_password)){
            $errors["empty_input"] = "Fill in all the fields";
        }
        if(is_email_invalid($email)) {
            $errors["invalid_email"] = "Please give a valid e-mail addresses";
        }
        if(is_email_registered($pdo, $email)) {
            $errors["email_registered"] = "This e-mail is already registered";
        }

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["errors_signup"] = $errors;
            header("location: ../index.php");
            die();
        }

        create_user($pdo, $first_name, $last_name, $email, $user_password);

        header("location: ../index.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("location: ../index.php");
    die();
}