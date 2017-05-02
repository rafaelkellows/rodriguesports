<?php 
    require_once '../connector.php';
     
    $nvg = $_REQUEST["nvg"];
    $id = $_REQUEST["uid"];
    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $login = $_REQUEST["login"];
    $password = $_REQUEST["password"];
    $type = $_REQUEST["type"];
    $status = $_REQUEST["status"];
    $oConn = New Conn();

    if( 
    	$id != '' && $id != NULL && $name != '' && $name != NULL && $email != '' && $email != NULL && $login != '' && $login != NULL && 
    	$password != '' && $password != NULL && $type != '' && $type != NULL && $status != '' && $status != NULL && $nvg === 'user'
    ){
    	$all = $oConn->SQLupdater("usuarios","modified = now(), name = '$name', email = '$email', login = '$login', password = '$password', type = '$type', status = '$status'","id='".$id."'");
    	$row = $all->fetch(PDO::FETCH_ASSOC);
    	header('location: ../page.php?nvg=user&uid='.$id.'&msg=1');

    }else{
    	switch ($nvg) {
    		case "new_user":

    			$all = $oConn->SQLselector("*","usuarios","email='".$email."'");

				if( $all->rowCount() === 0){
			    	$all = $oConn->SQLinserter("usuarios","name,email,login,password,type,status,created,modified,visited","'$name','$email','$login','$password','$type','$status',now(),now(),now()");
			    	if($all){
			    		header('location: ../page.php?nvg=user&msg=2');
			    	}
			    	else{
			    		header('location: ../page.php?nvg=user&msg=0');
			    	}
		    	}else{
		    		header('location: ../page.php?nvg=user&msg=4&name='.$name.'&login='.$login.'&email='.$email.'&password='.md5($password).'&type='.$type.'&status='.$status);
		    	}
    			break;

    		case "delete_user":
		    	$all = $oConn->SQLdeleter("usuarios","id='".$id."'");

		    	if($all){
		    		header('location: ../page.php?nvg=user&msg=3');
		    	}
		    	else{
		    		header('location: ../page.php?nvg=user&msg=0');
		    	}

    		default:
    			break;
    	}
    }
?>