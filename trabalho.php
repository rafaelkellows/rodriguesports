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

		$page_title = 'Corporativo';
		include 'inc/head.php';
	?>		
	<body class="chn-wedo">
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
					<li>Nosso Trabalho</li>
				</ul>
				<dl>
					<dt><h2 class="bgTitle">PRESENTE QUE MARCA A MEMÓRIA FUTURA</h2></dt>
					<dd>
						<span><img src="images/ilustraTrabalho.jpg" alt="" /></span>
						<article>
							<p>A <strong>SPATULA</strong> é uma empresa criada para oferecer a experiência do prazer de ser presenteado. Sua missão é usar a criatividade para se destacar no segmento de presentes personalizados, entregando sempre brindes com qualidade.</p>
							<p>O objetivo da empresa é se consolidar como referência no mercado, com alta eficiência financeira e confiança do consumidor. O presente <strong>SPATULA</strong> é aquele que marca a memória futura.</p>
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