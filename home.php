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

if (isset($_SESSION["mail"]))
{
    1+1;
}
else
{
    header("location: login.php");
}

if (isset($_GET["search"]))
{
    if(!empty($_GET["search"]))
    {
        $search = $_GET["search"];
        $test = new sqlRequest();
        $result = $test->get("SELECT * FROM students WHERE prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search'");

    }
    else
    {
        header("location: home.php");
    }
}
else
{
$test = new sqlRequest();
//$result = $test->get("INSERT INTO `students` (`id`, `sexe`, `prenom`, `nom`, `telephone`, `email`, `choixspe`) VALUES (NULL, 'M', 'Ugo', 'Rastell', '0102030405', 'urastell@normandiewebschool.fr', 'Développement')");
$result = $test->get('SELECT * FROM students');
}
?>

<h1><img src="assets/logo/nws_logo.png" height=55 width=55>Annuaire NWS</h1>

<div class="searchbar">
    <form method="GET">
        <input type="search" name="search" placeholder="Rechercher un contact">
        <input type="submit">
    </form>
</div>

<div class="errormessage">
<?php
    if(!$result)
    {
        echo "<div class='alert alert-danger' role='alert'>Aucun résultat pour la recherche: $search</div>";
    }
?>
</div>

<div id="testdiv">
    <table class="table table-hover">
    <thead>
        <tr class="table-dark">
        <th scope="col">Prénom/Nom</th>
        <th scope="col">Choix de spécialité</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <?php
        
    foreach($result as $student){
        $prenom = $student['prenom'];
        $nom = $student['nom'];
        $telephone = $student['telephone'];
        $id = $student['id'];
        $genre = $student['sexe'];
        if($genre === "M")
        {
           $genre = "Homme"; 
        }
        else
        {
            $genre = "Femme";
        }

        $choixspe = $student['choixspe'];
        if($choixspe === "dev")
        {
            $choixspe = "Développement Web";
        }
        else if($choixspe === "marketing")
        {
            $choixspe = "Marketing";
        }        
        else if($choixspe === "cg")
        {
            $choixspe = "Communication graphique";
        }
        else if($choixspe === "cm")
        {
            $choixspe = "Community Management";
        }


        echo "<tr>
              <td>$prenom $nom</td>
              <td>$choixspe</td>
              <td>
                <button type='button' class='btn btn-success btn-sm'>Voir le contact <i class='fas fa-user'></i></button>
                <button type='button' class='btn btn-primary btn-sm'>Modifier <i class='fas fa-pen'></i></button>
                <a href='delete.php?id=$id'><button type='button' class='btn btn-danger btn-sm'>Supprimer <i class='fas fa-trash'></i></button></a>
              </td>
              </tr>";
    }
        ?>
    </table>
</div>