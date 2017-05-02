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
 
    public abstract function confirm($login, $password);
    public abstract function logar($login, $password);
    public abstract function esta_logado();
    public abstract function pegar_usuario();
    public abstract function expulsar();
}

class AutenticadorEmBanco extends Autenticador {
 
    public function esta_logado() {
        $sess = Sessao::instanciar();
        return $sess->existe('usuarioSite');
    }
    public function expulsar() {
        header('location: login/controle.php?acao=sair');
    }
    public function logar($login, $password) {
        try{
            // Faz conexão com banco de daddos
            $pdo = new PDO('mysql:dbname=db_users;host=db-users.mysql.uhserver.com', 'rafaelkellows', 'Spatul@2016');
            //$pdo = new PDO('mysql:dbname=db_users;host=localhost', 'root', '');
        }catch(PDOException $e){
            // Caso ocorra algum erro na conexão com o banco, exibe a mensagem
            echo 'Falha ao conectar no banco de dados: '.$e->getMessage();
            die;
        }
        $sess = Sessao::instanciar();
 
        $sql = "select * from tbl_accounts where tbl_accounts.login ='{$login}' and tbl_accounts.password = '{$password}'"; // and tbl_accounts.status = 1
        $sqlUpdate = "UPDATE tbl_accounts SET visited = now() WHERE tbl_accounts.login = '{$login}' AND tbl_accounts.password = '{$password}'";
 
        $stm = $pdo->query($sql);
        if ($stm->rowCount() > 0) {
            $dados = $stm->fetch(PDO::FETCH_ASSOC);
            $usuario = new UsuarioSite();
            $usuario->setId($dados['id']);
            $usuario->setName($dados['name']);
            $usuario->setEmail($dados['email']);
            $usuario->setLogin($dados['login']);
            $usuario->setPassword($dados['password']);
            $usuario->setActive($dados['status']);         
            $usuario->setVisited($dados['visited']);

            $sess->set('usuarioSite', $usuario);
            $stm = $pdo->query($sqlUpdate);
            return true;
        }
        else {
            return false;
        }
 
    }
    public function confirm($login, $password) {
        try{
            // Faz conexão com banco de daddos
            $pdo = new PDO('mysql:dbname=db_users;host=db-users.mysql.uhserver.com', 'rafaelkellows', 'Spatul@2016');
            //$pdo = new PDO('mysql:dbname=db_users;host=localhost', 'root', '');
        }catch(PDOException $e){
            // Caso ocorra algum erro na conexão com o banco, exibe a mensagem
            echo 'Falha ao conectar no banco de dados: '.$e->getMessage();
            die;
        }
        $sess = Sessao::instanciar();
 
        $sql = "select * from tbl_accounts where tbl_accounts.login ='{$login}' and tbl_accounts.password = '{$password}' and tbl_accounts.status = 0"; // and tbl_accounts.status = 1
        $stm = $pdo->query($sql);
        
        if ($stm->rowCount() > 0) {
            $dados = $stm->fetch(PDO::FETCH_ASSOC);
            $usuario = new UsuarioSite();
            $usuario->setName($dados['name']);
            $usuario->setEmail($dados['email']);
            $usuario->setKToken($dados['key_token']);
            $sess->set('usuarioSite', $usuario);
            return true;
        }
        else {
            return false;
        }
 
    }
 
    public function pegar_usuario() {
        $sess = Sessao::instanciar();
 
        if ($this->esta_logado()) {
            $usuario = $sess->get('usuarioSite');
            return $usuario;
        }
        else {
            return false;
        }
    }
}
?>