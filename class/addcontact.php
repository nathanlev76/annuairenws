<?php
require_once("class/db.php");
class CreateContact extends Db
{
    public string $name;
    public string $lastname;
    public string $gender;
    public string $age;
    public string $phone;
    public string $mail;
    public string $spe;

    public function __construct(string $name, string $lastname, string $gender, string $age, string $phone, string $mail, string $spe){
        $this->prenom = $name;
        $this->nom = $lastname;
        $this->genre = $gender;
        $this->age1 = $age;
        $this->telephone = $phone;
        $this->email = $mail;
        $this->specialite = $spe;
    }

    public function addContact(){
        $prenom = $this->prenom;
        $nom = $this->nom;
        $genre = $this->genre;
        $age1 = $this->age1;
        $telephone = $this->telephone;
        $email = $this->email;
        $specialite = $this->specialite;
        $test = new sqlRequest();
        $result = $test->get("INSERT INTO `students` (`id`, `sexe`, `prenom`, `nom`, `age`, `telephone`, `email`, `choixspe`) VALUES (NULL, '$genre', '$prenom', '$nom', '$age1', '$telephone', '$email', '$specialite');");
    }
}