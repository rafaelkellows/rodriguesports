<?php
//error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
?>
<!DOCTYPE html>
<html>
	<?php
	    require_once 'login/usuario.php';
	    require_once 'login/autenticador.php'; 
	    require_once 'login/sessao.php';
	    require_once 'classes/product.php';

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
			<section class="product msgBox">
				<p>
					<strong title="Aguarde">Aguarde...</strong><br>
					<span>Mensagem</span>
				</p>
			</section>		

			<?php
				$oConn = New Conn();
				$oSlct = $oConn->SQLselector("*","banners","status=1",'modified DESC'); 

				//Banners
                /*
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
                }*/

				//Highlights
				include 'inc/highlights.php';
				//Features
				//include 'inc/features.php';
        	?>
		</main>
		<?php
			//include 'inc/footer.php';
 		?>
	</body>
</html>