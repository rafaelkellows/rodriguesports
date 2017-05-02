<?php
require_once 'usuario.php';
require_once 'autenticador.php';
require_once 'sessao.php';
$servername = 'http://'.$_SERVER['SERVER_NAME'];
//$servername = 'http://www.spatula.com.br';
if( isset($_REQUEST["acao"]) ){
  switch($_REQUEST["acao"]) {
    case 'entrar': {
      # Uso do singleton para instanciar
      # apenas um objeto de autenticação
      # e esconder a classe real de autenticação
      $aut = Autenticador::instanciar();
      # efetua o processo de verificação de confirmação
      if ($aut->confirm($_REQUEST["login"], $_REQUEST["password"])) {
        setcookie('msg', '3', (time() + (2 * 3600)), '/');
        header('location: '.$servername);
        return;
      }

      # efetua o processo de autenticação
      if ($aut->logar($_REQUEST["login"], $_REQUEST["password"])) {
        # redireciona o usuário para dentro do sistema
          
      function current_protocol(){
        $protocol = 'http';
        if ( array_key_exists( 'HTTPS', $_SERVER ) && $_SERVER['HTTPS'] === 'on' ){
            $protocol = 'https';
        }
        return $protocol;
      }
      //------------------------------------------------------------------------
      function current_has_ssl(){
        return current_protocol() == 'https';
      }
      //------------------------------------------------------------------------
      function force_https(){
        if ( current_has_ssl() == false ){
          header( 'Location: http://'.$_SERVER['SERVER_NAME'].$_REQUEST["curr"] );
          exit();
        }
      }

      //------------------------------------------------------------------------
      // Usage:

      force_https(); // at the top of a script before any output.


        //header('location: '.$_REQUEST["curr"]);
        //echo $_REQUEST["curr"];
      }
      else {
        # envia o usuário de volta para 
        # o form de login
        setcookie('msg', '00', (time() + (2 * 3600)), '/');
        header('location: '.$_REQUEST["curr"]);
        //setcookie('msg', '3', (time() + (2 * 3600)), '/');
      }
    }
    break;
    case 'enviar':{
      header('location: ../signin_action.php?ref='.$_REQUEST["ref"].'&email='.$_REQUEST["forget"]);
    }
    break;
    case 'sair': {
      # envia o usuário para fora do sistema
      # o form de login
      $sess = Sessao::instanciar();
      $sess->set('usuarioSite', null);
      session_write_close();
      header('location: ../');
    }
    break;
  }
}
/*
switch($_REQUEST["enviar"]) {
  case 'enviar':{
    echo "Eviar email de senha";
  }
  break;
}
*/