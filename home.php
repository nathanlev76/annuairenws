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
        if(!isset($_GET['filter']) OR $_GET['filter'] === "none")
        {   
            if(!isset($_GET["sort"]) OR $_GET["sort"] === "id")
            {
                $result = $test->get("SELECT * FROM students WHERE prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search' ORDER BY id ASC");
            }
            else if($_GET["sort"] == "a-z"){
                $result = $test->get("SELECT * FROM students WHERE prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search' ORDER BY prenom ASC");
            }
            else if($_GET["sort"] == "z-a"){
                $result = $test->get("SELECT * FROM students WHERE prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search' ORDER BY prenom DESC");
            }
            else if($_GET["sort"] == "spe"){
                $result = $test->get("SELECT * FROM students WHERE prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search' ORDER BY choixspe ASC");
            }
        }
        else 
        {
            $filter = $_GET["filter"];
            if(!isset($_GET["sort"]) OR $_GET["sort"] === "id")
            {
                $result = $test->get("SELECT * FROM students WHERE choixspe = '$filter' AND prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search' ORDER BY id ASC");
            }
            else if($_GET["sort"] == "a-z"){
                $result = $test->get("SELECT * FROM students WHERE choixspe = '$filter' AND prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search' ORDER BY prenom ASC");
            }
            else if($_GET["sort"] == "z-a"){
                $result = $test->get("SELECT * FROM students WHERE choixspe = '$filter' AND prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search' ORDER BY prenom DESC");
            }
            else if($_GET["sort"] == "spe"){
                $result = $test->get("SELECT * FROM students WHERE choixspe = '$filter' AND prenom LIKE '$search' OR nom LIKE '$search' or CONCAT(prenom, ' ', nom) LIKE '$search' ORDER BY choixspe ASC");
            }            
        }
    }
    else
    {
        if(isset($_GET["sort"]) && !isset($_GET["filter"]))
        {
            $sort = $_GET["sort"];
            header("location: home.php?sort=$sort");
        }
        else if(isset($_GET["sort"]) && isset($_GET["filter"]))
        {
            $sort = $_GET["sort"];
            $filter = $_GET["filter"];
            header("location: home.php?sort=$sort&filter=$filter");
        }
        else if(!isset($_GET["sort"]) && isset($_GET["filter"]))
        {
            $filter = $_GET["filter"];
            header("location: home.php?filter=$filter");
        }
        else
        {
            header("location: home.php");
        }

    }
}
else
{
$test = new sqlRequest();
//$result = $test->get("INSERT INTO `students` (`id`, `sexe`, `prenom`, `nom`, `telephone`, `email`, `choixspe`) VALUES (NULL, 'M', 'Ugo', 'Rastell', '0102030405', 'urastell@normandiewebschool.fr', 'Développement')");

if(!isset($_GET["filter"]) OR $_GET["filter"] === "none")
{
    if(!isset($_GET["sort"]) OR $_GET["sort"] === "id")
    {
        $result = $test->get('SELECT * FROM students ORDER BY id ASC');
    }
    else if($_GET["sort"] == "a-z"){
        $result = $test->get('SELECT * FROM students ORDER BY prenom ASC');
    }
    else if($_GET["sort"] == "z-a"){
        $result = $test->get('SELECT * FROM students ORDER BY prenom DESC');
    }
    else if($_GET["sort"] == "spe"){
        $result = $test->get('SELECT * FROM students ORDER BY choixspe ASC');
    }
}
else
{ 
    $filter = $_GET["filter"];
    if(!isset($_GET["sort"]) OR $_GET["sort"] === "id")
    {
        $result = $test->get("SELECT * FROM students WHERE choixspe = '$filter' ORDER BY id ASC");
    }
    else if($_GET["sort"] == "a-z"){
        $result = $test->get("SELECT * FROM students WHERE choixspe = '$filter' ORDER BY prenom ASC");
    }
    else if($_GET["sort"] == "z-a"){
        $result = $test->get("SELECT * FROM students WHERE choixspe = '$filter' ORDER BY prenom DESC");
    }
    else if($_GET["sort"] == "spe"){
        $result = $test->get("SELECT * FROM students WHERE choixspe = '$filter' ORDER BY choixspe ASC");
    }   
}
}
?>

<h1><img src="assets/logo/nws_logo.png" height=55 width=55>Annuaire NWS</h1>

<div class="searchbar">
    <form method="GET" id="searchform">
        <input type="search" name="search" placeholder="Rechercher un contact" <?php if(isset($_GET['search'])){echo "value='$search'";}?>>
        <input class="btn btn-primary btn-sm" type="submit" value="Chercher">
    </form>
    <div id="trierdiv">
        <label for="trier">Trier par:</label>
        <select id='trier' name='sort' form='searchform'>
            <option value="id">ID</option>
            <option value="a-z" <?php if(isset($_GET["sort"])){if($_GET["sort"] === "a-z"){echo "selected";}}?>>Ordre alphabétique (A-Z)</option>
            <option value="z-a" <?php if(isset($_GET["sort"])){if($_GET["sort"] === "z-a"){echo "selected";}}?>>Ordre alphabétique (Z-A)</option>
            <option value="spe" <?php if(isset($_GET["sort"])){if($_GET["sort"] === "spe"){echo "selected";}}?>>Spécialités</option>
        </select>
        <label for="filtrer">Filtre:</label>
        <select id='filtrer' name='filter' form='searchform'>
            <option value="none">Aucun</option>
            <option value="dev" <?php if(isset($_GET["filter"])){if($_GET["filter"] === "dev"){echo "selected";}}?>>Développement Web</option>
            <option value="cm" <?php if(isset($_GET["filter"])){if($_GET["filter"] === "cm"){echo "selected";}}?>>Community Management</option>
            <option value="marketing" <?php if(isset($_GET["filter"])){if($_GET["filter"] === "marketing"){echo "selected";}}?>>Marketing</option>
            <option value="cg" <?php if(isset($_GET["filter"])){if($_GET["filter"] === "cg"){echo "selected";}}?>>Communication graphique</option>
        </select>
    </div>
</div>


<?php
    if(!$result AND isset($search))
    {
        echo "<div class='errormessage'><div class='alert alert-danger' role='alert'>Aucun résultat pour la recherche: $search</div></div>";
    }
    else if(!$result AND !isset($search))
    {
        echo "<div class='errormessage'><div class='alert alert-danger' role='alert'>Aucun résultat avec ce filtre</div></div>";
    }
?>

<?php
if(!$result)
{
    echo '<div id="testdiv" hidden>';
}
else
{
    echo '<div id="testdiv">';  
}

?>
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
                <a href='info.php?id=$id'><button type='button' class='btn btn-success btn-sm'>Voir le contact <i class='fas fa-user'></i></button></a>
                <a href='edit.php?id=$id'><button type='button' class='btn btn-primary btn-sm'>Modifier <i class='fas fa-pen'></i></button></a>
                <a href='delete.php?id=$id'><button type='button' class='btn btn-danger btn-sm'>Supprimer <i class='fas fa-trash'></i></button></a>
              </td>
              </tr>";
    }
        ?>
    </table>
</div>
<a href="add.php"><button type='button' class='btn btn-success addbutton'><i class='fas fa-plus'></i> Ajouter un contact</button><a>