<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire NWS: Modifier</title>
    <link rel="icon" type="image/x-icon" href="assets/logo/nws_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
<a href="home.php"><h1><img src="assets/logo/nws_logo.png" height=55 width=55>Annuaire NWS</h1></a>
<?php
require_once("class/db.php");
require_once("class/editcontact.php");
session_start();
if (isset($_SESSION["mail"]))
{
    1+1;
}
else
{
    header("location: login.php");
}


$mess = "";
$succmess = "";
if(isset($_POST["submit"]))
{
    //name lastname gender age phone mail spe
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $mail = $_POST["mail"];
    $spe = $_POST["spe"];
    if(empty($name))
    {
        $mess = "Le champ 'Prénom' est requis pour ajouter le contact !";
    }
    elseif(empty($lastname))
    {
        $mess = "Le champ 'Nom' est requis pour ajouter le contact !";
    }
    elseif(empty($gender))
    {
        $mess = "Le champ 'Genre' est requis pour ajouter le contact !";
    }
    elseif(empty($age))
    {
        $mess = "Le champ 'Age' est requis pour ajouter le contact !";
    }
    elseif(empty($phone))
    {
        $mess = "Le champ 'Téléphone' est requis pour ajouter le contact !";
    }
    elseif(empty($mail))
    {
        $mess = "Le champ 'E-Mail' est requis pour ajouter le contact !";
    }
    elseif(empty($spe))
    {
        $mess = "Le champ 'Spécialité' est requis pour ajouter le contact !";
    }
    else
    {
        $user = new CreateContact($name, $lastname, $gender, $age, $phone, $mail, $spe);
        $addDb = $user->addContact($id);
        header("location: home.php");

    }
}
?>

<div class="addform">
    <?php
    if(!empty($mess)){  
    echo "<div class='errormessageform'><div class='alert alert-danger' role='alert'>$mess</div></div>";
    }
    ?>
    <p>Ajouter un contact</p>
    <form action="" method="POST">
        <input type="text" placeholder="Prénom" class="box" name="name">
        <input type="text" placeholder="Nom" class="box" name="lastname">
        <select name="gender" id="gender">
            <option value="">---Choisir un genre---</option>
            <option value="M">Homme</option>
            <option value="F">Femme</option>
            <option value="A">Autre</option>
        </select>
        <input type="number" placeholder="Age" class="box" name="age">
        <input type="text" placeholder="Téléphone" class="box" name="phone">
        <input type="mail" placeholder="E-Mail" class="box" name="mail">
        <select name="spe" id="spe">
            <option value="">---Choisir une spécialité---</option>
            <option value="dev">Développement Web</option>
            <option value="cm">Community Management</option>
            <option value="marketing">Marketing</option>
            <option value="cg">Communication graphique</option>
        </select>
        <button type="submit" name="submit" class="btn btn-primary"> Ajouter <i class="fas fa-paper-plane"></i> </button>
    </form>
</div>
