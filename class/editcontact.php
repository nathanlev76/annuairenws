<?php
require_once("class/db.php");
class editContact extends Db
{
    public string $name;
    public string $lastname;
    public string $gender;
    public string $age;
    public string $phone;
    public string $mail;
    public string $spe;

    public function __construct(string $name, string $lastname, string $gender, string $age, string $phone, string $mail, string $spe, string $id){
        $this->prenom = $name;
        $this->nom = $lastname;
        $this->genre = $gender;
        $this->age1 = $age;
        $this->telephone = $phone;
        $this->email = $mail;
        $this->choixspe = $spe;
        $this->id = $id;
    }

    public function editContact(){
        $test = new sqlRequest();
        $name = $this->prenom;
        $lastname = $this->nom;
        $gender = $this->genre;
        $age = $this->age1;
        $phone = $this->telephone;
        $mail = $this->email;
        $spe = $this->choixspe;
        $id = $this->id;
        $result = $test->get("UPDATE `students` SET `prenom` = '$name', 
                                                    `nom` = '$lastname',
                                                    `sexe` = '$gender',
                                                    `age` = '$age',
                                                    `telephone` = '$phone',
                                                    `email` = '$mail',
                                                    `choixspe` = '$spe'     
                                                    WHERE id = $id");
        return $result;
    }
}