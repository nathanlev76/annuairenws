<?php
require_once("class/db.php");
$db = new Db();
$test = $db->connect();
print_r($test);

$errormessage = "";
require_once("class/loginuser.php");
if(isset($_POST["mail"]) && isset($_POST["password"])){
    $mail = $_POST["mail"];
    $password = $_POST["password"]; 
    $user = new Login($mail, $password);
    $test = $user->getUserData();
    $errormessage = $test;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire NWS</title>
    <link rel="icon" type="image/x-icon" href="assets/logo/nws_logo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="conteneur">
    <img id=nwslogo src="assets/logo/banniere_nws.svg" height="150" width="300"></img>
    <form action="" method="post" class="login-form">
        <div class="login-input-mail">
            <input type="email" name="mail" id="mail" placeholder="Adresse mail" value=""required>
        </div>
        <div class="login-input">
            <input type="password" name="password" id="password" placeholder="Mot de passe" value="" required>
        </div>
        <div class="login-btn">
            <input type="submit" value="Se connecter">
        </div>
    </form>
    <p><br><?=$errormessage?></p>
</div>
</body>
</html>



