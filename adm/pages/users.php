<?php
    $pdo = new PDO('mysql:dbname=db_teste;host=db-teste.mysql.uhserver.com', 'spatula', 'Spatul@2016');
    //$pdo = new PDO('mysql:dbname=db_spatula;host=localhost', 'root', '');
    $sql = "select * from usuarios";
    $sqlAtivos = $sql." where status = 1";
    $sqlInativos = $sql." where status = 0";
    $all = $pdo->query($sql);
    $ativosTMP = $pdo->query($sqlAtivos); 
    $inativosTMP = $pdo->query($sqlInativos);

?>                
        <div class="title"><h5>Usuários</h5></div>
        
        <div class="stats">
            <ul>
                <li><a href="#" class="count grey" title=""><?php print $ativosTMP->rowCount(); ?></a><span><?php if( $ativosTMP->rowCount() > 1 ){ echo "Usuários ativos"; }else{ echo "Usuário ativo"; } ?></span></li>
                <li class="last"><a href="#" class="count grey" title=""><?php print $inativosTMP->rowCount(); ?></a><span><?php if( $inativosTMP->rowCount() > 1 ){ echo "Usuários inativos"; }else{ echo "Usuário inativo"; } ?></span></li>
            </ul>
            <div class="fix"></div>
        </div>

        <!-- Blockquote -->
        <blockquote class="first">
            Clique no <strong>Nome do Usuário</strong> abaixo para editá-lo ou no botão "Inserir Novo Usuário" para adicionar um novo. 
        </blockquote>
        <!-- Statistics -->
        <div class="aligncenter first">
            <a href="page.php?nvg=user" title="" class="btnIconLeft mr10 mt5"><img src="images/icons/dark/user.png" alt="" class="icon" /><span>Inserir Novo Usuário</span></a>
        </div>

        <!-- Contact list -->        
        <div class="widget first">
            <div class="head"><h5 class="iUsers">Lista de Usuários Cadastrados</h5></div>
            <div id="myList-nav"></div>
            <ul id="myList">
            <?php
                if ($all->rowCount() > 0) {
                    while ( $row = $all->fetch(PDO::FETCH_ASSOC) ) {
                        echo '<li><a href="page.php?nvg=user&uid='.$row['id'].'">' .$row['name'].'</a>';
                        echo '  <ul class="listData">';
                        echo '      <li><a href="mailto:'.$row['email'].'" title="">'.$row['email'].'</a></li>';
                        echo '       <li><span class="'.($row['status'] == 1 ? 'green' : 'red').'">'.($row['status'] == 1 ? 'ativo' : 'inativo').'</span></li>';
                        echo '       <li><span class="cNote">'.($row['type'] == 1 ? 'Administrador' : 'Usuário').'</span></li>';
                        echo '  </ul>';
                        echo '</li>';
                    }
                }else{
                    "Não há Usuário cadastrado!";
                }
            ?>
            </ul>
        </div>

        <div class="aligncenter first">
            <a href="page.php?nvg=user" title="" class="btnIconLeft mr10 mt5"><img src="images/icons/dark/user.png" alt="" class="icon" /><span>Inserir Novo Usuário</span></a>
        </div>
