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

		$page_title = 'Nossos Produtos';
		include 'inc/head.php';
	?>		
	<body class="chn-products">
		<?php
			require_once 'adm/connector.php';
			include 'inc/header.php';
			include 'inc/nav.php';
		?>		
		<main class="main_products">
			<section class="product msgBox">
				<p>
					<strong title="Aguarde">Aguarde...</strong><br>
					<span>Seu pedido está sendo processado.</span>
				</p>
			</section>		
			<?php
				include 'inc/nav_products.php';
				$oConn = New Conn();
				$cat = ( isset($_REQUEST["cat"]) && !empty($_REQUEST['cat']) ) ? ' AND cid='.$_REQUEST["cat"] : '';
				$subcat = ( isset($_REQUEST["sub"]) && !empty($_REQUEST['sub']) ) ? ' AND sid='.$_REQUEST["sub"] : '';
			?>					
			<aside>
				<ul>
					<li><a href="./">Home</a></li>
					<li>Nossos Produtos</li>
				</ul>
				
				<?php
					if($cat){
						$oSlctCats = $oConn->SQLselector("*","categories",'id='.$_REQUEST["cat"],'');
						$row_subcategory='';
						if($subcat){
							$oSlctSubcats = $oConn->SQLselector("*","subcategories",'id='.$_REQUEST["sub"].' AND cid='.$_REQUEST["cat"],'');
							$row_subcategory = (( $oSlctSubcats->rowCount() > 0 ) ? ' | '.$oSlctSubcats->fetch(PDO::FETCH_ASSOC)['name'] : '' );
						}
						if( $oSlctCats->rowCount() > 0 ){
							$row_category = $oSlctCats->fetch(PDO::FETCH_ASSOC);
							echo '<dl><dt><h2 class="bgTitle">'.$row_category['name'].$row_subcategory.'</h2></dt>';
							echo '<dd><p>&nbsp;<p></dd></dl>';

						}else{
							//echo '<dt><h2 class="bgTitle">TAYLOR MADE</h2></dt>';
						}
					}else{
						//echo '<dt><h2 class="bgTitle">TAYLOR MADE</h2></dt>';
					}
				?>
					<!--dd>
						<span><img src="images/taylorMade.jpg" alt="" /></span>
						<article>
							<p>A <strong>SPATULA</strong> é uma empresa criada cuidadosamente para que você possa oferecer presentes diferenciados, criativos e desenvolvidos especialmente para seus clientes. Toda a produção é elaborada segundo o conceito de taylor made, de forma que eles percebem todo o cuidado e o diferencial em todos os detalhes.</p>
							<p>É o verdadeiro trabalho de personalização, em que a <strong>SPATULA</strong> vai entender em profundidade as necessidades de cada cliente e seus presenteados. A partir daí é desenvolvido um projeto especial de presente, que atenda e surpreenda todas as expectativas. O cliente acompanha todo o processo de criação e sabe que o produto final é feito especialmente para ele.</p>
						</article>
					</dd-->
				<?php
					$oSlctProds = $oConn->SQLselector("*","produtos",'status=1'.$cat.$subcat,'title');

	                if ($oSlctProds->rowCount() > 0) {
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
	                        echo '	<dt id="'.$prod['id'].'">';
	                        echo '		<a href="./produto.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'">'.$prod['title'].'</a></dt>';
	                        echo '	</dt>';
	                        echo '	<dd>';
													$oImage = $oConn->SQLselector("*","galeria","id='".$prod['capa']."'",'');
	                        echo '		<span><i class="fa fa-check-circle" aria-hidden="true"></i>Item Adicionado</span>';
													echo '		<a class="ilustra" href="./produto.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'"><img src="'.( ( $oImage->rowCount() > 0 ) ? $oImage->fetch(PDO::FETCH_ASSOC)['src']: 'images/produtos/logo_util.jpg').'" alt="" /></a>';
	                        echo '		<a class="desc" href="./produto.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'">'.$prod['resume'].'</a>';
	                        //echo '		<p><a href="./produto.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'">'.$prod['resume'].'</a></p>';
	                        if( $prod['max_price'] ){
	                        	echo '	<p class="lbl"><strong>R$'.$prod['max_price'].'</strong><em> unidade</em></p> ';
														echo '  <a class="btn-buy btn-color-E" href="checkout.php?id_prod='.$prod['id'].'&min=0&max='.$prod['max_price'].'&weight='.$prod['weight'].'" alt="Adicionar ao Carrinho">Adicionar ao Carrinho</a>';
							            }else{
														//echo '  <input class="btn-short" type="button" alt="Solicitar Orçamento" value="Solicitar Orçamento" />';
	                        }
													echo '  	<a class="btn-buy btn-color-B" href="orcamento.php?id_prod='.$prod['id'].'&cat='.$prod['cid'].'&sub='.$prod['sid'].'&capa='.$prod['capa'].'" alt="Solicitar Orçamento">Solicitar Orçamento</a>';
	                        echo '	</dd>';
	                        echo '</dl>';
	                    }
	                	echo '	</div>';
	                }else{
	                    echo "Não há Categoria(s) cadastrada(s)!";
	                }
	        	?>
			</aside>
		</main>
		<?php
			include 'inc/footer.php';
		?>		
	</body>
</html>