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

		$page_title = 'Carrinho de Compras';
		include 'inc/head.php';
	?>		
	<body class="chn-checkout">
		<?php
			require_once 'connector.php';
			include 'inc/header.php';
			include 'inc/nav.php';
		?>		
		<main class="main_content">
			<section class="checkout msgBox">
				<p>
					<strong title="Aguarde">Aguarde...</strong><br>
					<span>Seu pedido está sendo processado.</span>
				</p>
			</section>		
			<aside>
				<ul>
					<li><a href="./">Home</a></li>
					<li>Carrinho de Compras</li>
				</ul>
				<dl>
					<dt><h2 class="bgTitle">CARRINHO DE COMPRAS</h2></dt>
					<dd>
						
							<?php 
								if( isset($usuario) ){
									if( !$usuario->getId() ){
										echo '<span>';
										echo '	<img src="images/ilustraCheckout.jpg" alt="A MELHOR FORMA DE ESTAR PRESENTE" />';
									}else{
										$oConn = New Conn();
										$oSlct = $oConn->SQLselector("*","tbl_accounts","id=".$usuario->getId(),"");
	                	if ($oSlct->rowCount() > 0) {
	                		$row = $oSlct->fetch(PDO::FETCH_ASSOC);
									    $key_token = date('dmYHis');//$row['name'] . $row['email'] . date('dmYHis');
									    $key_token = md5($key_token);
									    $oConn = New Conn();
											echo '<span class="userData">';
											echo '<ul>';
											echo '	<li><strong>Dados da Compra</strong></li>';
											echo '	<li>User ID: <em>'.$usuario->getId().'</em><input type="hidden" name="user_id" value="'.$usuario->getId().'" /></li>';
											echo '	<li>Cód: <em> SPTL'.$usuario->getId(). date('dmYHis').'</em><input type="hidden" name="reference" value="SPTL'.$usuario->getId(). date('dmYHis').'" /></li>';
											echo '	<li>&nbsp;</li>';
											echo '	<li><strong>Dados do Comprador</strong></li>';
											echo '	<li>Nome: <em>'.$row['name'].'</em><input type="hidden" name="senderName" value="'. $row['name'] .'" /></li>';
											//echo '	<li>CEP: <em>'.$row['cpf'].'</em><input type="hidden" name="cpf" value="'. $row['cpf'] .'" /></li>';
											$find = array("-","(",")"," ");
											echo '	<li>Contato: <em>'. (($row['cellphone']!='') ? $row['cellphone'] : 'Não cadastrado.' ) .'</em>'; //( str_replace($find,'',$row['cellphone']) )
											echo '	<input type="hidden" name="senderAreaCode" value="'. substr(( str_replace($find,'',$row['cellphone']) ),0,2) .'" />';
											echo '	<input type="hidden" name="senderPhone" value="'. substr(( str_replace($find,'',$row['cellphone']) ),2) .'" />';
											echo '	</li>';
											echo '	<li>E-mail: <em>'.$row['email'].'</em><input type="hidden" name="senderEmail" value="'. $row['email'] .'" /></li>';
											echo '	<li>&nbsp;</li>';
											echo '	<li><strong>Dados de Entrega</strong></li>';
											echo '	<li>'.$row['address'].', '.$row['number'].' - '.$row['neightborhood'].( ($row['complement'] == '') ? '' : ' - '.$row['complement'] ).'</li>';
											echo '	<li>'.$row['city'].', '.$row['state'].'<br>CEP: '.$row['postal_code'];
											echo '		<input type="hidden" name="shippingAddressStreet" value="'. $row['address'] .'" />';
											echo '		<input type="hidden" name="shippingAddressNumber" value="'. $row['number'] .'" />';
											echo '		<input type="hidden" name="shippingAddressDistrict" value="'. $row['neightborhood'] .'" />';
											echo '		<input type="hidden" name="shippingAddressComplement" value="'. $row['complement'] .'" />';
											echo '		<input type="hidden" name="shippingAddressPostalCode" value="'. ( str_replace($find,'',$row['postal_code']) ) .'" />';
											echo '		<input type="hidden" name="shippingAddressCity" value="'. $row['city'] .'" />';
											echo '		<input type="hidden" name="shippingAddressState" value="'. $row['state'] .'" />';
											echo '		<input type="hidden" name="shippingAddressCountry" value="BRA" />';
											echo '	</li>';
											echo '	<a class="btn-default btn-color-C" href="signin.php"><i class="fa fa-edit"></i>alterar dados</a>';
											echo '</ul>';
										}
									}
								}else{
									echo '<span>';
									echo '<img src="images/ilustraCheckout.jpg" alt="A MELHOR FORMA DE ESTAR PRESENTE" />';
								}
							?>
						</span>
						<article>
							<p>Confira abaixo a lista de itens dos produtos que você adicionou ao carrinho. <br><strong style="font-size: 16px"> Obs.:</strong> não esqueça de nos enviar a imagem do logo da sua marca para <br>analisarmos. Você pode enviar arquivos em JPG, JPEG ou PNG de até 300kb.</p>
							<form id="checkout" action="/" method="post" target="_blank" enctype="multipart/form-data">
								<input type="hidden" id="currency" name="currency" value="BRL" />
								<input type="hidden" id="shippingType" name="shippingType" value="3" />
								<input type="hidden" name="transReference" value="" />
								<input type="hidden" name="transUserName" value="" />
								<fieldset>
									<label><strong>Selecione o arquivo</strong></label>
									<input type="file" name="file" id="file" /><br><br>
									<input type="checkbox" name="no_image" id="no_image" style="width:25px" value="true" /> 
									<label for="no_image" style="margin-top: -11px; display: inline-block; vertical-align: middle;"><strong>Não tenho imagem para enviar</strong></label>
									<div id="image_preview">
										<p id='loading' >loading..</p>
										<div id="message"></div>
										<img id="previewing" src="images/noimage.png" />
									</div>
									<p class="msg">Message</p>

									<table cellpadding="0" cellspacing="0" border="1" style="width: 100%;">
										<thead>
											<th class="id">ID</th>
											<th class="info">Produto</th>
											<th class="quant">Quant.</th>
											<th class="price">Valor</th>
											<th class="button">Excluir</th>
										</thead>
										<tbody>
											<tr><td colspan="5" style="padding-top: 25px">Nenhum item cadastrado no Carrinho de Compras</td></tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="5">&nbsp;</td>
											</tr>
											<tr class="bg total">
												<td colspan="4" style="text-align: right; padding-right: 5px;">Total da Compra:</td>
												<td>R$<i>0,00</i></td>
											</tr>
											<tr class="bg weight">
												<td colspan="4" style="text-align: right; padding-right: 5px;">Peso total estimado:</td>
												<td><i>0</i>gr</td>
											</tr>
											<tr>
												<td colspan="5">&nbsp;</td>
											</tr>
											<tr>
												<td colspan="5" style="font-size: 14px; text-align: center;"><strong style="font-size: 14px">Frete:</strong> você poderá escolher PAC ou SEDEX no box de pagamento do PagSeguro ao finalizar sua compra.</td>
											</tr>
											<tr>
											<?php
												if( isset($usuario) ){
													echo '<td colspan="5"><input class="btn-color-A" type="submit" value="Finalizar e comprar com PagSeguro" /></td>';
												}else{
													echo '<td colspan="5"><input class="login btn-color-A" type="button" value="Entrar e comprar com PagSeguro" /></td>';
												}
											?>
											</tr>
											<tr>
												<td colspan="5"></td>
											</tr>
										</tfoot>
									</table>


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