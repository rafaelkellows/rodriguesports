<?php 
    require_once '../connector.php';
     
    $nvg = $_REQUEST["nvg"];
    $id = $_REQUEST["pid"];
    $title = $_REQUEST["title"];
    $resume = $_REQUEST["resume"];
    $description = $_REQUEST["description"];
    $category = $_REQUEST["category"];
    $i_subcategory = ( isset($_REQUEST["i_subcategory"] ) ) ? $_REQUEST["i_subcategory"] : '0' ;
    $subcategory = (($i_subcategory != 'subcategory_0') && ($i_subcategory != 0) && ($i_subcategory != '0')) ? $_REQUEST[$i_subcategory] : '0'; 
    //$subcategory = ( $i_subcategory != '0' ) ? substr(strstr($i_subcategory, '_'), 1) : 0 ;
    $gallery = ( isset($_REQUEST["gallery"] ) ) ? $_REQUEST["gallery"] : 0 ;
    $capa = ( isset($_REQUEST["capa"] ) ) ? $_REQUEST["capa"] : 0 ;
    $colors = ( isset($_REQUEST["colors"] ) ) ? $_REQUEST["colors"] : 0 ;
    $size = ( isset($_REQUEST["size"] ) ) ? $_REQUEST["size"] : 0 ;
    $length = ( isset($_REQUEST["length"] ) ) ? $_REQUEST["length"] : 0 ;
    $width = ( isset($_REQUEST["width"] ) ) ? $_REQUEST["width"] : 0 ;
    $depth = ( isset($_REQUEST["depth"] ) ) ? $_REQUEST["depth"] : 0 ;
    $radius = ( isset($_REQUEST["radius"] ) ) ? $_REQUEST["radius"] : 0 ;
    $height = ( isset($_REQUEST["height"] ) ) ? $_REQUEST["height"] : 0 ;
    $weight = ( isset($_REQUEST["weight"] ) ) ? $_REQUEST["weight"] : 0 ;
    //$min_price = ( isset($_REQUEST["min_price"] ) ) ? $_REQUEST["min_price"] : null ;
    $max_price = ( isset($_REQUEST["max_price"] ) ) ? $_REQUEST["max_price"] : null ;
    $prod_code = ( isset($_REQUEST["prod_code"] ) ) ? $_REQUEST["prod_code"] : null ;
    $highlight = ( isset($_REQUEST["highlight"] ) ) ? $_REQUEST["highlight"] : 0 ;
    $combine = ( isset($_REQUEST["combine"] ) ) ? $_REQUEST["combine"] : 0 ;
    $status = ( isset($_REQUEST["status"] ) ) ? $_REQUEST["status"] : 0 ;

    $oConn = New Conn();
	switch ($nvg) {
		case "produto":
            if(isset($id) ){
                //Gallery
                if(isset($_REQUEST["gallery"]) ){
                    $goon = true;
                    //For each image from Form
                    foreach($_REQUEST["gallery"] as $g => $g_name ){
                        $sqlSct = $oConn->SQLselector("*","galeria","pid='".$id."'",'');
                        $exist = false;
                        $currIMG = $gallery[$g];

                        while ( $row_gallery = $sqlSct->fetch(PDO::FETCH_ASSOC) ) {
                            $currSRC = $row_gallery["src"];
                            if( $gallery[$g] == $currSRC ){
                                $exist = true;
                                $currIMG = '';
                                break;
                            }
                        }
                        if(!$exist){
                            $sqlInsert = $oConn->SQLinserter("galeria","pid, src, inserted","'$id','$currIMG',now()");
                            if( stripos($capa, '?') ){
                                $sqlSct = $oConn->SQLselector("*","galeria","src='".str_replace('../', '', $capa)."'",'');
                                $row = $sqlSct->fetch(PDO::FETCH_ASSOC);
                                if($row){
                                    $capa = $row['id'];
                                    $goon = false;
                                    break;
                                }
                            }
                        }
                    }
                    //For each image from Database
                    if($goon){
                        $sqlSct = $oConn->SQLselector("*","galeria","pid='".$id."'",'');
                        while ( $row_gallery = $sqlSct->fetch(PDO::FETCH_ASSOC) ) {
                            $currSRC = $row_gallery["src"];
                            $currIMG = '';
                            $exist = false;
                            foreach($_REQUEST["gallery"] as $g => $g_name ){
                                
                                if( $currSRC == $gallery[$g] ){
                                    $exist = true;
                                    $currIMG = '';
                                    break;
                                }else{
                                    $exist = false;
                                    $currIMG = $currSRC;
                                }
                            }
                            if(!$exist){
                                $sqlDel = $oConn->SQLdeleter("galeria","src='".$currIMG."' AND pid='".$id."'");
                            }
                        }
                    }
                }
                //Colors
                if(isset($_REQUEST["colors"]) ){
                    //For each color from Form
                    foreach($_REQUEST["colors"] as $c => $c_name ){
                        $sqlSct = $oConn->SQLselector("*","colors","pid='".$id."'",'');
                        $exist = false;
                        $currCOLOR_n = $colors[$c];
                        while ( $row_color = $sqlSct->fetch(PDO::FETCH_ASSOC) ) {
                            $currCOLOR = $row_color["color"];
                            if( $colors[$c] == $currCOLOR ){
                                $exist = true;
                                $currCOLOR_n = '';
                                break;
                            }
                        }
                        if(!$exist){
                            $sqlInsert = $oConn->SQLinserter("colors","pid, color, inserted","'$id','$currCOLOR_n',now()");
                        }
                    }
                    //For each color from Database
                    $sqlSct = $oConn->SQLselector("*","colors","pid='".$id."'",'');
                    while ( $row_color = $sqlSct->fetch(PDO::FETCH_ASSOC) ) {
                        $currCOLOR = $row_color["color"];
                        $currIMG = '';
                        $exist = false;

                        foreach($_REQUEST["colors"] as $c => $c_name ){
                            if( $currCOLOR == $colors[$c] ){
                                $exist = true;
                                $currIMG = '';
                                break;
                            }else{
                                $exist = false;
                                $currIMG = $currCOLOR;
                            }
                        }
                        if(!$exist){
                            $sqlDel = $oConn->SQLdeleter("colors","color='".$currIMG."' AND pid='".$id."'");
                        }
                    }
                }
                //Contents
                $sqlUpdate = $oConn->SQLupdater("produtos","modified = now(), cid = '$category', sid = '$subcategory', title = '$title', resume = '$resume', description = '$description', capa = '$capa', size = '$size', length = '$length', width = '$width', depth = '$depth', radius = '$radius', height = '$height', weight = '$weight', min_price = 0, max_price = '$max_price', prod_code = '$prod_code', highlight = '$highlight', combine = '$combine', status = '$status' ","id='".$id."'");
                $row = $sqlUpdate->fetch(PDO::FETCH_ASSOC);
                if($sqlUpdate){
                    header('location: ../page.php?nvg=item&pid='.$id.'&msg=1');
                }
                else{
                    header('location: ../page.php?nvg=item&pid='.$id.'&msg=0');
                }       
            }
            break;

        case "new_product":
            //Contents
            //echo "'$category','$subcategory','$title','$resume','$description','$capa','$size','$length','$width','$depth','$radius','$height','$weight','$min_price','$max_price','$prod_code',now(),now(),'$highlight','$combine','$status'";
            //echo '<br>Iserted: '. $sqlInsert;
            //return;
            $sqlInsert = $oConn->SQLinserter("produtos","cid,sid,title,resume,description,capa,size,length,width,depth,radius,height,weight,min_price,max_price,prod_code,created,modified,highlight,combine,status","'$category','$subcategory','$title','$resume','$description','$capa','$size','$length','$width','$depth','$radius','$height','$weight','0','$max_price','$prod_code',now(),now(),'$highlight','$combine','$status'");

            //Get last id inserted
            $sqlSct = $oConn->SQLselector("*","produtos","","id DESC");
            $row_select = $sqlSct->fetch(PDO::FETCH_ASSOC);
            if($row_select){
                $id = $row_select['id'];
            }
            //Gallery
            if(isset($_REQUEST["gallery"]) ){
                //For each image from Form
                foreach($_REQUEST["gallery"] as $g => $g_name ){
                    $sqlInsert = $oConn->SQLinserter("galeria","pid, src, inserted","'$id','$gallery[$g]',now()");

                    if( $gallery[$g] == str_replace('../', '', $capa) ){
                        $sqlSct = $oConn->SQLselector("*","galeria","","id DESC");
                        $row = $sqlSct->fetch(PDO::FETCH_ASSOC);
                        if($row){
                            $capa = $row['id'];
                            $sqlUpdate = $oConn->SQLupdater("produtos","capa = '$capa'","id='".$id."'");
                        }
                    }
                }
            }
            //Colors
            if(isset($_REQUEST["colors"]) ){
                //For each image from Form
                foreach($_REQUEST["colors"] as $c => $c_name ){
                    $sqlInsert = $oConn->SQLinserter("colors","pid, color, inserted","'$id','$colors[$c]',now()");
                }
            }

            if($sqlInsert){
	    		header('location: ../page.php?nvg=item&msg=2&pid='.$id);
	    	}
	    	else{
	    		header('location: ../page.php?nvg=item&msg=0');
	    	}

			break;

		case "delete_product":
	    	
            //Contents
            $sqlDel = $oConn->SQLdeleter("produtos","id='".$id."'");
            $sqlDelGal = $oConn->SQLdeleter("galeria","pid='".$id."'");
            $sqlDelCol = $oConn->SQLdeleter("colors","pid='".$id."'");
	    	if($sqlDel){
                header('location: ../page.php?nvg=itens&msg=3');
	    	}
	    	else{
	    		header('location: ../page.php?nvg=itens&msg=0');
	    	}

            break;

		default:
            header('location: ../page.php?nvg=item&msg=0');
			break;
	}
?>