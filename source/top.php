<!-- WebSite developed by Alessandro Arsenio.
    Name : Geoface.
    Description : Geoface is a s a game where you have to guess people origins observing their face.
                    You have 10 seconds for each question and three life in total
                    Subscribing to the site, your face will automatically and anomously be part of the game
                    so that you can see everytime you want in your Profile,
                    what others people thinks about where you're from
-->

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- top page of geoface -->
<head>
    <title>GeoFace</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Links to provided files.  Do not edit or remove these links -->
    <link href="page-pics/logo.PNG" type="image/png" rel="shortcut icon">

    <!-- Link to your CSS file -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="css/animate.css">

    <link href="css/geoface.css" type="text/css" rel="stylesheet">

    <link href="css/login.css" type="text/css" rel="stylesheet">

    <link href="css/question.css" type="text/css" rel="stylesheet">

    <link href="css/profile.css" type="text/css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
<div id="background"></div>
<div id="background2"></div>

<nav class="navbar navbar-expand-lg navbar-light bg-light animated fadeInDown" id="mianavbar">
    <a class="navbar-brand text-light" href="index.php">GeoFace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-right ml-auto">
            <li class="nav-item ">
                <a class="nav-link text-light " href="play.php">Play<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-light" href="profile.php"> <span id="profile"><?php
                        if (!isset($_SESSION["name"])) {
                            print "Profile";
                        } else {
                            print $_SESSION["name"];
                        } ?></span><span class="sr-only">(current)</span></a>
            </li>
            <?php
            if (isset($_SESSION["name"])) { ?>
                <li class="nav-item ">
                    <a class="nav-link text-light" href="logout-submit.php">
                        Log Out
                    </a>
                </li> <?php } ?>
            <li class="nav-item ">
                <a class="nav-link text-light " href="help.php">Help<span></span></a>
            </li>
        </ul>
    </div>
</nav>
