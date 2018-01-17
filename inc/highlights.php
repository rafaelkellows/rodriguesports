<?php
				$oSlctHightlight = $oConn->SQLselector("*","produtos","status=1 AND highlight=1",'modified DESC');
                if ($oSlctHightlight->rowCount() > 0) {
                    echo '<section class="highlights" id="owl-highlights">';
                    while ( $row = $oSlctHightlight->fetch(PDO::FETCH_ASSOC) ) {

						$oCover = $oConn->SQLselector("*","galeria","id=".$row['capa'],'');
						$coverSRC = ( ( $oCover->rowCount() > 0 ) ? $oCover->fetch(PDO::FETCH_ASSOC)['src']: 'images/produtos/logo_util.jpg');

                        $oColors = $oConn->SQLselector("*","colors","pid='".$row['id']."'",'id ASC');
                        
	                	$h = new Product($row['id'],$row['cid'],$row['sid'],$coverSRC,$row['title'],$row['resume'],$row['min_price'],$row['max_price'],$row['size'],$oColors,$row['weight']);
						$h->highlight();

					}
                    echo '</section>';
                }
?>
