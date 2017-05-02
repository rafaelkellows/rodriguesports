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

		$page_title = 'Nosso Trabalho';
		include 'inc/head.php';
	?>		
	<body class="chn-corporate">
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
					<li>Corporativo</li>
				</ul>
				<dl>
					<dt><h2 class="bgTitle">SOLUÇÕES CORPORTATIVAS</h2></dt>
					<dd>
						<span><img src="images/ilustraTrabalho.jpg" alt="" /></span>
						<article>
							<p>Presentes exclusivos para qualquer ocasião!</p>
							<p>Aniversário de funcionário, diretores, promoção de cargo, datas especiais e muto mais.</p>
							<p>Entre em contato pelo nossos contatos do SAC:<br>
								<strong>E-mail:</strong> <a href="mailto:contato@spatula.com.br">contato@spatula.com.br</a><br>
								<strong>Telefone:</strong> <a href="tel.:+55 11 2847.4991">+55 11 2847.4991</a><br>
								<strong>WhatsApp:</strong> <a href="tel.:+55 11 94206.0111">+55 11 94206.0111</a>
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