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

		$page_title = 'Nossa Filosofia';
		include 'inc/head.php';
	?>		
	<body class="chn-ethics">
		<?php
			require_once 'adm/connector.php';
			include 'inc/header.php';
			include 'inc/nav.php';
			$oConn = New Conn();
		?>		
		<main class="main_content">
			<aside>
				<ul>
					<li><a href="./">Home</a></li>
					<li>Nossa Filosofia</li>
				</ul>
				<dl>
					<dt><h2 class="bgTitle">NO QUE ACREDITAMOS</h2></dt>
					<dd>
						<span><img src="images/ilustraNossaFilosofia.jpg" alt="" /></span>
						<article>
							<p>O trabalho da <strong>SPATULA</strong> é desenvolvido em torno de três pilares que dão sustentação e sentido a toda operação.</p>
							<p>
								<strong>BELEZA</strong><BR>
								Os presentes são feitos para impressionar pelo visual e pela qualidade do acabamento. São produtos que se destacam pelo bom gosto e surpreendem sempre de forma positiva quem recebe.
							</p>
							<p>
								<strong>ORGANIZAÇÃO</strong><BR>
								A equipe enxuta está organizada para atender os pedidos com máxima eficiência, atuando sempre dentro do prazo, em busca das melhores opções para você presentear com emoção e a certeza da entrega.
							</p>
							<p>
								<strong>ESTRUTURA</strong><BR>
								A forma de trabalhar da <strong>SPATULA</strong> tem como objetivo entregar qualidade e transparência nos negócios. Toda a cadeia de produção é formada com um rigoroso controle de cada peça que é produzida em nosso sistema taylor made.
							</p>
						</article>
					</dd>
				</dl>
			</aside>
			<?php
				include 'inc/features.php';
			?>		
		</main>
		<?php
			include 'inc/footer.php';
		?>		
	</body>
</html>