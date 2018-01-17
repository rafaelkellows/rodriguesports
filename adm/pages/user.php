<?php
    $oConn = New Conn();
    if( isset($_GET["uid"]) ){
        $all = $oConn->SQLselector("*","usuarios","id='".$_GET["uid"]."'",null);
        $row = $all->fetch(PDO::FETCH_ASSOC);
        $hiddenVal = 'user'; 
        $btValue = 'Salvar Dados';
        $blockquoteValue = '<strong>'.$row['name'].'</strong> foi criado em '.date_format(date_create($row['created']), 'd/m/y').' às '.date_format(date_create($row['created']), 'G:ia').' e alterado em '.date_format(date_create($row['modified']), 'd/m/y').' às '.date_format(date_create($row['modified']), 'G:ia').'.';
    }else{
        $row = (!isset($_GET["email"]) ? 0 : Array ( 'id' => 0, 'name' => $_GET["name"],'email' => $_GET["email"], 'login' => $_GET["login"], 'password' => '', 'type' => $_GET["type"], 'status' => $_GET["status"] ) );
        $hiddenVal = 'new_user';
        $btValue = 'Inserir Dados';
        $blockquoteValue = '<strong>Olá '. $usuario->getName() .'</strong>, preencha o formulário abaixo corretamente.';
    }
    $submitReturn = (!isset($_GET["msg"]) ? -1 : $_GET["msg"]);
?>
    	<div class="title"><h5>Usuário</h5></div>
        
        <?php
            switch ($submitReturn) {
                case 0:
                    echo '<div class="nNote nFailure hideit">';
                    echo '  <p><strong>FALHOU: </strong>Aconteceu algo de errado. Por favor tente novamente.</p>';
                    echo '</div>';
                    break;

                case 1:
                    echo '<div class="nNote nSuccess hideit">';
                    echo '  <p><strong>SUCESSO: </strong>Seus dados foram alterados corretamente.</p>';
                    echo '</div>';
                    break;
                
                case 2:
                    echo '<div class="nNote nSuccess hideit">';
                    echo '  <p><strong>SUCESSO: </strong>Seus dados foram inseridos corretamente.</p>';
                    echo '</div>';
                    break;
                
                case 3:
                    echo '<div class="nNote nSuccess hideit">';
                    echo '  <p><strong>SUCESSO: </strong>os dados foram excluídos corretamente.</p>';
                    echo '</div>';
                    break;
                
                case 4:
                    echo '<div class="nNote nFailure hideit">';
                    echo '  <p><strong>FALHOU: </strong>O e-mail informado já foi utilizado. Por favor, preencha com novos dados.</p>';
                    echo '</div>';
                    break;
                
                default:
                    break;
            }
        ?>

        <!-- Blockquote -->
        <blockquote class="first">
            <?php print $blockquoteValue; ?>
        </blockquote>
        
        <!-- Form with validation -->
        <form action="pages/user_action.php" id="frm_User" method="post" class="mainForm">
            <fieldset>
                <div class="widget first">    
                    <div class="head"><h5 class="iLocked2">Dados Pessoais</h5></div>
                    <input type="hidden" name="nvg" value="<?php print $hiddenVal; ?>" />
                    <input type="hidden" name="uid" value="<?php print $row['id']; ?>" />
                    <div class="rowElem noborder">
                        <label>Nome: </label>
                        <div class="formRight">
                            <input type="text" class="validate[required]" name="name" id="name" value="<?php print $row['name']; ?>" />
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>E-mail:</label>
                        <div class="formRight">
                            <input type="text" class="validate[required,custom[email]]" name="email" id="email" value="<?php print $row['email']; ?>" />
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Login:</label>
                        <div class="formRight">
                            <input type="text" class="validate[required]" name="login" id="login" value="<?php print $row['login']; ?>" />
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Senha:</label>
                        <div class="formRight">
                            <?php 
                                if ($hiddenVal!='user' ||  $usuario->getId() == $row['id']) {
                                    echo '<input type="password" class="validate[required,equals[password2]]" name="password" id="password1" value="'.$row['password'].'" />';
                                }else{
                                    echo '<input type="password" class="validate[required]" name="password" id="password1" value="'.$row['password'].'" />';
                                }                            
                            ?>
                            
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <?php 
                        if ($hiddenVal!='user' ||  $usuario->getId() == $row['id']) {
                    ?>
                    <div class="rowElem">
                        <label>Repita a Senha:</label>
                        <div class="formRight">
                            <input type="password" class="validate[required,equals[password1]]" name="password" id="password2" />
                        </div>
                        <div class="fix"></div>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="rowElem">
                        <label>Tipo:</label> 
                        <div class="formRight">
                            <input type="radio" name="type" <?php if( $row['type'] == 1 ) print 'checked="checked" '; ?> value="1" /><label>Admistrador</label>
                            <input type="radio" name="type" <?php if( $row['type'] == 0 ) print 'checked="checked" '; ?> value="0" /><label>Usuário</label>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Status:</label> 
                        <div class="formRight">
                            <input type="radio" name="status" <?php if( $row['status'] == 1 ) print 'checked="checked" '; ?> value="1" /><label>Ativo</label>
                            <input type="radio" name="status" <?php if( $row['status'] == 0 ) print 'checked="checked" '; ?> value="0" /><label>Inativo</label>
                        </div>
                        <div class="fix"></div>
                    </div>
                    <div class="fix"></div>                        
                </div>
            </fieldset>
            <input type="submit" value="<?php print $btValue; ?>" class="greenBtn submitForm first" />
            <?php 
                if ( isset($row['id']) ) 
                    echo '<input type="button" value="Excluir Usuário" class="redBtn floatright deleteUser first" />';
            ?>
        </form>   
             
