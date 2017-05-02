<?php 
    require_once '../connector.php';
     
    $nvg = $_REQUEST["nvg"];
    $id = $_REQUEST["bid"];
    $src = $_REQUEST["src"];
    $alt = $_REQUEST["alt"];
    $title = $_REQUEST["title"];
    $description = $_REQUEST["description"];

    $link = ( $_REQUEST["link"] == 0 ) ? $_REQUEST["external_link"] : './produto.php?id_prod='.$_REQUEST["link"] ;
    $target = $_REQUEST["target"];
    $align = $_REQUEST["align"];
    $status = $_REQUEST["status"];
    $oConn = New Conn();

    if( 
    	$id != '' && $id != NULL && $src != '' && $src != NULL && $target != '' && $target != NULL && $align != '' && $align != NULL && $status != '' && $status != NULL && $nvg === 'banner'
    ){
    	$all = $oConn->SQLupdater("banners","modified = now(), src = '$src', alt = '$alt', title = '$title', description = '$description', link = '$link', target = '$target', align = '$align', status = '$status'","id='".$id."'");
    	$row = $all->fetch(PDO::FETCH_ASSOC);
    	header('location: ../page.php?nvg=banner&bid='.$id.'&msg=1');

    }else{
    	switch ($nvg) {
    		case "new_banner":
                $all = $oConn->SQLselector("*","banners","src='".$src."'",'');
				if( $all->rowCount() === 0){
                    $all = $oConn->SQLinserter("banners","pos,src,alt,title,description,link,target,align,status,created,modified","'0','$src','$alt','$title','$description','$link','$target','$align','$status',now(),now()");
                    if($all){
			    		header('location: ../page.php?nvg=banners&msg=2');
			    	}
			    	else{
			    		header('location: ../page.php?nvg=banner&msg=0');
			    	}
		    	}else{
		    		header('location: ../page.php?nvg=banner&msg=4');
		    	}
    			break;

    		case "delete_banner":
		    	$all = $oConn->SQLdeleter("banners","id='".$id."'");
                $ref = (isset($_REQUEST["ref"])) ? 'banners' : 'banner';
		    	if($all){
		    		header('location: ../page.php?nvg='.$ref.'&msg=3');
		    	}
		    	else{
		    		header('location: ../page.php?nvg='.$ref.'&msg=0');
		    	}

    		default:
    			break;
    	}
    }
?>