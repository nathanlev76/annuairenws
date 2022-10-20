<?php

class Db
{
    public function connect(){
        try{
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=annuaire', $username, $password);
            return $dbh;
        }catch (PDOException $e){
            print "Erreur de la base de données: " . $e->getMessage() . "</br>";
            die();
        }
    }
}

class Sql extends Db{
    public function sqlrequest($requete){
        $pdo = $this->connect();

        $sql = $requete;
    
        $query = $pdo->prepare($sql);
        try{
            $request = $query->execute();
        }
        catch(PDOException $e){
            return False;
        }
    
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($request){
            return $result;
        }
        else{
            return False;
        }

    }
}