<?php

class Db
{
    public function connect(){
        try{
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=annuaire', $username, $password);
        }catch (PDOException $e){
            print "Erreur de la base de données: " . $e->getMessage() . "</br>";
            die();
        }
    }
}

class Sql extends Db{
    public function sqlrequest(){
        $pdo = connect();

        $sql = $requete;
    
        $query = $pdo->prepare($sql);
    
        $query->execute();
    
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
}