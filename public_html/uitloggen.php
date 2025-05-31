<?php
require_once "../project_root/Core/Session.php";
use Core\Session;

Session::destroy();
header("Location: /public_html/inloggen.php");
exit;