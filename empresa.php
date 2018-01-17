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
					<li>A Empresa</li>
				</ul>
				<dl>
					<dt><h2 class="bgTitle">NOSSO TRABALHO - Presente que marca a memória Futura</h2></dt>
					<dd>
						<span><img src="images/ilustraTrabalho.jpg" alt="" /></span>
						<article>
							<p>A <strong>SPATULA</strong> é uma empresa criada para oferecer a experiência do prazer de ser presenteado. Sua missão é usar a criatividade para se destacar no segmento de presentes personalizados, entregando sempre brindes com qualidade.</p>
							<p>O objetivo da empresa é se consolidar como referência no mercado, com alta eficiência financeira e confiança do consumidor. O presente <strong>SPATULA</strong> é aquele que marca a memória futura.</p>
						</article>
					</dd>
				</dl>
				<dl>
					<dt><h2 class="bgTitle">NOSSA FILOSOFIA - No que acreditamos</h2></dt>
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
				<dl>
					<dt><h2 class="bgTitle">SOCIAL - Compartilhe Solidariedade</h2></dt>
					<dd>
						<span><img src="images/ilustraSocial.jpg" alt="" /></span>
						<article>
							<p>A <strong>SPATULA</strong> acredita que todos podem contribuir para construção de uma sociedade mais justa e feliz. Por isso, a cada dois meses escolhe uma instituição para fazer doações de brindes personalizados que poderão ajudar no desempenho de suas atividades.</p>
							<p>Se você tem uma instituição para indicar acesse nosso site e veja como funciona este projeto.</p>
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