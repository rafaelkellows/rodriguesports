<?php
//Features
$oSlct = $oConn->SQLselector("*","produtos","status=1 AND combine=1",'modified DESC');
$arrItens = array();

echo '<section class="features">';
echo '	<h2 class="bgTitle">Produtos que combinam com você</h2>';

if ($oSlct->rowCount() > 0) {
	while ( $prod = $oSlct->fetch(PDO::FETCH_ASSOC) ) {
		array_push($arrItens, $prod['id']);
	}
	srand ((float)microtime()*1000000);
	shuffle ($arrItens);

	echo '	<div id="owl-features">';
	
	while (list (, $number) = each ($arrItens)) { 
		$oSlctByItem = $oConn->SQLselector("*","produtos","status=1 AND combine=1 AND id='$number'",'modified DESC');
		$row_item = $oSlctByItem->fetch(PDO::FETCH_ASSOC);
						
		$oCover = $oConn->SQLselector("*","galeria","id=".$row_item['capa'],'');
		$coverSRC = ( ( $oCover->rowCount() > 0 ) ? $oCover->fetch(PDO::FETCH_ASSOC)['src']: 'images/produtos/logo_util.jpg');

        $oColors = $oConn->SQLselector("*","colors","pid='".$row_item['id']."'",'id ASC');

    	$h = new Product($row_item['id'],$row_item['cid'],$row_item['sid'],$coverSRC,$row_item['title'],$row_item['resume'],$row_item['min_price'],$row_item['max_price'],$row_item['size'],$oColors,$row_item['weight']);
		$h->highlight();

		/*echo '<dl>';
		$title = ( strlen($row_item['title']) <= 35 ) ? $row_item['title'] : substr($row_item['title'], 0,35).'...' ;
		echo '	<dt id="'.$row_item['id'].'"><strong>Cód. '.$row_item['id'].'</strong><a href="./produto.php?id_prod='.$row_item['id'].'&cat='.$row_item['cid'].'&sub='.$row_item['sid'].'" title="'.$row_item['title'].'">'.$title.'</a></dt>';
		echo '	<dd>';
		echo '		<span class="label"><i class="fa fa-check-circle" aria-hidden="true"></i>Item Adicionado</span>';
		$oImage = $oConn->SQLselector("*","galeria","id='".$row_item['capa']."'",'');
		echo '		<img src="'.( ( $oImage->rowCount() > 0 ) ? $oImage->fetch(PDO::FETCH_ASSOC)['src']: 'images/produtos/logo_util.jpg').'" alt="" />';
		//echo '		<span class="resume">'.$row_item['resume'].'</span>';
        if( $row_item['max_price'] ){
			echo ' 		<p class="lbl"><strong>R$'.$row_item['max_price'].'</strong><em> unidade</em></p> ';
		}

		$string = $row_item['size'];
		$array = explode(',', $string);
		echo "<ul class='size'>";
		echo "	<em>" . ( ( stripos($row_item['size'], 'ml') === false) ? "Tamanho" : "Capacidade") . " disponível</em>";
		foreach($array as $size){
			echo "<li class='". (($size=='') ? "unico" : null ) ."'>". (($size!='') ? $size : "único")  . '</li>';
		}
		echo "</ul>";

        $colors = $oConn->SQLselector("*","colors","pid='".$row_item['id']."'",'id ASC');
        if ($colors->rowCount() > 0) {
			echo "<ul class='color'>";
			echo "	<em>Cor disponível</em>";
			while ( $row_colors = $colors->fetch(PDO::FETCH_ASSOC) ) {
				if($row_colors['color']!=''){
					echo "<li style='background-color:#".$row_colors['color']."; ". (( $row_colors['color'] == 'ffffff') ? 'border:1px solid #f4f4f4;' : '' )."' title='".$row_colors['label']."'>".$row_colors['color']."</li>";
				}
			}
			echo "</ul>";
            
        }else{
			echo "<ul class='color'>";
			echo "	<em>Cor disponível</em>";
			echo "	<li class='diverso'>diverso</li>";
			echo "</ul>";
        }

        if( $row_item['max_price'] ){
			echo '		<a class="btn-default btn-color-E btn-checkout" href="checkout.php?id_row='.$row_item['id'].'&min='.$row_item['min_price'].'&max='.$row_item['max_price'].'&weight='.$row_item['weight'].'" title="Adicionar ao Carrinho"><i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho</a>';
		}

		echo '		<a class="btn-default btn-color-B" href="orcamento.php?id_prod='.$row_item['id'].'&cat='.$row_item['cid'].'&sub='.$row_item['sid'].'&capa='.$row_item['capa'].'" title="Solicitar Orçamento"><i class="fa fa-edit"></i> Solicitar Orçamento</a>';
		echo '		<a class="btn-short" href="./produto.php?id_prod='.$row_item['id'].'&cat='.$row_item['cid'].'&sub='.$row_item['sid'].'" title="[ + ] ver mais"><i class="fa fa-plus"></i> ver mais detalhes</a>';
		echo '	</dd>';
		echo '</dl>';*/
	}
    echo '	</div>';
    echo '	<nav>';
    echo '		<a class="prev" href="javascript:void(0);" title="previous"><</a>';
    echo '		<a class="next" href="javascript:void(0);" title="next">></a>';
    echo '	</nav>';
}else{
	echo '<p style="font-size: 13px; padding: 0 10px 10px; margin-top: -20px;"><strong>Não há produtos cadastrados ainda.</strong></p>';
}
echo '</section>';
?>
