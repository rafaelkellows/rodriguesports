        <div class="title"><h5>Produtos - Itens</h5></div>
        <?php
            $oConn = New Conn();
            $ativosTMP = $oConn->SQLselector("*","produtos","status = 1",""); 
            $inativosTMP = $oConn->SQLselector("*","produtos","status = 0",""); 
            $submitReturn = (!isset($_GET["msg"]) ? -1 : $_GET["msg"]);
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
                    echo '  <p><strong>FALHOU: </strong>Este banner já foi cadastrado. Por favor, preencha com novos dados.</p>';
                    echo '</div>';
                    break;
                
                default:
                    break;
            }
        ?>
        <div class="stats">
            <ul>
                <li><a href="#" class="count grey" title=""><?php print $ativosTMP->rowCount(); ?></a><span><?php if( $ativosTMP->rowCount() > 1 ){ echo "Itens ativos"; }else{ echo "Item ativo"; } ?></span></li>
                <li class="last"><a href="#" class="count grey" title=""><?php print $inativosTMP->rowCount(); ?></a><span><?php if( $inativosTMP->rowCount() > 1 ){ echo "Itens inativos"; }else{ echo "Item inativo"; } ?></span></li>
            </ul>
            <div class="fix"></div>
        </div>

        <!-- Blockquote -->
        <blockquote class="first">
            Clique no ícone <img src="images/icons/dark/pencil.png" alt="" style="display:inline-block; vertical-align:middle;" /> ou título do item para editá-lo ou<br>no botão "Inserir Novo Produto" ao final da página para adicionar um novo. 
        </blockquote>
        <div class="aligncenter first">
            <a href="page.php?nvg=item" title="" class="btnIconLeft mr10 mt5"><img src="images/icons/dark/postcard.png" alt="" class="icon" /><span>Inserir Novo Produto</span></a>
        </div>
        <form action="pages/banner_action.php" method="post" id="bannersList" class="mainForm">
            <input type="hidden" name="nvg" value="" />
            <input type="hidden" name="bid" value="" />
            <input type="hidden" name="ref" value="banners" />
            <fieldset>
                <div id="productsList" class="table first">
                    <div class="head"><h5 class="iFrames">Lista de Produtos cadastrados</h5></div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Categoria</th>
                                <th>Subcategoria</th>
                                <th>Preço (R$)</th>
                                <th>Modificado em</th>
                                <th>Status</th>
                                <th>--</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $oSlct = $oConn->SQLselector("*","produtos","","modified desc"); 

                            if ($oSlct->rowCount() > 0) {
                                while ( $row = $oSlct->fetch(PDO::FETCH_ASSOC) ) {
                                echo '<tr class="gradeA">';
                                echo '    <td class="center">'.$row["id"].'</td>';
                                echo '    <td><a href="page.php?nvg=item&pid='.$row['id'].'">'.$row["title"].'</a></td>';
                                if( $row["cid"] != 0 ){
                                    $cat = $oConn->SQLselector("*","categories","id ='".$row["cid"]."'","");    
                                    echo '    <td class="center">'.( ( $cat->rowCount() > 0 ) ? $cat->fetch(PDO::FETCH_ASSOC)["name"] : ' --- ' ).'</td>';
                                }else{
                                    echo '    <td class="center"> ---- </td>';
                                }
                                if( $row["sid"] != 0 ){
                                    $subcat = $oConn->SQLselector("*","subcategories","id ='".$row["sid"]."' AND cid ='".$row["cid"]."'","");
                                    echo '    <td class="center">'.( ( $subcat->rowCount() > 0 ) ? $subcat->fetch(PDO::FETCH_ASSOC)["name"] : ' --- ' ).'</td>';
                                }else{
                                    echo '    <td class="center"> ---- </td>';
                                }                                
                                echo '    <td class="center">'.$row['max_price'].'</td>';
                                echo '    <td class="center">'.date_format(date_create($row['modified']), 'd/m/y').'</td>';
                                echo '    <td class="center'.($row['status'] == 1 ? ' green' : ' red').'">'.($row['status'] == 1 ? 'ativo' : 'inativo').'</td>';
                                echo '    <td class="center"><a href="page.php?nvg=item&pid='.$row['id'].'"><img src="images/icons/dark/pencil.png" alt="" style="display:inline-block; vertical-align:middle;" /></a></td>';
                                echo '    <td class="center"><a href="pages/item_action.php?nvg=delete_product&pid='.$row['id'].'"><img src="images/icons/dark/close.png" alt="" style="display:inline-block; vertical-align:middle;" /></a></td>';
                                echo '</tr>';
                                }
                            }else{
                                "Não há Banner(s) cadastrado(s)!";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </form>
        <div class="aligncenter first">
            <a href="page.php?nvg=item" title="" class="btnIconLeft mr10 mt5"><img src="images/icons/dark/postcard.png" alt="" class="icon" /><span>Inserir Novo Produto</span></a>
        </div>
        