<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email= $_POST["EmailAddress"];
    $user_password = $_POST["UserPassword"];

    try{
        require_once "../dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_control.inc.php";
        require_once "login_view.inc.php";

        // Error handling
        $errors = [];

        if(is_input_empty($email, $user_password)){
            $errors["empty_input"] = "Fill in all the fields";
        }

        $result = get_user($pdo, $email);

        if(is_useremail_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login information";
        }

        if(!is_useremail_wrong($result) && is_password_wrong($user_password, $result["UserPassword"])){
            $errors["login_incorrect"] = "Incorrect login information";
        }


        if($errors){
            $_SESSION["errors_login"] = $errors;
            
            header("location: /inloggen.php");
            die();
        }


        header("location: /querybuilder.html");
        $pdo = null;
        $stmt = null;

        die();
    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("location: /inloggen.php");
    die();
}