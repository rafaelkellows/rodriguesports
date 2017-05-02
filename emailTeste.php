<?php

    // Destinatário
    $para = "desenvolvimento@spatula.com.br";
    $name = "Rafael Kellows";
    // Assunto do e-mail
    $subject="Spatula Orçamento";

    // Monta o corpo da mensagem com os campos
    $body  = "<html>" . "\r\n";
    $body .= "  <head>" . "\r\n";
    $body .= "    <title>Fale Conosco - Spatula</title>" . "\r\n";
    $body .= "    <meta charset='UTF-8'>" . "\r\n";
    $body .= "  </head>" . "\r\n";
    $body .= "  <body>" . "\r\n";
    $body .= "    <p>Olá, <strong>Desenvolvidor</strong> enviou um formulário do canal Spatula Orçamento.</p>" . "\r\n";
    $body .= "    <p><strong>Área de atuação</strong></p>" . "\r\n";
    $body .= "    <p><strong>Telefone Fixo</strong></p>" . "\r\n";
    $body .= "    <p><strong>Telefone Celular</strong></p>" . "\r\n";
    $body .= "    <p><strong>Link para o currículo</strong></p>" . "\r\n";
    $body .= "  </body>" . "\r\n";
    $body .= "</html>";

    // Cabeçalho do e-mail
    $header = "Content-type: text/html; charset=utf-8" . "\r\n";
    
    // Additional headers
    $header .= "To: Contato para Spatula < $para >" . "\r\n";
    $header .= "From: $name < no-reply@spatula.com.br >" . "\r\n";

    $sender = mail($para, $subject, $body, $header);

    if($sender){
      $msg = "Sua mensagem foi enviada com sucesso.";
    }else{
      $msg = "Sua mensagem NÃO foi enviada.";
    }
    echo '-- MSG STATUS: '.$msg;

?>