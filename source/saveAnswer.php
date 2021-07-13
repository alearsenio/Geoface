<?php
include("functions.php");


if (!isset($_SESSION["name"])) {

    $choice = $_POST["choice"];
    $person1 = $_POST["person1"];
    $person2 = $_POST["person2"];

    echo json_encode(saveAnswer($choice, $person1, $person2));
}
?>