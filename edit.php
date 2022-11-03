<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire NWS: Ajouter</title>
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
if (isset($_SESSION["mail"]) AND isset($_GET["id"]))
{
    $id = $_GET["id"];
    $test = new sqlRequest();
    $result = $test->get("SELECT * FROM students WHERE id = $id");
    if(!$result){
        header("location: home.php");
    }
    foreach($result as $student){
        $prenom = $student["prenom"];
        $nom = $student["nom"];
        $age = $student["age"];
        $telephone = $student["telephone"];
        $email = $student["email"];
        $choixspe = $student["choixspe"];
        $genre = $student["sexe"];
    }
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
        $mess = "Le champ 'Prénom' est requis pour envoyer le message !";
    }
    elseif(empty($lastname))
    {
        $mess = "Le champ 'Nom' est requis pour envoyer le message";
    }
    elseif(empty($gender))
    {
        $mess = "Le champ 'Genre' est requis pour envoyer le message";
    }
    elseif(empty($age))
    {
        $mess = "Le champ 'Age' est requis pour envoyer le message";
    }
    elseif(empty($phone))
    {
        $mess = "Le champ 'Téléphone' est requis pour envoyer le message";
    }
    elseif(empty($mail))
    {
        $mess = "Le champ 'E-Mail' est requis pour envoyer le message";
    }
    elseif(empty($spe))
    {
        $mess = "Le champ 'Spécialité' est requis pour envoyer le message";
    }
    else
    {
        $id = $_GET["id"];
        $user = new editContact($name, $lastname, $gender, $age, $phone, $mail, $spe, $id);
        print_r($user);
        $editDb = $user->editContact();
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
    <p>Modifier un contact</p>
    <form action="" method="POST">
        <input type="text" placeholder="Prénom" class="box" name="name" value=<?=$prenom?>>
        <input type="text" placeholder="Nom" class="box" name="lastname" value=<?=$nom?>>
        <select name="gender" id="gender">
            <option value="M" <?php if($genre === "M"){echo "selected";}?>>Homme</option>
            <option value="F" <?php if($genre === "F"){echo "selected";}?>>Femme</option>
            <option value="A" <?php if($genre === "A"){echo "selected";}?>>Autre</option>
        </select>
        <input type="number" placeholder="Age" class="box" name="age" value=<?=$age?>>
        <input type="text" placeholder="Téléphone" class="box" name="phone" value=<?=$telephone?>>
        <input type="mail" placeholder="E-Mail" class="box" name="mail" value=<?=$email?>>
        <select name="spe" id="spe">
            <option value="dev" <?php if($choixspe === "dev"){echo "selected";}?>>Développement Web</option>
            <option value="cm" <?php if($choixspe === "cm"){echo "selected";}?>>Community Management</option>
            <option value="marketing" <?php if($choixspe === "marketing"){echo "selected";}?>>Marketing</option>
            <option value="cg" <?php if($choixspe === "cg"){echo "selected";}?>>Communication graphique</option>
        </select>
        <button type="submit" name="submit" class="btn btn-primary"> Modifier <i class="fas fa-wrench"></i> </button>
    </form>
</div>
