 <?php 
    //require_once '../connector.php';

	//$all = $oConn->SQLinserter("categories","name,link,created,modified","'Titulo','sem link',now(),now()");

    $pdo = new PDO('mysql:dbname=db_spatula;host=db-spatula.mysql.uhserver.com', 'adm_spatula', '@dmSp@tul@2016');
     if(!$pdo){
       die('Erro ao criar a conexão');
   }
    $sql = "INSERT INTO categories (name,link) VALUES ('Titulo','sem link')";
    echo $sql;
    $all = $pdo->query($sql);
    echo 'return' . $all;
   // return $all;
?>
