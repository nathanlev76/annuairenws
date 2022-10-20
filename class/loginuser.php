<?php
require_once("class/db.php");
class Login extends Db
{
    public string $mail;
    public string $password;

    public function __construct(string $email, string $motdepasse){
        $this->mail = $email;
        $this->password = $motdepasse;
    }

    public function checkLogin(){
        $mail = $this->mail;
        $password = $this->password;
        $sql = new Sql();
        $result = $sql->sqlrequest('SELECT * FROM users WHERE mail = "'.$mail.'"');
        if(!empty($result))
        {
            foreach($result as $elem)
            {
                $dbpassword = $elem["password"];
            }
            if(password_verify($password, $dbpassword))
            {
                $loginResult = true;
            }
            else
            {
                $loginResult = false;
            }
        }
        
        return $loginResult;
    }
}



