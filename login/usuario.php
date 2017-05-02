<?php
class UsuarioSite {
    private $id = null;
    private $name = null;
    private $email = null;
    private $login = null;
    private $key_token = null;
    private $password = null;
    private $type = null;
    private $active = null;
    private $visited = null;
 
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
    public function getKToken() {
        return $this->key_token;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getType() {
        return $this->type;
    }
    public function getActive() {
        return $this->active;
    }
    public function getVisited() {
        return $this->visited;
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
    public function setKToken($key_token) {
        $this->key_token = $key_token;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function setActive($active) {
        $this->active = $active;
    }
    public function setVisited($visited) {
        $date = date_create($visited);
        $this->visited = date_format($date, 'd/m/y') . ' às ' .date_format($date, 'G:ia') ; 
    }
}
?>
