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

		$page_title = 'Faça seu Orçamento';
		include 'inc/head.php';
	?>		
	<body class="chn-budget">
		<?php
			require_once 'adm/connector.php';
			include 'inc/header.php';
			include 'inc/nav.php';
			$oConn = New Conn();
			$id_prod = ( isset($_REQUEST["id_prod"]) && !empty($_REQUEST['id_prod']) ) ? ' AND id='.$_REQUEST["id_prod"] : '';
			$cat = ( isset($_REQUEST["cat"]) && !empty($_REQUEST['cat']) ) ? ' AND cid='.$_REQUEST["cat"] : '';
			$subcat = ( isset($_REQUEST["sub"]) && !empty($_REQUEST['sub']) ) ? ' AND sid='.$_REQUEST["sub"] : '';
			$capa = ( isset($_REQUEST["capa"]) && !empty($_REQUEST["capa"]) ) ? $_REQUEST["capa"] : '';
			$oSlctProds = $oConn->SQLselector("*","produtos",'status=1'.$id_prod.$cat.$subcat,'title');
			//$prodName = ( isset($id_prod) && !empty($id_prod) && isset($cat) && !empty($cat) && isset($subcat) && !empty($subcat) ) ? $oSlctProds->fetch(PDO::FETCH_ASSOC)['title'] : 'Selecione o produto';
			$prodName = $oSlctProds->fetch(PDO::FETCH_ASSOC)['title'];
			$prodName = ( ($prodName == '') ? '' : $prodName );

			$oImage = $oConn->SQLselector("*","galeria","id='".$capa."'",'');
			$prodCapa = $oImage->fetch(PDO::FETCH_ASSOC)['src'];
			$prodCapa = ( ($prodCapa == '') ? 'images/ilustraOrcamento.jpg' : $prodCapa );
		?>		
		<main class="main_content">
			<aside>
				<ul>
					<li><a href="./">Home</a></li>
					<li>Faça seu Orçamento</li>
				</ul>
				<dl>
					<dt><h2 class="bgTitle">A MELHOR FORMA DE ESTAR PRESENTE</h2></dt>
					<dd>
						<span>
							<img src="<?php echo $prodCapa ?>" alt="A MELHOR FORMA DE ESTAR PRESENTE" />
						</span>
						<article>
							<p>Preencha os campos abaixo para solicitar seu orçamento.</p>
							<form id="budget" action="/" method="post">
								<fieldset>
									<legend>Faça seu Orçamento</legend>
									<p class="msg">Aqui vem a mensagem</p>
									<ul>
										<li style="width:50%; display:inline-block">
											<label>Produto:</label>
											<?php 
					              if( isset($_REQUEST['id_prod']) && isset($_REQUEST['cat']) && isset($_REQUEST['sub']) ){
													echo '<input name="product_name" type="text" disabled="disabled" value="'.$prodName.'" />';
													echo '<input name="product_id" type="hidden" value="'.$_REQUEST["id_prod"].'" />';
					              }else{
					              	$oSlctProds = $oConn->SQLselector("*","produtos",'status=1','title');
						              if ($oSlctProds->rowCount() > 0) {
					                	echo "<select id='slc_product' name='product_name'>";
				                    echo '	<option value="0">Selecione um item</option>';
					                  while ( $prod = $oSlctProds->fetch(PDO::FETCH_ASSOC) ) {
					                    echo '	<option value="'.$prod['id'].'" '.( ($prod['id']==$_REQUEST["id_prod"]) ? ' selected ':'').'>'.$prod['title'].'</option>';
														}
														echo "</select>";
									        }
								        }
												if ($usuario){ 
													$name = $usuario->getName();
													$email = $usuario->getEmail();
												}
											?>									
										</li>
										<li class="spinner" style="width:10%; display:inline-block">
											<label>Quant.</label>
											<input name="product_quant" disabled="disabled" maxlength="3" type="text" value="0" />
											<a href="javascript:void(0);" class="s-up" title="Clique para aumentar o valor">+</a>
											<a href="javascript:void(0);" class="s-down" title="Clique para diminuir o valor">-</a>
										</li>
										<!--li class="spinner" style="display:inline-block; vertical-align:bottom; ">
											<a href="javascript:void(0);" class="s-add btn-default btn-color-A" title="Clique para adicionar outro item">+</a>
										</li-->
										<li>
											<label>Nome:</label>
											<input name="name" type="text" <?php if (!empty($name)) print " disabled=disabled" ?> value="<?php if (!empty($name)) echo $name ?>" />
										</li>
										<li>
											<label>E-mail:</label>
											<input name="email" placeholder="Digite seu e-mail" type="text" <?php if (!empty($email)) print " disabled=disabled" ?> value="<?php if (!empty($email)) echo $email ?>" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label>Telefone (<em style="font-size:13px">opcional</em>):</label>
											<input name="phone" placeholder="Digite um número de telefone fixo" type="text" value="" />
										</li>
										<li style="width:49.6%; display:inline-block;">
											<label>Celular (<em style="font-size:13px">opcional</em>):</label>
											<input name="cellphone" placeholder="Digite seu número de celular" type="text" value="" />
										</li>
										<li>
											<label>Mensagem (<em style="font-size:13px">opcional</em>):</label>
											<textarea name="message"></textarea>
										</li>
										<li>
											<input class="btn-color-A" type="submit" value="enviar orçamento" >
										</li>
									</ul>
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