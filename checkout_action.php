<?php
	//header("Content-Type: text/xml, charset=ISO-8859-1");
	/*$email = 'rustoncm@gmail.com';
	$token = '8F896EB3AE88414583D811BA8C64084C';*/
  $email = 'rafaelkellows86@gmail.com';
  $token = '775F623166EA4E168B5485AB8771EE83';
	$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?email=' . $email . '&token=' . $token;

  $id_user = ( isset($_REQUEST["id_user"] ) ) ? $_REQUEST["id_user"] : 0 ;
  $itens = ( isset($_REQUEST["itens"] ) ) ? $_REQUEST["itens"] : 0 ;
  $currency = ( isset($_REQUEST["coin_currency"] ) ) ? $_REQUEST["coin_currency"] : '' ;
  $reference = ( isset($_REQUEST["reference"] ) ) ? $_REQUEST["reference"] : '' ;
  $senderName = ( isset($_REQUEST["senderName"] ) ) ? $_REQUEST["senderName"] : '' ;
  $senderAreaCode = ( isset($_REQUEST["senderAreaCode"] ) ) ? $_REQUEST["senderAreaCode"] : '' ;
  $senderPhone = ( isset($_REQUEST["senderPhone"] ) ) ? $_REQUEST["senderPhone"] : '' ;
  $senderEmail = ( isset($_REQUEST["senderEmail"] ) ) ? $_REQUEST["senderEmail"] : '' ;
	$shippingType = ( isset($_REQUEST["shippingType"] ) ) ? $_REQUEST["shippingType"] : '' ;
	$shippingAddressStreet = ( isset($_REQUEST["shippingAddressStreet"] ) ) ? $_REQUEST["shippingAddressStreet"] : '' ;
	$shippingAddressNumber = ( isset($_REQUEST["shippingAddressNumber"] ) ) ? $_REQUEST["shippingAddressNumber"] : '' ;
	$shippingAddressDistrict = ( isset($_REQUEST["shippingAddressDistrict"] ) ) ? $_REQUEST["shippingAddressDistrict"] : '' ;
	$shippingAddressComplement = ( isset($_REQUEST["shippingAddressComplement"] ) ) ? $_REQUEST["shippingAddressComplement"] : '' ;
	$shippingAddressPostalCode = ( isset($_REQUEST["shippingAddressPostalCode"] ) ) ? $_REQUEST["shippingAddressPostalCode"] : '' ;
	$shippingAddressCity = ( isset($_REQUEST["shippingAddressCity"] ) ) ? $_REQUEST["shippingAddressCity"] : '' ;
	$shippingAddressState = ( isset($_REQUEST["shippingAddressState"] ) ) ? $_REQUEST["shippingAddressState"] : '' ;
	$shippingAddressCountry = ( isset($_REQUEST["shippingAddressCountry"] ) ) ? $_REQUEST["shippingAddressCountry"] : '' ;
	
	$urli = $_SERVER['REQUEST_URI'];
	$exploded = array();
	parse_str($urli, $exploded);
	//$values = parse_url($url);
	//$host = explode('.',$values['host']);
	$item = '';
	for ($x = 1; $x <= $itens; $x++) {
		$item .=	'        <item>';
		$item .=	'            <id>'.$exploded['itemId'.$x].'</id>';
		$item .=	'            <description>'.$exploded['itemDescription'.$x].'</description>';
		$item .=	'            <amount>'.$exploded['itemAmount'.$x].'</amount>';
		$item .=	'            <quantity>'.$exploded['itemQuantity'.$x].'</quantity>';
		$item .=	'            <weight>'.$exploded['itemWeight'.$x].'</weight>';
		$item .=	'        </item>';
	} 

$xml = '<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
    <checkout>
        <currency>'.$currency.'</currency>
        <redirectURL>http://www.minhaloja.com.br/paginaDeRedirecionamento</redirectURL>
        <items>
            '.$item.'
        </items>
        <reference>'.$reference.'</reference>
        <sender>
            <name>'.$senderName.'</name>
            <email>'.$senderEmail.'</email>
            <phone>
                <areaCode>'.$senderAreaCode.'</areaCode>
                <number>'.$senderPhone.'</number>
            </phone>
        </sender>
	    <shipping>
	        <type>'.$shippingType.'</type>
	        <address>
	            <street>'.$shippingAddressStreet.'</street>
	            <number>'.$shippingAddressNumber.'</number>
	            <complement>'.$shippingAddressComplement.'</complement>
	            <district>'.$shippingAddressDistrict.'</district>
	            <postalCode>'.$shippingAddressPostalCode.'</postalCode>
	            <city>'.$shippingAddressCity.'</city>
	            <state>'.$shippingAddressState.'</state>
	            <country>'.$shippingAddressCountry.'</country>
	        </address>
	    </shipping>
    </checkout>';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/xml; charset=ISO-8859-1'));
	curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);


	if($xml == 'Unauthorized'){
		echo '0';
		exit;
	}

	$xml = curl_exec($curl);
	curl_close($curl);

	$xml = simplexml_load_string($xml);

	if(count($xml -> error) > 0){
    echo '0';
	}else{
    echo $xml -> code;
	}

	//print 'code '.$xml->code;
	//header('Location: https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $xml -> code)

?>