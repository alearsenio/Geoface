<?php
//se i dati inviati sono corretti, avvia una sessione per l'utente
include("functions.php");
$_SESSION["flash"] = "";

if (isset($_REQUEST["username"]) && isset($_REQUEST["password"])) {
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    if (verify_login($username, $password)) {

        if (isset($_SESSION)) {
            session_regenerate_id(TRUE);
        }

        $_SESSION["name"] = $username;  
        # start session, remember user info
        redirect("profile.php", "Login successful! Welcome back.");
        
        
    } else {
        redirect("index.php", "Incorrect user name and/or password.");
    }
}

?>