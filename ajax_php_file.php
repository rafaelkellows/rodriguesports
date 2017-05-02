<?php
	header("Content-Type: text/plain, charset=ISO-8859-1");
    $servername = 'http://'.$_SERVER['SERVER_NAME'];
    $u_name = $_REQUEST['transUserName'];
    $transaction = $_REQUEST['transReference'];
	
	if(isset($_FILES["file"]["type"])){
		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
		) && ($_FILES["file"]["size"] < 300000)//Approx. 300kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file"]["error"] > 0){
			echo '0';	//;"Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
		}else{
			if (file_exists("upload/" . $_FILES["file"]["name"])) {
				echo '2';//;$_FILES["file"]["name"] . " Esse arquivo já existe!";
			}else{
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "upload/".$_FILES['file']['name']; // Target path where file is to be stored
				
				$file_name = $_FILES['file']['name'];
				$File_Name          = strtolower($file_name);
				$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
				$Random_Number      = rand(0, 9999999999); //Random number to be added to name.

			    $now = new DateTime();
			    $dateSR = str_replace('-','_',$now->format('d-m-Y H:i:s'));
			    $dateSR = str_replace(' ','_',$dateSR);
			    $dateSR = str_replace(':','_',$dateSR);

				$NewFileName = $Random_Number.'_'.$dateSR.$File_Ext; //new file name

				move_uploaded_file($sourcePath,"upload/".$NewFileName) ; // Moving Uploaded file
				//echo "Imagem carregada com sucesso!><br/>";
				//echo "<br/><b>Nome do Arquivo:</b> " . $_FILES["file"]["name"] . "<br>";
				//echo "<b>Tipo do Arquivo:</b> " . $_FILES["file"]["type"] . "<br>";
				//echo "<b>Tamanho:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "upload/".$NewFileName; //'http://'.$_SERVER['SERVER_NAME'].'/'.$targetPath;

				/*** INÍCIO - ENVIO DE EMAIL ***/
				$enviaFormularioParaNome = utf8_decode($name);
				$enviaFormularioParaEmail = $email;

				$caixaPostalServidorNome = 'Spatula';
				$caixaPostalServidorEmail = 'desenvolvimento@spatula.com.br';
				$caixaPostalServidorSenha = 'Sp@tul@2016';

				/* abaixo as veriaveis principais, que devem conter em seu formulario*/
				$assunto  = 'Pedido: '.$transaction.' - Logo/Marca';

				$mensagemConcatenada = '<div style="border:1px solid #EDEDED; padding:10px; text-align:center;">'; 
				$mensagemConcatenada .= ' <a href="'.$servername.'" target="_blank"><img src="'.$servername.'/images/logoSpatula.png" alt=""></a><br/><br/>'; 
				//$mensagemConcatenada .= ' <strong style="font-size:18px;">Logo/Marca</strong><br/>'; 
				$mensagemConcatenada .= ' Olá. <strong>'.utf8_decode($u_name).'</strong>, realizou uma compra no site. <br>Abaixo segue os dados do Pedido:<br/>'; 
				
				$mensagemConcatenada .= '<table style="font-family:Trebuchet MS; font-size:14px;" cellspacing="0" cellpadding="0" border="0">';
				$mensagemConcatenada .= '	<tr>';
				$mensagemConcatenada .= '		<td><strong>Código do Pedido:</strong></td>';
				$mensagemConcatenada .= '		<td>'.$transaction.'</td>';
				$mensagemConcatenada .= '	</tr>';
				$mensagemConcatenada .= '	<tr>';
				$mensagemConcatenada .= '		<td><strong>Link para o Logo:</strong></td>';
				$mensagemConcatenada .= '		<td><a href="'.$servername.'/upload/'.$NewFileName.'" target="_blank"><img src="'.$servername.'/upload/'.$NewFileName.'" width="100" alt=""></a></td>';
				$mensagemConcatenada .= '	</tr>';
				$mensagemConcatenada .= '</table>';

				$mensagemConcatenada .= ' Veja os <a href="https://pagseguro.uol.com.br/transaction/search.jhtml" target="_blank">detalhes dessa transação</a> no PagSeguro.'; 
				$mensagemConcatenada .= '</div>'; 
				/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/ 

				require_once('PHPMailer-master/PHPMailerAutoload.php');

				$mail = new PHPMailer();

				$mail->IsSMTP();
				$mail->SMTPAuth  = true;
				$mail->Charset   = 'utf8_decode()';
				$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
				$mail->Port  = '587';
				$mail->Username  = $caixaPostalServidorEmail;
				$mail->Password  = $caixaPostalServidorSenha;
				$mail->From  = $caixaPostalServidorEmail;
				$mail->FromName  = utf8_decode($caixaPostalServidorNome);
				$mail->IsHTML(true);
				$mail->Subject  = utf8_decode($assunto);
				$mail->Body  = utf8_decode($mensagemConcatenada);

				$mail->AddBCC('rafaelkellows@hotmail.com', 'Rafael S. Kellows');
				$mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));

				if(!$mail->Send()){
				//$mensagemRetorno = '0';
				}else{
				//$mensagemRetorno = '2';
				}
				//echo $mensagemRetorno;
				return;
			}
		}
		}else{
			echo '1';	//;"Tipo ou Tamanho inválido. Porfavor, siga as instruções.";
		}
	}else{
		echo $_REQUEST['no_image'];
		return;

		/*** INÍCIO - ENVIO DE EMAIL ***/
		$enviaFormularioParaNome = utf8_decode($name);
		$enviaFormularioParaEmail = $email;

		$caixaPostalServidorNome = 'Spatula';
		$caixaPostalServidorEmail = 'desenvolvimento@spatula.com.br';
		$caixaPostalServidorSenha = 'Sp@tul@2016';

		/* abaixo as veriaveis principais, que devem conter em seu formulario*/
		$assunto  = 'Pedido: '.$transaction.' - Logo/Marca';

		$mensagemConcatenada = '<div style="border:1px solid #EDEDED; padding:10px; text-align:center;">'; 
		$mensagemConcatenada .= ' <a href="'.$servername.'" target="_blank"><img src="'.$servername.'/images/logoSpatula.png" alt=""></a><br/><br/>'; 
		//$mensagemConcatenada .= ' <strong style="font-size:18px;">Logo/Marca</strong><br/>'; 
		$mensagemConcatenada .= ' Olá. <strong>'.utf8_decode($u_name).'</strong>, realizou uma compra no site. <br>Abaixo segue os dados do Pedido:<br/>'; 
		
		$mensagemConcatenada .= '<table style="font-family:Trebuchet MS; font-size:14px;" cellspacing="0" cellpadding="0" border="0">';
		$mensagemConcatenada .= '	<tr>';
		$mensagemConcatenada .= '		<td><strong>Código do Pedido:</strong></td>';
		$mensagemConcatenada .= '		<td>'.$transaction.'</td>';
		$mensagemConcatenada .= '	</tr>';
		$mensagemConcatenada .= '	<tr>';
		$mensagemConcatenada .= '		<td><strong>Link para o Logo:</strong></td>';
		$mensagemConcatenada .= '		<td>Não há imagem</td>';
		$mensagemConcatenada .= '	</tr>';
		$mensagemConcatenada .= '</table>';

		$mensagemConcatenada .= ' Veja os <a href="https://pagseguro.uol.com.br/transaction/search.jhtml" target="_blank">detalhes dessa transação</a> no PagSeguro.'; 
		$mensagemConcatenada .= '</div>'; 
		/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/ 

		require_once('PHPMailer-master/PHPMailerAutoload.php');

		$mail = new PHPMailer();

		$mail->IsSMTP();
		$mail->SMTPAuth  = true;
		$mail->Charset   = 'utf8_decode()';
		$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
		$mail->Port  = '587';
		$mail->Username  = $caixaPostalServidorEmail;
		$mail->Password  = $caixaPostalServidorSenha;
		$mail->From  = $caixaPostalServidorEmail;
		$mail->FromName  = utf8_decode($caixaPostalServidorNome);
		$mail->IsHTML(true);
		$mail->Subject  = utf8_decode($assunto);
		$mail->Body  = utf8_decode($mensagemConcatenada);

		$mail->AddBCC('rafaelkellows@hotmail.com', 'Rafael S. Kellows');
		$mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));

		if(!$mail->Send()){
		//$mensagemRetorno = '0';
		}else{
		//$mensagemRetorno = '2';
		}
		//echo $mensagemRetorno;
		return;

	}
?>