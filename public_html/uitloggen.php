<?php

require_once "../project_root/Core/Session.php";
use Core\Session;



unset($_SESSION['user_email']);


Session::destroy();
header("Location: /public_html/inloggen.php");
exit;