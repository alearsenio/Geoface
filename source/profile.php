<?php
//profilo personale dell'utente
include("top.php");
include("functions.php");
$_SESSION["flash"] = "";
ensure_logged_in(); ?>

    <div class="container">
        <h4 class="animated bounceInRight">Hi</h4>
        <h4 class="animated bounceInRight" id="yourUsername"><?= $_SESSION["name"] ?></h4>
    </div>
    <div class="container  picArea2 box-shadow--16dp">
        <div class="container animated bounceInLeft box-shadow--16dp picArea ">
        </div>
    </div>
    <div class="container">
        <h4 class="animated bounceInRight">Your best score is </h4>
        <h4 class="animated bounceInLeft" id="yourScore"><?= getScore($_SESSION["name"]) ?></h4>
        <h4 class="animated bounceInRight">Others think you're from: </h4>
    </div>

    <div class="container  animated bounceInLeft" id="yourOrigin">
        <?= getOrigins($_SESSION["name"]) ?>
    </div>
<?php
include("bottom.php");
?>