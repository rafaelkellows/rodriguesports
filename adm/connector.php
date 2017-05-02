<?php
class Conn {
    public $pdo = NULL;
    private $sql = NULL;
    
    public function SQLselector($identifiers,$table,$conditions,$orderby) {
        try{
          // Faz conexão com banco de daddos
          //$pdo = new PDO('mysql:dbname=db_rodsports;host=db-teste.mysql.uhserver.com', 'spatula', 'Spatul@2016');
          $pdo = new PDO('mysql:dbname=db_rodsports;host=localhost', 'root', '');
        }catch(PDOException $e){
          // Caso ocorra algum erro na conexão com o banco, exibe a mensagem
          echo 'Falha ao conectar no banco de dados: '.$e->getMessage();
          die;
        }
        //$pdo = new PDO('mysql:dbname=db_rodsports;host=db-teste.mysql.uhserver.com', 'adm_spatula', '@dmSp@tul@2016');
        
        $sqlWhere = ($conditions!='') ? 'WHERE ' . $conditions : '';
        $sqlOrderby = ($orderby!='') ? 'ORDER BY ' . $orderby : '';
        $sql = "SELECT {$identifiers} FROM {$table} ".$sqlWhere.' '.$sqlOrderby;
        $all = $pdo->query($sql);
        return $all;
    }
    public function SQLupdater($table,$identifiers,$conditions){
        try{
          // Faz conexão com banco de daddos
          //$pdo = new PDO('mysql:dbname=db_rodsports;host=db-teste.mysql.uhserver.com', 'spatula', 'Spatul@2016');
          $pdo = new PDO('mysql:dbname=db_rodsports;host=localhost', 'root', '');
        }catch(PDOException $e){
          // Caso ocorra algum erro na conexão com o banco, exibe a mensagem
          echo 'Falha ao conectar no banco de dados: '.$e->getMessage();
          die;
        }
        $sql = "UPDATE {$table} SET {$identifiers} WHERE {$conditions}";
        $all = $pdo->query($sql);
        return $all;
    }
    public function SQLinserter($table,$identifiers,$values){
        try{
          // Faz conexão com banco de daddos
          //$pdo = new PDO('mysql:dbname=db_rodsports;host=db-teste.mysql.uhserver.com', 'spatula', 'Spatul@2016');
          $pdo = new PDO('mysql:dbname=db_rodsports;host=localhost', 'root', '');
        }catch(PDOException $e){
          // Caso ocorra algum erro na conexão com o banco, exibe a mensagem
          echo 'Falha ao conectar no banco de dados: '.$e->getMessage();
          die;
        }
        $stmt = $pdo->prepare("INSERT INTO $table ({$identifiers}) VALUES ({$values})");
        if($stmt->execute()){
           return '1';
         }else{
           return '0';
        }
    }
    public function SQLdeleter($table,$conditions){
        try{
          // Faz conexão com banco de daddos
          //$pdo = new PDO('mysql:dbname=db_rodsports;host=db-teste.mysql.uhserver.com', 'spatula', 'Spatul@2016');
          $pdo = new PDO('mysql:dbname=db_rodsports;host=localhost', 'root', '');
        }catch(PDOException $e){
          // Caso ocorra algum erro na conexão com o banco, exibe a mensagem
          echo 'Falha ao conectar no banco de dados: '.$e->getMessage();
          die;
        }
        $sql = "DELETE FROM {$table} WHERE {$conditions}";
        $all = $pdo->prepare($sql)->execute();
        return $all;
    }

}

?>


