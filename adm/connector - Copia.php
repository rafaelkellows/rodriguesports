<?php
class Conn {
	public $pdo = NULL;
	private $sql = NULL;
    
    public function SQLselector($identifiers,$table,$conditions,$orderby) {
        $pdo = new PDO('mysql:dbname=db_spatula;host=localhost', 'root', '');
        $sqlWhere = ($conditions!='') ? 'WHERE ' . $conditions : '';
        $sqlOrderby = ($orderby!='') ? 'ORDER BY ' . $orderby : '';
        $sql = "SELECT {$identifiers} FROM {$table} ".$sqlWhere.' '.$sqlOrderby;
        $all = $pdo->query($sql);
        return $all;
    }
    public function SQLupdater($table,$identifiers,$conditions){
        $pdo = new PDO('mysql:dbname=db_spatula;host=localhost', 'root', '');
    	$sql = "UPDATE {$table} SET {$identifiers} WHERE {$conditions}";
        $all = $pdo->query($sql);
        return $all;
    }
    public function SQLinserter($table,$identifiers,$values){
        $pdo = new PDO('mysql:dbname=db_spatula;host=localhost', 'root', '');
        $sql = "INSERT INTO {$table} ({$identifiers}) VALUES ({$values})";
        $all = $pdo->prepare($sql)->execute();
        return $all;        
    }
    public function SQLdeleter($table,$conditions){
        $pdo = new PDO('mysql:dbname=db_spatula;host=localhost', 'root', '');
        $sql = "DELETE FROM {$table} WHERE {$conditions}";
        $all = $pdo->prepare($sql)->execute();
        return $all;
    }

}
?>
