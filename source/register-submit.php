<?php
//invia i dati di registrazione al database e avvia una sessione
include("top.php"); ?>
<?php include("functions.php"); ?>

<?php $username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$country = $_POST["country"];

$_SESSION["flash"] = "";

if (is_uploaded_file($_FILES["pic"]["tmp_name"])) {
    $pic = $_FILES["pic"]["tmp_name"];
    //$pic2 = imagecrop($pic, ['x' => 0, 'y' => 0, 'width' => 300, 'height' => 300]);
    move_uploaded_file($pic, "user-pics/$username.jpeg");
    register($username, $email, $password, $country);
    if (isset($_SESSION)) {
        session_regenerate_id(TRUE);
    }

    $_SESSION["name"] = $username;
    redirect("profile.php", "");
} else {
    redirect("register.php", "Error: pic not uploaded");
}


?>

<?php include("bottom.php"); ?>