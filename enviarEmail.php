<?php
/* apenas dispara o envio do formulário caso exista $_POST['enviarFormulario']*/
//if (isset($_POST['enviarFormulario'])){
require_once 'connector.php';
$oConn = New Conn();
$ref = $_REQUEST["ref"];

if ($ref=="facaOrcamento") {
  
  // Campos do formulário
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $cellphone = $_POST["cellphone"];
  $message = $_POST["message"];
  $prod_id = $_POST["product_id"];
  $prod_name = $_POST["product_name"];
  $prod_quant = $_POST["product_quant"];

  $mensagemConcatenada = '<div style="border:1px solid #EDEDED; padding:10px; text-align:center; font-family: tahoma, arial, verdana, sans-serif; font-size:14px">'; 
  $mensagemConcatenada .= '<img src="http://www.spatula.com.br/images/logoSpatula.png" alt=""><br/><br/>'; 
  $mensagemConcatenada .= '<strong style="font-size:18px;">Dados da Solicitação</strong><br/>'; 
  
  //Verifica se houve produto definido
  if( !empty($prod_name) && $prod_quant > 0 ){
    $mensagemConcatenada .= '<strong>Produto interessado</strong>: '.$prod_name.'<br/>'; 
    $mensagemConcatenada .= '<strong>Quantidade</strong>: '.$prod_quant.'<br/>'; 
  }else{
    $mensagemConcatenada .= 'Produto e quantidade não definido(s)<br/>'; 
  }
  $mensagemConcatenada .= '<br/><strong style="font-size:18px;">Dados do Solicitante</strong><br/>'; 
  $mensagemConcatenada .= '<strong>Nome</strong>: '.$name.'<br/>'; 
  $mensagemConcatenada .= '<strong>E-mail</strong>: '.$email.'<br/>'; 

  if( !empty($phone) ) {
    $mensagemConcatenada .= '<strong>Telefone Fixo</strong>: '.$phone.'<br/>'; 
  }
  if( !empty($cellphone) ) {
    $mensagemConcatenada .= '<strong>Telefone Celular</strong>: '.$cellphone.'<br/>'; 
  }
  if( !empty($message) ) {
    $mensagemConcatenada .= '<strong>Mensagem</strong>: '.$message.'<br/>'; 
  }
  $mensagemConcatenada .= '<br><br>Dica: clique em <strong>Responder</strong> para retornar o contato.'; 
  $mensagemConcatenada .= '</div>'; 
  /*********************************** || ************************************/ 

  $assunto  = 'Spatula - Solicitação de Orçamento';
  
  require_once('PHPMailer-master/PHPMailerAutoload.php');
      
  $mail = new PHPMailer();
  $mail->IsSMTP();
  
  //Authentication
  $mail->Host  = 'smtp.spatula.com.br';
  $mail->SMTPAuth  = true;
  $mail->Charset   = 'utf8_decode()';
  $mail->Port  = '587';
  $mail->Username  = 'desenvolvimento@spatula.com.br';
  $mail->Password  = 'Sp@tul@2016';
  
  //Define o remetente
  $mail->SetFrom('desenvolvimento@spatula.com.br', utf8_decode($name)); //Seu e-mail
  $mail->AddReplyTo(utf8_decode($email), utf8_decode($name)); //Seu e-mail
  $mail->Subject  = utf8_decode($assunto);
  
  //Define os destinatário(s)
  $mail->AddAddress('desenvolvimento@spatula.com.br','Spatula');
  //Campos abaixo são opcionais 
  //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  //$mail->AddCC('rafaelkellows@hotmail.com', 'Rafael S. Kellows'); // Copia
  $mail->AddBCC('rafaelkellows@hotmail.com', 'Rafael S. Kellows');
  //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo

  //
  $mail->IsHTML(true);
  $mail->Body  = utf8_decode($mensagemConcatenada);
   
  if(!$mail->Send()){
    $mensagemRetorno = '0';
  }else{
    $mensagemRetorno = '2';
  }
  echo $mensagemRetorno;
}
?>