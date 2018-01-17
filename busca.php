<!DOCTYPE html>
<html>
	<?php
	    require_once 'login/usuario.php';
	    require_once 'login/autenticador.php'; 
	    require_once 'login/sessao.php';

	    $aut = Autenticador::instanciar();
	     
	    $usuario = null;
	    if ($aut->esta_logado()) {
	        $usuario = $aut->pegar_usuario();
	    }
	    else {
			//$aut->expulsar();
		}
		$page_title = 'Nossos Presentes - Busca';
		include 'inc/head.php';
	?>		
	<body class="chn-products chn-search">
		<?php
			require_once 'adm/connector.php';
			include 'inc/header.php';
			include 'inc/nav.php';
		?>		
		<main class="main_products">
			<?php
				include 'inc/nav_products.php';
			?>					
			<aside>
				<ul>
					<li><a href="./">Home</a></li>
					<li><a href="produtos.php">Nossos Presentes</a></li>
					<li>Busca</li>
				</ul>
				<?php
					$oConn = New Conn();
					$search = ( isset($_REQUEST["search"]) && !empty($_REQUEST['search']) ) ? $_REQUEST["search"] : '';
					$oSlctProds = $oConn->SQLselector("*","produtos","status = 1 AND ((title LIKE '%".$search."%') OR (resume LIKE '%".$search."%') OR (description LIKE '%".$search."%') OR ('%".$search."%')) ",'modified DESC');
	                if ($oSlctProds->rowCount() > 0) {
	                	if($search){
							echo '<dl><dt><h2 class="bgTitle">Encontrado(s) <font style="color:#333; font-size:22px;">'.$oSlctProds->rowCount().'</font> produto(s) com <font style="color:#333; font-size:22px;">'.$_REQUEST["search"].'</font> na descrição.</h2></dt></dl>';
		                	echo '<section class="product_features">';
						}else{
	                		echo '<dl><dt><h2 class="bgTitle">Não encontrei nenhum produto cadastrado com o texto mencionado.<font style="color:#333; font-size:22px;">'.$search.'</font></h2></dt></dl>';
		                	echo '<section class="product_features">';
		                	echo '	<p><strong>Veja abaixo o que separamos para você:</strong><br><br></p>';
						}
	                	echo '	<div class="filtering">';
	                	echo '		<ul>';
	                	echo '			<li class="active"><a class="block" title="Exibir em blocos" href="javascript:void(0);">Block</a></li>';
	                	echo '			<li><a class="list" title="Exibir em Lista" href="javascript:void(0);">List</a></li>';
	                	echo '		</ul>';
	                	echo '		<dl>';
	                	echo '			<dt>Mostrar de</dt>';
	                	echo '			<dd>';
	                	echo '				<select id="showBy" name="showBy">';
	                	echo '					<option value="0">Todos</option>';
	                	echo '					<option value="3">3 em 3</option>';
	                	echo '					<option value="6" selected>6 em 6</option>';
	                	echo '					<option value="9">9 em 9</option>';
	                	echo '					<option value="12">12 em 12</option>';
	                	echo '					<option value="18">18 em 18</option>';
	                	echo '					<option value="24">24 em 24</option>';
	                	echo '					<option value="30">30 em 30</option>';
	                	echo '				</select>';
	                	echo '			</dd>';
	                	echo '			<dt>Ordernar por</dt>';
	                	echo '			<dd>';
	                	echo '				<select id="orderBy" name="orderBy">';
	                	echo '					<option value="1" selected>A - Z</option>';
	                	echo '					<option value="2">Z - A</option>';
	                	echo '					<option value="3">mais recentes</option>';
	                	echo '					<option value="4">mais antigas</option>';
	                	echo '				</select>';
	                	echo '			</dd>';
	                	echo '		</dl>';
	                	echo '	</div>';
	                	echo '	<div id="owl-product_features">';
	                    while ( $prod = $oSlctProds->fetch(PDO::FETCH_ASSOC) ) {
	                        echo '<dl data-modified="'.$prod['modified'].'">';
	                        echo '	<dt><a href="./produto.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'">'.$prod['title'].'</a></dt>';
	                        echo '	<dd>';
							$oImage = $oConn->SQLselector("*","galeria","id='".$prod['capa']."'",'');
							echo '		<img src="'.( ( $oImage->rowCount() > 0 ) ? $oImage->fetch(PDO::FETCH_ASSOC)['src']: 'images/produtos/logo_util.jpg').'" alt="" />';
	                        echo '		<p>'.$prod['resume'].'</p>';
	                        echo '		<a class="btn-short" href="./produto.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'" title="[ + ] ver mais">[ + ] ver mais</a>';
	                        echo '	</dd>';
	                        echo '</dl>';
	                    }
	                    echo '	</div>';
	                    echo '</section>';
	                }else{
						$oSlctProds = $oConn->SQLselector("*","produtos","status = 1",'title ASC');
	                	echo '<dl><dt><h2 class="bgTitle">Não há produto cadastrado com <font style="color:#333; font-size:22px;">'.$_REQUEST["search"].'</font> na descrição.</h2></dt></dl>';
		                echo '<section class="product_features">';
		                echo '	<p><strong>Veja abaixo o que separamos para você:</strong><br><br></p>';
	                	echo '	<div class="filtering">';
	                	echo '		<ul>';
	                	echo '			<li class="active"><a class="block" title="Exibir em blocos" href="javascript:void(0);">Block</a></li>';
	                	echo '			<li><a class="list" title="Exibir em Lista" href="javascript:void(0);">List</a></li>';
	                	echo '		</ul>';
	                	echo '		<dl>';
	                	echo '			<dt>Mostrar de</dt>';
	                	echo '			<dd>';
	                	echo '				<select id="showBy" name="showBy">';
	                	echo '					<option value="0">Todos</option>';
	                	echo '					<option value="3">3 em 3</option>';
	                	echo '					<option value="6" selected>6 em 6</option>';
	                	echo '					<option value="9">9 em 9</option>';
	                	echo '					<option value="12">12 em 12</option>';
	                	echo '					<option value="18">18 em 18</option>';
	                	echo '					<option value="24">24 em 24</option>';
	                	echo '					<option value="30">30 em 30</option>';
	                	echo '				</select>';
	                	echo '			</dd>';
	                	echo '			<dt>Ordernar por</dt>';
	                	echo '			<dd>';
	                	echo '				<select id="orderBy" name="orderBy">';
	                	echo '					<option value="1" selected>A - Z</option>';
	                	echo '					<option value="2">Z - A</option>';
	                	echo '					<option value="3">mais recentes</option>';
	                	echo '					<option value="4">mais antigas</option>';
	                	echo '				</select>';
	                	echo '			</dd>';
	                	echo '		</dl>';
	                	echo '	</div>';
	                	echo '	<div id="owl-product_features">';
	                    while ( $prod = $oSlctProds->fetch(PDO::FETCH_ASSOC) ) {
	                        echo '<dl data-modified="'.$prod['modified'].'">';
	                        echo '	<dt><a href="./produto.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'">'.$prod['title'].'</a></dt>';
	                        echo '	<dd>';
							$oImage = $oConn->SQLselector("*","galeria","id='".$prod['capa']."'",'');
							echo '		<img src="'.( ( $oImage->rowCount() > 0 ) ? $oImage->fetch(PDO::FETCH_ASSOC)['src']: 'images/produtos/logo_util.jpg').'" alt="" />';
	                        echo '		<p>'.$prod['resume'].'</p>';
	                        echo '		<a class="btn-short" href="./produto.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'" title="[ + ] ver mais">[ + ] ver mais</a>';
	                        echo '	</dd>';
	                        echo '</dl>';
	                    }
	                    echo '	</div>';
	                    echo '</section>';
	                }
	        	?>
	        						
				</div>
			</aside>
		</main>
		<?php
			include 'inc/footer.php';
		?>		
	</body>
</html>