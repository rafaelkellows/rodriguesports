<?php
	header("Content-Type: text/plain, charset=ISO-8859-1");
  require_once 'connector.php';
  /*$email = 'rustoncm@gmail.com';
  $token = '8F896EB3AE88414583D811BA8C64084C';*/
  $email = 'rafaelkellows86@gmail.com';
  $token = '775F623166EA4E168B5485AB8771EE83';
  $transaction = $_REQUEST['tcode'];
  $id_user = ( isset($_REQUEST["id_user"] ) ) ? $_REQUEST["id_user"] : 0 ;
  $logo_path = ( isset($_REQUEST["logo_path"] ) ) ? $_REQUEST["logo_path"] : 0 ;
	$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/' . $transaction . '?email=' . $email . '&token=' . $token;
	
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $transaction = curl_exec($curl);
  curl_close($curl);

  if($transaction == 'Unauthorized'){
  	echo "0";
    exit;
  }else{
	  //$transaction = simplexml_load_string($transaction);
    if($id_user!=0){
      $oConn = New Conn();
      $sqlInsert = $oConn->SQLinserter("tbl_requests","id_user,trans_code,file_logo_marca,created","'$id_user','".$_REQUEST['tcode']."','$logo_path',now()");
      if($sqlInsert){
        echo $transaction;
        echo '2';
      }else{
        echo '1';
      }
    }else{
      echo $transaction;
    }
  }



?>