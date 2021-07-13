<?php
//termina la sessione corrente
require_once("functions.php");

session_unset();
session_destroy();
session_write_close();
setcookie(session_name(), '', 0, '/');
redirect("index.php", "Logout successful.");

?>
