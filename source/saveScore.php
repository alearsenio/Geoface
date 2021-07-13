<?php
include("functions.php");
if (!isset($_SESSION["name"])) {

    $score = $_POST["score"];
    $user = $_POST["user"];


    echo json_encode(saveScore($score, $user));
}

?>