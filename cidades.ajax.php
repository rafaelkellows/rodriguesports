<?php
	//header( 'Cache-Control: no-cache' );
	//header( 'Content-type: application/xml; charset="utf-8"', true );
	//header('Content-type: application/json');
header("Content-Type: text/plain");

  require_once 'connector.php';

  $oConn = New Conn();
	$cod_estados = $_REQUEST['cod_estados'];
	$cidades = array();
	$sqlCities = $oConn->SQLselector("*","cidades","estados_cod_estados='$cod_estados'",'nome');

	if ($sqlCities->rowCount() > 0) {
		while ( $row = $sqlCities->fetch(PDO::FETCH_ASSOC) ) {
			echo '<option value="'.$row['cod_cidades'].'">'.utf8_encode($row['nome']).'</option>';
		}
	}
