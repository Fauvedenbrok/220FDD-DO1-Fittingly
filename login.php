<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/contact.css">
    <title>Document</title>
</head>
<body>
<form action="login.php" method="post">
    <label>Username:<br>
        <input type="text" name="username">
    </label><br>
    <label>password:<br>
        <input type="text" name="password">
    </label><br>
    <input type="submit" name="login" value="login"><br>
</form>
</body>
</html>


<?php
if(isset($_POST["login"])){
    if(!empty($_POST["username"]) && !empty($_POST["password"])){
        $_SESSION["username"] = $_POST['username'];
        $_SESSION["password"] = $_POST['password'];

        header("Location: home.php");
    }
    else{
        echo "Missing Username or password<br>";
    }
}


