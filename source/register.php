<?php
//pagina di registrazione al sito
include("top.php"); ?>
<?php include("functions.php");
?>


<div class="wrapper2 animated bounceInUp">
    <div id="formContent">
        <h4>Sign Up</h4>
        <form action="register-submit.php" enctype="multipart/form-data" method="post">
            <input type="text" size="16" maxlength="20" name="username" class="fadeIn first" placeholder="username"
                   required>
            <input type="email" size="20" maxlength="40" name="email" class="fadeIn first" placeholder="email" required>
            <input type="password" size="16" maxlength="20" name="password" id="password" class="fadeIn second"
                   placeholder="password" required>
            <input type="password" size="16" name="confPassword" maxlength="20" id="confPassword" class="fadeIn third"
                   placeholder="confirm password" required>
            <p id="wrongPassword"></p>
            <input type="file" size="16" name="pic" class="fadeIn third" value="insert your pic"
                   placeholder="inser a pic" required>
            <select name="country" class="browser-default custom-select" required>
                <option value="" disabled selected>Country of origin</option>
                <?php countries(); ?>
            </select>
            <button type="submit" class="fadeIn btn-lg btn-primary">Sign Up</button>
        </form>
    </div>
</div>

<?php include("bottom.php"); ?>3
