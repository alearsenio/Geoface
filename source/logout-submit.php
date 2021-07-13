<?php
//pagina di logout
include("functions.php");
include("top.php");
ensure_logged_in();
?>

    <div class="wrapper2 fadeInDown">
        <div id="formContent">
            <h4>You are logged in as <?= $_SESSION["name"] ?></h4>
            <form id="logout" action="logout.php" method="post">
                <input type="submit" value="Log out">
                <input type="hidden" name="logout" value="true">
            </form>
        </div>
    </div>
<?php include("bottom.php"); ?>