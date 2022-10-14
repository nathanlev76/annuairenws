<?php
require_once("class/db.php");
class Login extends Db
{
    public string $mail;
    public string $password;

    public function __construct(string $email, string $motdepasse){
        $this->mail = $email;
        $this->password = password_hash($motdepasse, PASSWORD_DEFAULT);
    }

    public function getUserData(){
        $mail = $this->mail;
        $password = $this->password;

        return $password;
    }
}



