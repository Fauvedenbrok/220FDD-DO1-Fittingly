<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email= $_POST["email"];
    $user_password = $_POST["user_password"];

    try{
        require_once "dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_control.inc.php";

        // Error handling
        $errors = [];

        if(is_input_empty($email, $user_password)){
            $errors["empty_input"] = "Fill in all the fields";
        }

        $result = get_user($pdo, $email);

        if(is_useremail_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login information";
        }

        if(!is_useremail_wrong($result) && is_password_wrong($user_password, $result["user_password"])){
            $errors["login_incorrect"] = "Incorrect login information";
        }

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["errors_login"] = $errors;
            
            header("location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_name"] = htmlspecialchars($result["first_name"]);
        $_SESSION["last_regeneration"] = time();

        header("location: ../index.php?login=success");
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