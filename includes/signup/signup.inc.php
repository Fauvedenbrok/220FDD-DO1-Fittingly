<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $first_name = $_POST["FirstName"];
    $last_name = $_POST["LastName"];
    $phone_nr= $_POST["PhoneNumber"];
    $dob= $_POST["DateOfBirth"];
    $postal_code= $_POST["PostalCode"];
    $street_name= $_POST["StreetName"];
    $house_nr= $_POST["HouseNumber"];
    $city= $_POST["City"];
    $country= $_POST["Country"];
    $email= $_POST["EmailAddress"];
    $user_password = $_POST["UserPassword"];

    try{
        require_once "../dbh.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_control.inc.php";

        // Error handling
        $errors = [];

        if(is_input_empty($first_name, $last_name, $postal_code, $street_name, $house_nr, $city, $country, $email, $user_password)){
            $errors["empty_input"] = "Fill in all the fields";
        }
        if(is_email_invalid($email)) {
            $errors["invalid_email"] = "Please give a valid e-mail addresses";
        }
        if(is_email_registered($pdo, $email)) {
            $errors["email_registered"] = "This e-mail is already registered";
        }



        if($errors){
            $_SESSION["errors_signup"] = $errors;
            header("location: ../klantregistratie.php");
            die();
        }

        create_user( $pdo,$first_name, $last_name, $phone_nr, $dob, $postal_code, $street_name, $house_nr, $city, $country, $email, $user_password);

        header("location: ../../klantregistratie.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("location: ../../klantregistratie.php");
    die();
}