        <div class="title"><h5>Banners</h5></div>
        <?php
            $oConn = New Conn();
            $ativosTMP = $oConn->SQLselector("*","banners","status = 1",""); 
            $inativosTMP = $oConn->SQLselector("*","banners","status = 0",""); 
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
                <li><a href="#" class="count grey" title=""><?php print $ativosTMP->rowCount(); ?></a><span><?php if( $ativosTMP->rowCount() > 1 ){ echo "Banners ativos"; }else{ echo "Banner ativo"; } ?></span></li>
                <li class="last"><a href="#" class="count grey" title=""><?php print $inativosTMP->rowCount(); ?></a><span><?php if( $inativosTMP->rowCount() > 1 ){ echo "Banners inativos"; }else{ echo "Banner inativo"; } ?></span></li>
            </ul>
            <div class="fix"></div>
        </div>

        <!-- Blockquote -->
        <blockquote class="first">
            Clique no ícone <img src="images/icons/dark/pencil.png" alt="" style="display:inline-block; vertical-align:middle;" /> no canto inferior direito de cada imagem para editá-lo ou<br>no botão "Inserir Novo Banner" para adicionar um novo. 
        </blockquote>
        <div class="aligncenter first">
            <a href="page.php?nvg=banner" title="" class="btnIconLeft mr10 mt5"><img src="images/icons/dark/image2.png" alt="" class="icon" /><span>Inserir Novo Banner</span></a>
        </div>
        <form action="pages/banner_action.php" method="post" id="bannersList" class="mainForm">
            <input type="hidden" name="nvg" value="" />
            <input type="hidden" name="bid" value="" />
            <input type="hidden" name="ref" value="banners" />
            <fieldset>
            <div class="widget first">
                <div class="head"><h5 class="iImages2">Lista de Banners Cadastrados</h5></div>
                <div class="rowElem noborder bb">
                    <label>Filtar por Status:</label> 
                    <div class="formRight">
                        <input type="radio" name="status" value="all" checked="checked" /><label>Todos</label>
                        <input type="radio" name="status" value="1" /><label>Ativos</label>
                        <input type="radio" name="status" value="0" /><label>Inativos</label>
                    </div>
                    <div class="fix"></div>
                </div>
                <div class="rowElem noborder bb">
                    <label>Ver em miniatura:</label> 
                    <div class="formRight">
                        <input type="radio" name="orderBanners" value="1" /><label>Ativar</label>
                        <input type="radio" name="orderBanners" value="0" checked="checked" /><label>Desativar</label>
                    </div>
                    <div class="fix"></div>
                </div>
                <div class="pics">
                   <ul>
                    <?php
                        //$oConn = New Conn();
                        $oSlct = $oConn->SQLselector("*","banners","","created desc"); 

                        if ($oSlct->rowCount() > 0) {
                            while ( $row = $oSlct->fetch(PDO::FETCH_ASSOC) ) {
                            echo '<li class="status_'.$row['status'].'">'; 
                            echo '    <a href="#" title="">';
                            echo '        <div class="itemContent '.$row['align'].'">';
                            echo '            <strong>'.$row['title'].'</strong>';
                            echo '            <span>'.$row['description'].'</span>';
                            if( !empty($row['link']) ){
                                echo '          <em>ver mais</em>';
                            }
                            echo '        </div>';
                            echo '        <img src="../'.$row['src'].'" alt="'.$row['alt'].'" />';
                            echo '    </a>';
                            /*echo '    <select class="bannerOrderBy" name="select2" style="width:55px">';
                            for($x = 1; $x <= $oSlct->rowCount(); $x++){
                                $currPos = ( $x == $row['pos']) ? 'selected="selected"' : '' ;
                                echo '        <option value="opt'.$x.'" '.$currPos.'>'.$x.'</option>';
                            }
                            echo '    </select>';*/
                            echo '    <div class="actions">';
                            echo '        <a href="page.php?nvg=banner&bid='.$row['id'].'" class="editBanner" title=""><img src="images/edit.png" alt="" /></a>';
                            echo '        <a href="javascript:void(0);" bid="'.$row['id'].'" class="deleteBanner" title=""><img src="images/delete.png" alt="" /></a>';
                            echo '    </div>';
                            echo '</li>';
                            }
                        }else{
                            "Não há Banner(s) cadastrado(s)!";
                        }
                    ?>
                   </ul> 
                <div class="fix"></div>
               </div>
                   
            </div>

            </fieldset>
        </form>

        <div class="aligncenter first">
            <a href="page.php?nvg=banner" title="" class="btnIconLeft mr10 mt5"><img src="images/icons/dark/image2.png" alt="" class="icon" /><span>Inserir Novo Banner</span></a>
        </div>

        