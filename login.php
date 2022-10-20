<?php
session_start();
require_once("class/db.php");
require_once("class/loginuser.php");
$errormessage = "";


if (isset($_SESSION["mail"]))
{
    header("location: home.php");
}

if(isset($_POST["mail"]) && isset($_POST["password"])){
    $mail = $_POST["mail"];
    $password = $_POST["password"]; 
    $user = new Login($mail, $password);
    $check = $user->checkLogin();
    if($check)
    {
        $_SESSION["mail"] = $mail;
        header("Location: home.php");
    }
    else
    {
        $errormessage = "E-Mail ou Mot de passe incorrect !";
    }
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
        <div class="login-input-mail login">
            <input type="email" name="mail" id="mail" placeholder="Adresse mail" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''?>" required>
        </div>
        <div class="login-input login">
            <input type="password" name="password" id="password" placeholder="Mot de passe" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" required>
        </div>
        <input id="checkbox" name="checkbox" type="checkbox">
        <label for="checkbox">Se souvenir de moi</label>
        <div class="login-btn login">
            <input type="submit" value="Se connecter">
        </div>

    </form>
    <p><br><?=$errormessage?></p>
</div>
</body>
</html>



