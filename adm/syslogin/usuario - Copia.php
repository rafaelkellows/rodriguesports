<?php
class Usuario {
    private $id = null;
    private $name = null;
    private $email = null;
    private $login = null;
    private $password = null;
    private $active = null;
 
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getActive() {
        return $this->active;
    }
 
    public function setId($id) {
        $this->id = $id;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setLogin($login) {
        $this->login = $login;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setActive($active) {
        $this->active = $active;
    }
}
?>
