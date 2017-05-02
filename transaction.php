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
	<body class="chn-transaction">
		<?php
			require_once 'connector.php';
			include 'inc/header.php';
			include 'inc/nav.php';
		?>		
		<main class="main_content">
			<aside>
				<ul>
					<li><a href="./">Home</a></li>
					<li>Meus Pedidos</li>
				</ul>
				<dl>
					<dt><h2 class="bgTitle">MEUS PEDIDOS</h2></dt>
					<dd>
						<span><img src="images/ilustraTransaction.jpg" alt="A MELHOR FORMA DE ESTAR PRESENTE" /></span>
						<article>
							<p>Confira abaixo a lista de itens dos produtos que você comprou. Clique no <strong>Código da Transação</strong> para ver mais detalhes da compra.</p>
							<form id="transaction" action="/" method="post" target="_blank">
								<fieldset>
									<table cellpadding="0" cellspacing="0" border="1" style="width: 100%;">
										<thead>
											<th class="id">Transação</th>
											<th class="center">Data/Hora Sistema</th>
										</thead>
										<tbody>
											<?php
												if ($usuario){ 
													$id_user = $usuario->getId();
													$oConn = New Conn();
													$sqlSct = $oConn->SQLselector("*","tbl_requests","id_user='".$id_user."'",'created desc');
													/*$row = $sqlSct->fetch(PDO::FETCH_ASSOC);
													if(!$row){
														echo '<tr><td colspan="2" style="padding-top: 25px">Nenhum item comprado no Site.</td></tr>';
													}*/
													while ( $row = $sqlSct->fetch(PDO::FETCH_ASSOC) ) {
														echo '<tr>';
														echo '	<td>';
														echo '		<a href="javascript:void(0);" title="'.$row['trans_code'].'">'.$row['trans_code'].'</a>';
														echo '		<div></div>';
														if( $row['file_logo_marca'] != '' ){
															echo '		<img src="'.$row['file_logo_marca'].'" alt="" />';
														}
														echo '	</td>';
														echo '	<td class="center">'.date_format(date_create($row['created']), 'd/m/y H:i:s').'</td>';
														echo '</tr>';
													}
												}else{
													echo '<tr><td colspan="2" style="padding-top: 25px">Nenhum item comprado no Site.</td></tr>';
												}
											?>
										</tbody>
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