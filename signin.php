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

		$page_title = 'Cadastre-se';
		include 'inc/head.php';
	?>		
	<body class="chn-signin">
		<?php
			require_once 'connector.php';
			include 'inc/header.php';
			include 'inc/nav.php';
			$oConn = New Conn();

			if ($usuario){ 
				$id_user = $usuario->getId();
				$sqlSct = $oConn->SQLselector("*","tbl_accounts","id='".$id_user."'",'');
				$row = $sqlSct->fetch(PDO::FETCH_ASSOC);

				$name = $row['name'];
				$name = ( ($name == '') ? '' : $name );
				
				$email = $row['email'];
				$email = ( ($email == '') ? '' : $email );
				
				$login = $row['login'];
				$login = ( ($login == '') ? '' : $login );
				
				$password = $row['password'];
				$password = ( ($password == '') ? '' : $password );
				
				$phone = $row['phone'];
				$phone = ( ($phone == '') ? '' : $phone );
				
				$cellphone = $row['cellphone'];
				$cellphone = ( ($cellphone == '') ? '' : $cellphone );
				
				$cpf = $row['cpf'];
				$cpf = ( ($cpf == '') ? '' : $cpf );
				
				$address = $row['address'];
				$address = ( ($address == '') ? '' : $address );
				
				$number = $row['number'];
				$number = ( ($number == '') ? '' : $number );
				
				$complement = $row['complement'];
				$complement = ( ($complement == '') ? '' : $complement );
				
				$neightborhood = $row['neightborhood'];
				$neightborhood = ( ($neightborhood == '') ? '' : $neightborhood );
				
				$postal_code = $row['postal_code'];
				$postal_code = ( ($postal_code == '') ? '' : $postal_code );
				
				$state = $row['state'];
				$state = ( ($state == '') ? '' : $state );
				
				$city = $row['city'];
				$city = ( ($city == '') ? '' : $city );
				
				$btn_label = 'atualizar cadastro';
				$pag_title = 'MEUS DADOS';
				$pag_paragraph = 'Verifique seus dados nos campos abaixo. Você pode alterá-los a qualquer momento.';
			}else{
				$id_user = '';
				$name = '';
				$email = '';
				$login = '';
				$password = '';
				$phone = '';
				$cellphone = '';
				$cpf = '';
				$address = '';
				$number = '';
				$complement = '';
				$neightborhood = '';
				$postal_code = '';
				$state = '';
				$city = '';
				$pag_title = 'CADASTRE-SE';
				$btn_label = 'enviar cadastro';
				$pag_paragraph = 'Preencha os campos abaixo para criar seu cadastro.';
			};

		?>		
		<main class="main_content">
			<aside>
				<ul>
					<li><a href="./">Home</a></li>
					<li>Cadastre-se</li>
				</ul>
				<dl>
					<dt><h2 class="bgTitle"><?php echo $pag_title ?></h2></dt>
					<dd>
						<span>
							<img src="images/ilustraCadastro.jpg" alt="CADASTRE-SE" />
						</span>
						<article>
							<p><?php echo $pag_paragraph ?></p>
							<form id="signin" class="signin" action="/" method="post">
								<input id="id_user" name="id_user" type="hidden" value="<?php echo $id_user ?>" />
								<fieldset>
									<legend>Faça seu Cadastro</legend>
									<p class="msg">Aqui vem a mensagem</p>
									<h3>Dados de Acesso</h3>
									<ul>
										<li>
											<label for="name">Nome:</label>
											<input id="name" name="name" type="text" value="<?php echo $name ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="email">E-mail:</label>
											<input id="email" name="email" placeholder="Digite seu e-mail" type="text" <?php if ($email != '') print " disabled=disabled" ?> value="<?php echo $email ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="login">Login de Usuário (<em style="font-size:13px">digite ao menos 5 caracteres</em>):</label>
											<input id="login" name="login" placeholder="Digite seu usuário" type="text" value="<?php echo $login ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="usr_password">Senha (<em style="font-size:13px">letras, números e/ou caracteres especiais</em>):</label>
											<input id="usr_password" name="usr_password" placeholder="Digite sua senha" type="password" value="<?php echo $password ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="usr_confirm_password">Confirmar Senha:</label>
											<input id="usr_confirm_password" name="usr_confirm_password" placeholder="Repita sua senha" type="password" value="<?php echo $password ?>" />
										</li>
									</ul>
									<br>
									<h3>Dados Pessoais</h3>
									<ul>
										<li style="width:49.6%; display:inline-block;">
											<label for="phone">Telefone:</label>
											<input id="phone" name="phone" placeholder="Digite um número de telefone fixo" type="text" value="<?php echo $phone ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="cellphone">Celular:</label>
											<input id="cellphone" name="cellphone" placeholder="Digite o número do celular" type="text" value="<?php echo $cellphone ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="cpf">CPF (<em style="font-size:13px">dado obrigatório para compras no site</em>):</label>
											<input id="cpf" name="cpf" placeholder="156.009.442-76" type="text" <?php if ($cpf != '') print " disabled=disabled" ?> value="<?php echo $cpf ?>" />
										</li>
									</ul>
									<br>
									<h3>Dados de Correspondência</h3>
									<ul>
										<li>
											<label name="address">Endereço (<em style="font-size:13px">Logradouro</em>):</label>
											<input id="address" name="address" placeholder="Av. Brig. Faria Lima" type="text" value="<?php echo $address ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="number">Número:</label>
											<input id="number" name="number" placeholder="1384" type="text" value="<?php echo $number ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="complement">Complemento:</label>
											<input id="complement" name="complement" placeholder="apto. 114" type="text" value="<?php echo $complement ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="neightborhood">Bairro:</label>
											<input id="neightborhood" name="neightborhood" placeholder="Jardim Paulistano" type="text" value="<?php echo $neightborhood ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="postal_code">CEP:</label>
											<input id="postal_code" name="postal_code" maxlength="9" placeholder="01452-002" type="text" value="<?php echo $postal_code ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="state">Estado:</label>
											<input id="h_state" name="h_state" type="hidden" value="<?php echo $state ?>" />
											<select name="state" id="state">
												<option value="">Selecione...</option>
											</select>
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label for="city">Cidade:</label>
											<input id="h_city" name="h_city" type="hidden" value="<?php echo $city ?>" />
											<select name="city" id="city" disabled="disabled">
												<option value=""><< - escolha primeiro um estado</option>
											</select>
										</li>
											<input class="btn-color-C" type="submit" value="<?php echo $btn_label ?>" />
										</li>
									</ul>
									<br>
									<!--
									<h3>Status de Compras</h3>
									<ul>
										<li>
											<label name="address">Compras realizadas:</label>
											<dl>
												<dt>Coleção Olho Grego</dt>
												<dd>
													<p>
														Solicitado em: <strong>08-10-2016 16:45:45</strong><br>
														Enviado em: <strong>13-10-2016 06:45:45</strong>
													</p>
													<a href="">
												</dd>
											</dl>
											<dl>
												<dt>Chícara de Porcelana</dt>
												<dd>
													<p>
														Solicitado em: <strong>02-03-2016 13:21:32</strong><br>
														Enviado em: <strong>08-03-2016 05:17:36</strong>
													</p>
												</dd>
											</dl>
										</li>
									</ul-->
								</fieldset>
							</form>
						</article>
					</dd>
				</dl>
			</aside>

			<!--?php
				include 'inc/features.php';
			?-->		
		</main>
		<?php
			include 'inc/footer.php';
		?>		
	</body>
</html>