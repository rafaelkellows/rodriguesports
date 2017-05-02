<?php 
    require_once '../connector.php';
     
    $nvg = $_REQUEST["nvg"];
    $cid = $_REQUEST["cid"]; //Category ID
    $sid = $_REQUEST["sid"]; //SubCategory ID
    $chn = $_REQUEST["chn"]; 
    $title = $_REQUEST["title"];
    $oConn = New Conn();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		if( $cid != '' && $cid != NULL && $sid != '' && $sid != NULL && $chn != '' && $chn != NULL && $title != '' && $title != NULL){
	    	switch ($nvg) {
	    		case "add":
			    	//Add Category
			    	if( $cid == 0 && $sid == 0){
				    	$all = $oConn->SQLinserter("categories","name,link,description,created,modified","'$title','aaa','sss',now(),now()");
						if($all){
							header('location: ../page.php?nvg=categories&msg=2');
						}
				    	else{
				    		header('location: ../page.php?nvg=categories&msg=0');
				    	}
			    	}
			    	//Add Category
			    	if( $cid > 0 && $sid == 0){
				    	$all = $oConn->SQLinserter("subcategories","cid,name,link,created,modified","'$cid','$title','javascript:void(0);',now(),now()");
						if($all){
							header('location: ../page.php?nvg=categories&msg=2');
						}else{
				    		header('location: ../page.php?nvg=categories&msg=0');
				    	}
					}
					break;
	    		case "edit":
			    	if( $cid > 0 && $sid == 0){
						$all = $oConn->SQLupdater('categories',"modified = now(), name = '$title', link = 'javascript:void(0);'","id='".$cid."'");
						if($all){
							header('location: ../page.php?nvg=categories&msg=1');
						}else{
				    		header('location: ../page.php?nvg=categories&msg=0');
				    	}
					}
					if( $cid > 0 && $sid > 0){
						$all = $oConn->SQLupdater('subcategories',"modified = now(), name = '$title', link = 'javascript:void(0);'","id='".$sid."' AND cid='".$cid."'");
						if($all){
							header('location: ../page.php?nvg=categories&msg=1');
						}else{
				    		header('location: ../page.php?nvg=categories&msg=0');
				    	}
					}
					break;
	    		case "delete":
			    	if( $cid > 0 && $sid == 0){
						$all = $oConn->SQLdeleter("categories","id='".$cid."'");
						if($all){
							header('location: ../page.php?nvg=categories&msg=3');
						}else{
				    		header('location: ../page.php?nvg=categories&msg=0');
				    	}
					}
					if( $cid > 0 && $sid == -1){
						$allCat = $oConn->SQLdeleter("categories","id='".$cid."'");
						$allSub = $oConn->SQLdeleter("subcategories","cid='".$cid."'");
						if($allCat && $allSub){
							header('location: ../page.php?nvg=categories&msg=3');
						}else{
				    		header('location: ../page.php?nvg=categories&msg=0');
				    	}
			    		
					}
					if( $cid > 0 && $sid > 0){
						$all = $oConn->SQLdeleter("subcategories","id='".$sid."' AND cid='".$cid."'");
						if($all){
							header('location: ../page.php?nvg=categories&msg=3');
						}else{
				    		header('location: ../page.php?nvg=categories&msg=0');
				    	}
					}
					break;
    			default:
    				break;
			}
		}
			
	}else{
		header('location: ../page.php?nvg=home');
	}
?>