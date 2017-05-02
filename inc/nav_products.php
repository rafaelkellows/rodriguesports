			<?php
				$oConn = New Conn();
                $category = ( isset($_REQUEST["cat"]) && !empty($_REQUEST['cat']) ) ? $_REQUEST["cat"] : '';
                $subcategory = ( isset($_REQUEST["sub"]) && !empty($_REQUEST['sub']) ) ? $_REQUEST["sub"] : '';

				$oSlctCats = $oConn->SQLselector("*","categories",'','name');

                if ($oSlctCats->rowCount() > 0) {
                    echo '<nav class="hide">';
                    echo '<a href="javascript:void(0);" class="fa fa-puzzle-piece" title="Menu"></a>';
                    while ( $cat = $oSlctCats->fetch(PDO::FETCH_ASSOC) ) {
                        echo '<dl>';
                        $oSlctSubs = $oConn->SQLselector("*","subcategories",'cid='.$cat['id'],'name');
                        $hasDD = ($oSlctSubs->rowCount()===0) ? ' class="no-dd"' : '' ;
                        $active = ($cat['id'] == $category) ? ' class="active"' : '' ;
                        echo '	<dt'.$hasDD.'><a'.$active.' href="./produtos.php?cat='.$cat['id'].'">'.$cat['name'].'</a><span'.$active.'></span></dt>';
						if ($oSlctSubs->rowCount() > 0) {
                            echo '<dd'.$active.'>';
							while ( $subcat = $oSlctSubs->fetch(PDO::FETCH_ASSOC) ) {
                                $s_active = ($subcat['id'] == $subcategory) ? ' class="active"' : '' ;
								echo '<a'.$s_active.' href="./produtos.php?cat='.$cat['id'].'&sub='.$subcat['id'].'">'.$subcat['name'].'</a>';
							}
							echo '</dd>';
						}
                        echo '</dl>';
                    }
                    echo '</nav>';
                }else{
                    "Não há Categoria(s) cadastrada(s)!";
                }
        	?>
