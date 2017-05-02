<?php
//error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
?>
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

		$page_title = 'Home';
		include 'inc/head.php';
	?>		
	<body class="chn-home">
		<?php
			require_once 'adm/connector.php';
			include 'inc/header.php';
			include 'inc/nav.php';
		?>				
		<main>
			<section class="warning msgBox">
				<p>
					<strong title="Seja Bem vindo ao Spatula - Presentes que Marcam">Seja Bem vindo ao Spatula<br>Presentes que Marcam</strong>
					Gostaríamos primeiramente de agradecer sua visita.<br><br>
					Acabamos de implementar nosso <em><strong>Carrinho de Compras</strong></em> com intuito de agilizar nosso processo e também de nos aproximar.<br><br>
					Estamos em perído de testes e o carrinho será liberado em alguns dias.<br>
					Aproveite para descobrir nossas mudanças e também para conhecer <em><strong>nosso processo de compra</strong></em> simulando uma.<br>
					Mas antes, aproveite e <a class="btn-signin btn-color-C" href="signin.php" title="Cadastre-se"><em>Cadastre-se</em></a> no site e seja avisado da liberação do Carrinho de Compras!
				</p>
			</section>		
			<?php
				$oConn = New Conn();
				$oSlct = $oConn->SQLselector("*","banners","status=1",'modified DESC'); 

				//Banners
                if ($oSlct->rowCount() > 0) {
                	echo '<div id="owl-banners" class="owl-carousel">';
                    while ( $row = $oSlct->fetch(PDO::FETCH_ASSOC) ) {
                        echo '<div class="item">';
                        echo '  <img src="'.$row['src'].'" alt="'.$row['alt'].'">';
                        echo '	<div class="itemContent '.$row['align'].'">';
                        echo '  	<strong>'.$row['title'].'</strong>';
                        echo '      <span>'.$row['description'].'</span>';
                        if( !empty($row['link']) ){
                        	echo '		<a href="'.$row['link'].'" target="'.$row['target'].'">ver mais</a>';
                        }
                        echo '  </div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }

				//Highlights
				$oSlct = $oConn->SQLselector("*","produtos","status=1 AND highlight=1",'modified DESC');
                if ($oSlct->rowCount() > 0) {
                    echo '<section class="highlights" id="owl-highlights">';
                    while ( $row = $oSlct->fetch(PDO::FETCH_ASSOC) ) {
						echo '<dl>';
						$title = ( strlen($row['title']) <= 35 ) ? $row['title'] : substr($row['title'], 0,35).'...' ;
						echo '	<dt id="'.$row['id'].'"><strong>Cód. '.$row['id'].'</strong><a href="./produto.php?id_prod='.$row['id'].'&cat='.$row['cid'].'&sub='.$row['sid'].'">'.$title.'</a></dt>';
						echo '	 <dd>';
						echo '		<span class="label"><i class="fa fa-check-circle" aria-hidden="true"></i>Item Adicionado</span>';
						$oImage = $oConn->SQLselector("*","galeria","id=".$row['capa'],'');
						echo '		<img src="'.( ( $oImage->rowCount() > 0 ) ? $oImage->fetch(PDO::FETCH_ASSOC)['src']: 'images/produtos/logo_util.jpg').'" alt="" />';
	                    
	                    if( $row['max_price'] ){
	                    	if(trim($row['max_price']) != '0,00'){
								echo '	<p class="lbl"><strong>R$'.$row['max_price'].'</strong><em> unidade</em></p> ';
							}
						}

						echo '		<span class="resume">'.$row['resume'].'</span>';
						echo '		<a class="btn-short" href="./produto.php?id_prod='.$row['id'].'&cat='.$row['cid'].'&sub='.$row['sid'].'" title="Ver mais detalhes">[ + ] ver mais</a>';
						echo '		<a class="btn-default btn-color-B" href="orcamento.php?id_prod='.$row['id'].'&cat='.$row['cid'].'&sub='.$row['sid'].'&capa='.$row['capa'].'" title="Solicitar OrÃ§amento"><i class="fa fa-edit"></i></a>';
	                    
	                    if( $row['max_price'] ){
							echo '		<a class="btn-buy btn-color-E" href="checkout.php?id_row='.$row['id'].'&min='.$row['min_price'].'&max='.$row['max_price'].'&weight='.$row['weight'].'" title="Adicionar ao Carrinho"><i class="fa fa-shopping-cart"></i></a>';
						}
						echo '	</dd>';
						echo '</dl>';
                    }
                    echo '</section>';
                }else{
                	echo '<p style="font-size: 13px; padding: 0 10px 10px; margin-top: -20px; text-align:center;"><strong>Não há produtos cadastrados ainda.</strong></p>';
                }
				include 'inc/features.php';
        	?>
		</main>
		<?php
			include 'inc/footer.php';
 		?>
	</body>
</html>