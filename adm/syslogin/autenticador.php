<?php
abstract class Autenticador {
 
    private static $instancia = null;
 
    private function __construct() {}
 
    /**
     * 
     * @return Autenticador
    */
    public static function instanciar() {
 
        if (self::$instancia == NULL) {
            self::$instancia = new AutenticadorEmBanco();
        }
 
        return self::$instancia;
 
    }
 
    public abstract function logar($login, $password);
    public abstract function esta_logado();
    public abstract function pegar_usuario();
    public abstract function expulsar();
}

class AutenticadorEmBanco extends Autenticador {
 
    public function esta_logado() {
        $sess = Sessao::instanciar();
        return $sess->existe('usuario');
    }
 
    public function expulsar() {
        header('location: syslogin/controle.php?acao=sair');
    }
 
    public function logar($login, $password) {
 
        $pdo = new PDO('mysql:dbname=db_teste;host=db-teste.mysql.uhserver.com', 'spatula', 'Spatul@2016');
        //$pdo = new PDO('mysql:dbname=db_teste;host=localhost', 'root', '');
        $sess = Sessao::instanciar();
 
        $sql = "select * from usuarios where usuarios.login ='{$login}' and usuarios.password = '{$password}'";
        $sqlUpdate = "UPDATE usuarios SET visited = now() WHERE usuarios.login = '{$login}' AND usuarios.password = '{$password}'";
 
        $stm = $pdo->query($sql);
 
        if ($stm->rowCount() > 0) {
 
            $dados = $stm->fetch(PDO::FETCH_ASSOC);
 
            $usuario = new Usuario();
            $usuario->setId($dados['id']);
            $usuario->setName($dados['name']);
            $usuario->setEmail($dados['email']);
            $usuario->setLogin($dados['login']);
            $usuario->setPassword($dados['password']);
            $usuario->setType($dados['type']);
            $usuario->setActive($dados['status']);         
            $usuario->setVisited($dados['visited']);

            $sess->set('usuario', $usuario);
            $stm = $pdo->query($sqlUpdate);
            return true;
 
        }
        else {
            return false;
        }
 
    }
 
    public function pegar_usuario() {
        $sess = Sessao::instanciar();
 
        if ($this->esta_logado()) {
            $usuario = $sess->get('usuario');
            return $usuario;
        }
        else {
            return false;
        }
    }
}
?>