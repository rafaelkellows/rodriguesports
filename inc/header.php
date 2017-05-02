		<?php 
			$email =  ( isset($_REQUEST["e"] ) ) ? $_REQUEST["e"] : 0 ;
			$key_token =  ( isset($_REQUEST["k_token"] ) ) ? $_REQUEST["k_token"] : 0 ;
			$msg =  ( !empty($_COOKIE['msg'] ) ) ? $_COOKIE['msg'] : null ;
			$eml =  ( !empty($_COOKIE['eml'] ) ) ? $_COOKIE['eml'] : null ;

			if($email===0 && $key_token===0){
				switch ($msg) {
			    case '0':
						$mensagemConcatenada = '<div class="msgBox" style="display:block;">';
						$mensagemConcatenada .= '	<p class="msg">';
						$mensagemConcatenada .= '		<strong>Erro</strong><br><br>';
						$mensagemConcatenada .= '		<span><strong>Usuário</strong> ou <strong>Senha</strong> incorreto.<br>Tente novamente.</span>';
						$mensagemConcatenada .= '		<a class="btn-default btn-color-C" href="javascript:void(0);"><span>OK</span></a>';
						$mensagemConcatenada .= '	</p>';
						$mensagemConcatenada .= '</div>';
						echo $mensagemConcatenada;
						break;
			    case '1':
						$mensagemConcatenada = '<div class="msgBox" style="display:block;">';
						$mensagemConcatenada .= '	<p class="msg">';
						$mensagemConcatenada .= '		<strong>Confirmação de Cadastro</strong><br><br>';
						$mensagemConcatenada .= '		<span><strong>Parabéns</strong>, você realizou a confirmação do seu cadastro com sucesso!<br>Agora é só <strong style="color:#3988d7">entrar</strong> com seu login e senha.</span>';
						$mensagemConcatenada .= '		<a class="btn-default btn-color-C" href="javascript:void(0);"><span>OK</span></a>';
						$mensagemConcatenada .= '	</p>';
						$mensagemConcatenada .= '</div>';
						echo $mensagemConcatenada;
						break;
			    case '2':
						$mensagemConcatenada = '<div class="msgBox" style="display:block;">';
						$mensagemConcatenada .= '	<p class="msg">';
						$mensagemConcatenada .= '		<strong>Confirmação de Cadastro</strong><br><br>';
						$mensagemConcatenada .= '		<span><strong>Olá</strong>, você já realizou a confirmação do seu cadastro com sucesso!<br></span>';
						$mensagemConcatenada .= '		<a class="btn-default btn-color-C" href="javascript:void(0);"><span>OK</span></a>';
						$mensagemConcatenada .= '	</p>';
						$mensagemConcatenada .= '</div>';
						echo $mensagemConcatenada;
						break;
			    case '3':
						$mensagemConcatenada = '<div class="msgBox" style="display:block;">';
						$mensagemConcatenada .= '	<p class="msg">';
						$mensagemConcatenada .= '		<strong>Confirmação de Cadastro não efetuada</strong><br><br>';
						$mensagemConcatenada .= '		<span><strong>'.$usuario->getName().'</strong>,<br>você ainda não confirmou o seu cadastro através do link que foi enviado por e-mail após realizar seu cadastro! <a href="signin_action.php?ref=cadastreSe&e='.$usuario->getEmail().'&k_token='.$usuario->getKToken().'">Estou ciente do cadastro e confirmo clicando aqui?</a></span>';
						$mensagemConcatenada .= '		<a class="btn-default btn-color-E" href="javascript:void(0);"><span>SAIR</span></a>';
						$mensagemConcatenada .= '	</p>';
						$mensagemConcatenada .= '</div>';
						echo $mensagemConcatenada;
						break;
			    case '4':
						$mensagemConcatenada = '<div class="msgBox" style="display:block;">';
						$mensagemConcatenada .= '	<p class="msg">';
						$mensagemConcatenada .= '		<strong>Reenvio de Senha</strong><br><br>';
						$mensagemConcatenada .= '		<span><strong>Parabéns</strong>, você realizou a solicitação do re-envio da sua senha com sucesso!<br>Veja no seu email suas credenciais cadastradas no site.</span>';
						$mensagemConcatenada .= '		<a class="btn-default btn-color-C" href="javascript:void(0);"><span>OK</span></a>';
						$mensagemConcatenada .= '	</p>';
						$mensagemConcatenada .= '</div>';
						echo $mensagemConcatenada;
						break;
			    case '5':
						$mensagemConcatenada = '<div class="msgBox" style="display:block;">';
						$mensagemConcatenada .= '	<p class="msg">';
						$mensagemConcatenada .= '		<strong>Reenvio de Senha</strong><br><br>';
						$mensagemConcatenada .= '		<span><strong>Sinto muito</strong>, o email <b>'.$eml.'</b> não consta em nossos bancos.</span>';
						$mensagemConcatenada .= '		<a class="btn-default btn-color-C" href="javascript:void(0);"><span>OK</span></a>';
						$mensagemConcatenada .= '	</p>';
						$mensagemConcatenada .= '</div>';
						echo $mensagemConcatenada;
						break;
			    case '6':
						$mensagemConcatenada = '<div class="msgBox" style="display:block;">';
						$mensagemConcatenada .= '	<p class="msg">';
						$mensagemConcatenada .= '		<strong>Erro</strong><br><br>';
						$mensagemConcatenada .= '		<span><strong>Algo deu errado</strong>. Pedimos desculpas e tente novamente recarregando sua página.</span>';
						$mensagemConcatenada .= '		<a class="btn-default btn-color-C" href="javascript:void(0);"><span>OK</span></a>';
						$mensagemConcatenada .= '	</p>';
						$mensagemConcatenada .= '</div>';
						echo $mensagemConcatenada;
						break;
				}

				setcookie('msg', '-1', (time() + 1), '/'); //5 seconds
			}else{
				header('location: signin_action.php?ref=cadastreSe&e='.$email.'&k_token='.$key_token);
			}
		?>
		<header>
			<aside>
				<img src="images/logo_pagseguro200x41.png" style="display: none" />
				<h1>
					<a class="lg-spatula" href="./">Spatula - Presentes que marcam</a>
					<!--a class="fa fa-phone" href="tel.:+551128474991"><span>+55 11 2847.4991</span></a-->
					<a class="fa fa-whatsapp" href="tel.:+5511942060111"><span>+55 11 98700.3640</span></a>
				</h1>
				<ul>
					<li><a class="fa fa-facebook-square" href="https://www.facebook.com/RodriguesSports/" target="_blank" title="Facebook"><span>Facebook</span></a></li>
					<li><a class="fa fa-instagram" href="https://www.instagram.com/explore/locations/1026506440/rodrigues-sports/" target="_blank" title="Instagram"><span>Instagram</span></a></li>
					<?php if (!$usuario){ ?>
					<li class="block f-right notlogged"><a class="fa fa-shopping-cart btn-color-E" href="checkout.php" title="Carrinho de Compras"><em>0</em></a></li>
					<li class="block f-right"><a class="btn-signin btn-color-C" href="signin.php" title="Cadastre-se"><em>Cadastre-se</em></a></li>
					<li class="block f-right"><a class="btn-login btn-color-A" href="javascript:void(0);" title="Entrar"><em>Entrar</em></a></li>
					<?php 
						}else{ 
							if( !$usuario->getId() ){
					?>
					<li class="block f-right notl3ogged"><a class="fa fa-shopping-cart btn-color-E" href="checkout.php" title="Carrinho de Compras"><em>0</em></a></li>
					<li class="block f-right"><a class="btn-signin btn-color-C" href="signin.php" title="Cadastre-se"><em>Cadastre-se</em></a></li>
					<li class="block f-right"><a class="btn-login btn-color-A" href="javascript:void(0);" title="Entrar"><em>Entrar</em></a></li>
					<?php 								
							}else{
					?>
					<li class="block f-right logged">
						<input id="user_id" type="hidden" value="<?php if ($usuario){ print $usuario->getId(); }else{ print ''; }; ?>" />
						<a class="btn-logged" href="signin.php">Olá, <strong><?php if ($usuario){ print $usuario->getName(); }else{ print 'Visitante'; }; ?></strong>.</a>
					</li>
					<li class="block f-right notlogged"><a class="fa fa-shopping-cart btn-color-E" href="checkout.php" title="Carrinho de Compras"><em>0</em></a></li>
					<li class="block f-right"><a class="btn-edit btn-color-C" href="signin.php" title="Cadastre-se"><em>Meus Dados</em></a></li>
					<li class="block f-right"><a class="btn-shopping-basket btn-color-D" href="transaction.php" title="Meus Pedidos"><em>Meus Pedidos</em></a></li>
					<li class="block f-right"><a class="btn-logout btn-color-A" href="login/controle.php?acao=sair&curr=<?php print $_SERVER['REQUEST_URI'] ?>" title="Sair"><em>Sair</em></a></li>
					<?php 
							} 
						}
					?>
				</ul>
				<form id="login-form" action="login/controle.php?curr=<?php print $_SERVER['REQUEST_URI'] ?>" method="post" target="_self" id="valid" class="mainForm">
					<fieldset>
						<legend>Entre com seus dados</legend>
						<a class="fa fa-close" href="javascript:void(0);"><span>Fechar</span></a>
						<label for="login">Usuário</label>
						<input type="text" placeholder="usuário" id="login" name="login" class="validate[required]" />
						<label for="password">Senha</label>
						<input type="password" placeholder="senha" id="password" name="password" class="validate[required]" />
						<button class="btn-color-A acao" id="acao" name="acao" type="submit" value="entrar">entrar</button>

						<label class="forget" for="forget">E-mail</label>
						<input type="text" class="forget" placeholder="e-mail" id="forget" name="forget" value="" />
						<input type="hidden" id="ref" name="ref" value="forgetPassword" />
						<button class="btn-color-A send" id="enviar" name="acao" type="submit" value="enviar">enviar</button>

						<a class="fa fa-frown-o" href="javascript:void(0);" title="Clique aqui para solicitar uma nova senha."><span>esqueci minha senha</span></a>

					</fieldset>
				</form>
				<form id="search-form" action="busca.php" method="post">
					<fieldset>
						<legend>Buscar na Spatula</legend>
						<input placeholder="Oi! Digite o produto que você procura?" name="search" type="text" value="" />
						<button type="submit">buscar</button>
					</fieldset>
				</form>
			</aside>
		</header>		
