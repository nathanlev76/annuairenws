<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire NWS: Home</title>
    <link rel="icon" type="image/x-icon" href="assets/logo/nws_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
<?php
require_once("class/db.php");
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
?>

<a href="home.php"><h1><img src="assets/logo/nws_logo.png" height=55 width=55>Annuaire NWS</h1></a>

<?php
if($genre == "M"){
    $genre = "Homme";
} 
else if($genre === "F"){
    $genre = "Femme";
}
else{
    $genre = "Autre";
}

if($choixspe == "dev"){
    $choixspe = "Dévelopemment Web";
} 
else if($choixspe === "cg"){
    $choixspe = "Communication graphique";
}
else if($choixspe === "cm"){
    $choixspe = "Community Management";
}
else if($choixspe === "marketing"){
    $choixspe = "Marketing";
}


?>

<div class="infos">
    <h2><?="$prenom $nom"?><h2>
    <img src="assets/user_placeholder.png" height=100 width=100>  
    <p><i class="fas fa-user"></i> Genre: <?=$genre?></p>
    <p><i class="fas fa-clock"></i> Âge: <?=$age?> ans</p>
    <p><i class="fas fa-phone"></i> Numéro de téléphone: <?=$telephone?></p>
    <p><i class="fas fa-envelope"></i> Adresse E-mail: <?=$email?></p>
    <p><i class="fas fa-code"></i> Spécialité envisagée: <?=$choixspe?></p>
    <a href='edit.php?id=<?=$id?>'><button type='button' class='btn btn-primary'>Modifier <i class='fas fa-pen'></i></button></a>
    <a href='delete.php?id=<?=$id?>'><button type='button' class='btn btn-danger'>Supprimer <i class='fas fa-trash'></i></button></a>
</div>
