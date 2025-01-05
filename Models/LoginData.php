<?php

class LoginData
{
    private $username;
    private $password;

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    function checkPassword($password){
        return password_verify($password, $this->getPassword());
    }
}