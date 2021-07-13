<?php
include("functions.php");
include("top.php");
?>

    <div class="container geopic" id="logo">
        <h3 id="welcome" class="animated bounceInUp ">Welcome to</h3>
        <img class="animated bounceInUp delay-500 img-fluid" src="page-pics/geoface2.PNG"
             alt="Responsive image">
        <div><h3 id="description" class="animated bounceInUp delay-800">Guess people origin based on their face</h3>
        </div>
    </div>

<?php if (isset($_SESSION["name"])) { ?>

    <div class="container animated bounceInUp delay-1000" id="homePlay">
        <a href="play.php">
            <button href="play.php" type="button" class="btn-lg choose btn-primary box-shadow--16dp answer"
            >Wanna Play?
            </button>
        </a>
        <h2 id="welcome">Or</h2>
        <a href="help.php">
            <button href="help.php" type="button" class="btn-lg choose btn-danger box-shadow--16dp answer"
            >Learn more?
            </button>

    </div>

<?php } else { ?>
    <div class="wrapper animated bounceInUp delay-1000">
        <div id="formContent">
            <?php if (isset($_SESSION["flash"])) { ?>
                <p><?= $_SESSION["flash"] ?></p>
            <?php }
            unset($_SESSION["flash"])?>
            <form action="login.php" method="post">
                <input type="text" id="login" class="fadeIn sec" maxlength="20" name="username" placeholder="username"
                       required>
                <input type="password" maxlength="20" id="password" class="fadeIn third" name="password"
                       placeholder="password"
                       required>
                <button type="submit" class="fadeIn btn-lg btn-primary" value=>Log in</button>
                <p class="text-light">Not registered yet? <a href="register.php">Register Now</a>
            </form>
        </div>
    </div>
<?php } ?>


<?php include("bottom.php"); ?>