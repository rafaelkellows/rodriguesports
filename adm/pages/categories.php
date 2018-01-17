
        <div class="title"><h5>Categorias</h5></div>

        <?php
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
            <div id="output"></div>
        
            <!-- Blockquote -->
            <blockquote class="first">
                A seguir, você encontra as Categorias e Subcategorias cadastradas no sistema.<br /> Para <strong>Adicionar</strong> uma categoria nova clique no botão "Inserir Nova Categoria".
            </blockquote>

            <form action="pages/categories_action.php" method="post" id="categoriesForm" class="mainForm">
                <div class="aligncenter first">
                    <a href="javascript:void(0);" title="" class="btnIconLeft mr10 mt5 add_category"><img src="images/icons/dark/imagesList.png" alt="" class="icon" /><span>Inserir Nova Categoria</span></a>
                </div>         

                <fieldset>
                    <input type="hidden" name="cid" value="0" />
                    <input type="hidden" name="sid" value="0" />
                    <input type="hidden" name="nvg" value="" />
                    <input type="hidden" name="chn" value="0" />
                    <input type="hidden" name="title" value="" />
                    <div class="widgets categories">
                        <div class="widget first">
                        <?php
                            $oConn = New Conn();
                            $oSlctCats = $oConn->SQLselector("*","categories","","name");
                            if ($oSlctCats->rowCount() > 0) {
                                while ( $cat = $oSlctCats->fetch(PDO::FETCH_ASSOC) ) {
                                    echo '<div class="head normal">';
                                    echo '  <h5><input id="cat_'.$cat['id'].'" disabled name="category" type="text" value="'.$cat['name'].'" /></h5>';
                                    echo '  <div class="actions">';
                                    echo '      <a href="javascript:void(0);" class="add_subcategory" title="Adicionar"><img src="images/icons/topnav/register.png" alt="Adicionar"></a>';
                                    echo '      <a href="javascript:void(0);" class="edit_category" title="Editar"><img src="images/edit.png" alt="Editar"></a>';
                                    echo '      <a href="javascript:void(0);" class="delete_category" title="Excluir"><img src="images/delete.png" alt="Excluir"></a>';
                                    echo '      <a href="javascript:void(0);" class="save_category" title="Salvar"><img src="images/ok.png" alt="Salvar"></a>';
                                    echo '  </div>';
                                    echo '</div>';
                                    echo '<div class="body">';

                                    $oSlctSubs = $oConn->SQLselector("*","subcategories",'cid='.$cat['id'],'name');
                                    if ($oSlctSubs->rowCount() > 0) {
                                        echo '<div class="widget acc nomargin">';
                                        while ( $subcat = $oSlctSubs->fetch(PDO::FETCH_ASSOC) ) {
                                            echo '<div class="head">';
                                            echo '  <h5><input id="subcat_'.$subcat['id'].'" disabled name="subcategory" type="text" value="'.$subcat['name'].'" /></h5>';
                                            echo '  <div class="actions">';
                                            echo '      <a href="javascript:void(0);" class="edit_subcategory" title="Editar"><img src="images/edit.png" alt="Editar"></a>';
                                            echo '      <a href="javascript:void(0);" class="delete_subcategory" title="Excluir"><img src="images/delete.png" alt="Excluir"></a>';
                                            echo '      <a href="javascript:void(0);" class="save_subcategory" title="Salvar"><img src="images/ok.png" alt="Salvar"></a>';
                                            echo '  </div>';
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                    }else{
                                        echo  'Não há subcategoria cadastrada. Clique no ícone + para adicionar.';
                                    }
                                    echo '</div>';
                                }
                            }
                        ?>
                        </div>
                    </div>   
                </fieldset>

                <!--div class="aligncenter first">
                    <a href="javascript:void(0);" title="" class="btnIconLeft mr10 mt5 add_category"><img src="images/icons/dark/imagesList.png" alt="" class="icon" /><span>Inserir Nova Categoria</span></a>
                </div-->         

            </form>             
