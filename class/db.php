<?php

class Db
{
    public function connect(){
        $getfile = file_get_contents('database.json');
        $jsonfile = json_decode($getfile);
        $array = json_decode(json_encode($jsonfile), true);

        $dbusername = $array["username"];
        $dbpassword = $array["password"];
        $dbhost = $array["host"];
        try{
            $dbh = new PDO("mysql:host=$dbhost;dbname=annuaire", $dbusername, $dbpassword);
            return $dbh;
        }catch (PDOException $e){
            print "Erreur de la base de données: " . $e->getMessage() . "</br>";
            die();
        }
    }
}

class sqlRequest extends Db{
    public function get($requete){
        $pdo = $this->connect();

        $sql = $requete;
    
        $query = $pdo->prepare($sql);
        try{
            $request = $query->execute();
        }
        catch(PDOException $e){
            echo $e;
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