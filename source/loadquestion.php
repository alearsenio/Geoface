<?php
include("functions.php");

if (!isset($_SESSION["name"])) {

    echo json_encode(loadquestion());

}
?>