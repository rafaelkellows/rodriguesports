<?php 
    //header("Content-Type: text/plain");
    require_once 'connector.php';
    //$servername = 'http://'.$_SERVER['SERVER_NAME'];
    $servername = 'http://www.spatula.com.br';
    $ref = $_REQUEST["ref"];
    $name = ( isset($_REQUEST["name"] ) ) ? utf8_decode($_REQUEST["name"]) : 0 ;
    $email = ( isset($_REQUEST["email"] ) ) ? $_REQUEST["email"] : 0 ;
    $login = ( isset($_REQUEST["login"] ) ) ? $_REQUEST["login"] : 0 ;
    $usr_password = ( isset($_REQUEST["usr_password"] ) ) ? $_REQUEST["usr_password"] : 0 ;
    $phone = ( isset($_REQUEST["phone"] ) ) ? $_REQUEST["phone"] : null ;
    $cellphone = ( isset($_REQUEST["cellphone"] ) ) ? $_REQUEST["cellphone"] : null ;
    $cpf = ( isset($_REQUEST["cpf"] ) ) ? $_REQUEST["cpf"] : 0 ;
    $address = ( isset($_REQUEST["address"] ) ) ? utf8_decode($_REQUEST["address"]) : 0 ;
    $number = ( isset($_REQUEST["number"] ) ) ? $_REQUEST["number"] : 0 ;
    $complement = ( isset($_REQUEST["complement"] ) ) ? utf8_decode($_REQUEST["complement"]) : null ;
    $neightborhood = ( isset($_REQUEST["neightborhood"] ) ) ? utf8_decode($_REQUEST["neightborhood"]) : null ;
    $postal_code = ( isset($_REQUEST["postal_code"] ) ) ? $_REQUEST["postal_code"] : null ;
    $state = ( isset($_REQUEST["state"] ) ) ? utf8_decode($_REQUEST["state"]) : 0 ;
    $city = ( isset($_REQUEST["city"] ) ) ? utf8_decode($_REQUEST["city"]) : 0 ;
    //create a random key
    $key_token = $login . $email . date('mY');
    $key_token = md5($key_token);
    $oConn = New Conn();

    if ($ref=="cadastreSe") {
      //Novo Cadastro
      if( !empty($login)){
        //echo "'$name','$email','$login','$usr_password','$phone','$cellphone','$cpf','$address','$number','$complement','$neightborhood','$postal_code','$state','$city','0','$key_token',now(),now(),now()";
        //Insert Datas on DB
        $sqlInsert = $oConn->SQLinserter("tbl_accounts","name,email,login,password,phone,cellphone,cpf,address,number,complement,neightborhood,postal_code,state,city,status,key_token,created,modified,visited","'$name','$email','$login','$usr_password','$phone','$cellphone','$cpf','$address','$number','$complement','$neightborhood','$postal_code','$state','$city','0','$key_token',now(),now(),now()");
        if(!$sqlInsert){
          $mensagemRetorno = '0';
        }else{
          $mensagemRetorno = '2';
          echo $mensagemRetorno;

          /*** INÍCIO - ENVIO DE EMAIL ***/
          $enviaFormularioParaNome = utf8_decode($name);
          $enviaFormularioParaEmail = $email;

          $caixaPostalServidorNome = 'Spatula';
          $caixaPostalServidorEmail = 'desenvolvimento@spatula.com.br';
          $caixaPostalServidorSenha = 'Sp@tul@2016';

          /* abaixo as veriaveis principais, que devem conter em seu formulario*/
          $assunto  = 'Confirmação de Cadastro';

          $mensagemConcatenada = '<div style="border:1px solid #EDEDED; padding:10px; text-align:center; font-size:14px; font-family: Trebuchet MS; ">'; 
          $mensagemConcatenada .= ' <a href="'.$servername.'" target="_blank"><img src="'.$servername.'/images/logoSpatula.png" alt=""></a><br/><br/>'; 
          $mensagemConcatenada .= ' <strong style="font-size:18px;">Confirmação de Cadastro</strong><br/>'; 
          $mensagemConcatenada .= ' <strong>'.utf8_decode($name).'</strong>, você realizou seu cadastro através do site '.$servername.'.<br/>'; 
          $mensagemConcatenada .= ' Para desfrutar de nossos serviços no site é importante a ativação do seu cadastrado <a href="'.$servername.'/?e='.$email.'&k_token='.$key_token.'" target="_blank">clicando aqui</a>.<br/>'; 
          $mensagemConcatenada .= ' Caso não consiga através no link acima, copie e cole no seu navegador essa URL: <br><em>'.$servername.'/?e='.$email.'&k_token='.$key_token.'</em><br/><br/>'; 
          $mensagemConcatenada .= ' Obrigado, a equipe da Spatula agradece sua visita.'; 
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
            $mensagemRetorno = '0';
          }else{
            $mensagemRetorno = '2';
          }
          echo $mensagemRetorno;
          return;
        }
      }
      //Validando Cadastro
      $e =  ( isset($_REQUEST["e"] ) ) ? $_REQUEST["e"] : 0 ;
      $k_token =  ( isset($_REQUEST["k_token"] ) ) ? $_REQUEST["k_token"] : 0 ;
      if($e !== 0 && $k_token !== 0){
        //Já foi validado
        $sqlSct = $oConn->SQLselector("name","tbl_accounts","email='".$e."' AND key_token='".$k_token."' AND status=1",'');
        if( $sqlSct->rowCount() === 1){
          setcookie('msg', '2', (time() + 5), '/'); //5 seconds
          header('location: ./');
          return;
        }
        //------------------------------
        //Não foi validado
        $sqlUpdate = $oConn->SQLupdater("tbl_accounts","modified = now(), status = 1","email='".$e."' AND key_token='".$k_token."'");
        $row = $sqlUpdate->fetch(PDO::FETCH_ASSOC);
        if($sqlUpdate){
          
          $sqlSct = $oConn->SQLselector("name, login, password","tbl_accounts","email='".$e."' AND key_token='".$k_token."'",'');
          $rowSct = $sqlSct->fetch(PDO::FETCH_ASSOC);

          /*** INÍCIO - ENVIO DE EMAIL ***/
          $enviaFormularioParaNome = $rowSct['name'];
          $enviaFormularioParaEmail = $e;

          $caixaPostalServidorNome = 'Spatula';
          $caixaPostalServidorEmail = 'desenvolvimento@spatula.com.br';
          $caixaPostalServidorSenha = 'Sp@tul@2016';


          /* abaixo as veriaveis principais, que devem conter em seu formulario*/
          $assunto  = 'Confirmação de Cadastro';

          $mensagemConcatenada = '<div style="border:1px solid #EDEDED; padding:10px; text-align:center;">'; 
          $mensagemConcatenada .= ' <a href="'.$servername.'" _target="_blank"><img src="'.$servername.'/images/logoSpatula.png" alt=""></a><br/><br/>'; 
          $mensagemConcatenada .= ' <strong style="font-size:18px;">Confirmação de Cadastro</strong><br/>'; 
          $mensagemConcatenada .= ' Parabéns <strong>'.$rowSct['name'].'</strong>, você realizou a confirmação do seu cadastro com sucesso!<br/>'; 
          $mensagemConcatenada .= ' Agora você já pode desfrutar de todos os nossos serviços e para isso, acesse o site e, efetue seu login usando as credenciais cadastradas:<br/>'; 
          $mensagemConcatenada .= ' <strong>Login</strong>: '.$rowSct['login'].'<br/>'; 
          $mensagemConcatenada .= ' <strong>Senha</strong>: '.$rowSct['password'].'<br/><br/>'; 
          $mensagemConcatenada .= ' <a href="'.$servername.'" _target="_blank">'.$servername.'</a><br/><br/>'; 
          $mensagemConcatenada .= ' Obrigado, a equipe da Spatula agradece sua visita.'; 
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
            $mensagemRetorno = '0';
          }else{
            setcookie('msg', '1', (time() + 5), '/'); //5 seconds
            header('location: ./');
          }
          echo $mensagemRetorno;
          return;
          //header('location: ../page.php?nvg=item&pid='.$id.'&msg=1');
        }
        else{
          header('location: index.php?msg=0');
          return;
        }
      }
      //Verify if email exists
      $sqlSelector = $oConn->SQLselector("email","tbl_accounts","email='".$email."'",'');
      if($sqlSelector){
        if ($sqlSelector->rowCount() > 0) {
          $mensagemRetorno = '3';
          echo $mensagemRetorno;
          return;
        }
      }
    }
    if ($ref=="atualizaCadastro") {
        $id = ( isset($_REQUEST["id"] ) ) ? $_REQUEST["id"] : 0 ;
        if( $id > 0 ){
            $sqlUpdate = $oConn->SQLupdater("tbl_accounts","name = '$name',email = '$email',login = '$login',password = '$usr_password',phone = '$phone',cellphone = '$cellphone',cpf = '$cpf',address = '$address',number = '$number',complement = '$complement',neightborhood = '$neightborhood',postal_code = '$postal_code',state = '$state',city = '$city', modified = now()","id='".$id."'");
            if(!$sqlUpdate){
                $mensagemRetorno = "0";
            }
            else{
                $mensagemRetorno = '2';
            }    
            echo $mensagemRetorno;  
        }
        return;
    }
    if ($ref=="forgetPassword") {
        $sqlSct = $oConn->SQLselector("*","tbl_accounts","email='".$email."'",'');
        if( $sqlSct->rowCount() === 1){
          $rowSct = $sqlSct->fetch(PDO::FETCH_ASSOC);
          /*** INÍCIO - ENVIO DE EMAIL ***/
          $enviaFormularioParaNome = $rowSct['name'];
          $enviaFormularioParaEmail = $email;

          $caixaPostalServidorNome = 'Spatula';
          $caixaPostalServidorEmail = 'desenvolvimento@spatula.com.br';
          $caixaPostalServidorSenha = 'Sp@tul@2016';


          /* abaixo as veriaveis principais, que devem conter em seu formulario*/
          $assunto  = 'Solicitação de Re-envio de Senha';

          $mensagemConcatenada = '<div style="border:1px solid #EDEDED; padding:10px; text-align:center;">'; 
          $mensagemConcatenada .= ' <a href="'.$servername.'" _target="_blank"><img src="'.$servername.'/images/logoSpatula.png" alt=""></a><br/><br/>'; 
          $mensagemConcatenada .= ' <strong style="font-size:18px;">Reenvio de Senha</strong><br/>'; 
          $mensagemConcatenada .= ' <strong>'.$rowSct['name'].'</strong>, você realizou a solicitação do envio da sua senha.<br/>'; 
          $mensagemConcatenada .= ' Abaixo segue suas credenciais cadastradas no site:<br/>'; 
          $mensagemConcatenada .= ' <strong>Login</strong>: '.$rowSct['login'].'<br/>'; 
          $mensagemConcatenada .= ' <strong>Senha</strong>: '.$rowSct['password'].'<br/><br/>'; 
          $mensagemConcatenada .= ' <a href="'.$servername.'" _target="_blank">'.$servername.'</a><br/><br/>'; 
          $mensagemConcatenada .= ' <strong>Obs.:</strong> Caso você não tenha solicitado nenhum reenvio de senha pedimos que entre em contato com nossa equipe para gerarmos um novo token de segurança.<br/><br/>'; 
          $mensagemConcatenada .= ' Obrigado, a equipe da Spatula agradece sua visita.'; 
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
            setcookie('msg', '6', (time() + 5), '/'); //5 seconds
            header('location: ./');
          }else{
            setcookie('msg', '4', (time() + 5), '/'); //5 seconds
            header('location: ./');
          }
          echo $mensagemRetorno;
          return;
        }else{
          setcookie('msg', '5', (time() + 5), '/'); //5 seconds
          setcookie('eml', $email, (time() + 5), '/'); //5 seconds
          header('location: ./');
          return;
        }
    }
?>