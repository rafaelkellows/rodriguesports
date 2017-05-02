<?php
    $oConn = New Conn();
    if( isset($_GET["pid"]) ){
        $all = $oConn->SQLselector("*","produtos","id='".$_GET["pid"]."'",'');
        $row = $all->fetch(PDO::FETCH_ASSOC);
        $hiddenVal = 'banner'; 
        $btValue = 'Salvar Dados';
        $blockquoteValue = 'Produto criado em '.date_format(date_create($row['created']), 'd/m/y').' às '.date_format(date_create($row['created']), 'G:ia').' e alterado em '.date_format(date_create($row['modified']), 'd/m/y').' às '.date_format(date_create($row['modified']), 'G:ia').'.';
    }else{
        $row = (!isset($_GET["src"]) ? 0 : Array ( 'id' => 0, 'alt' => $_GET["alt"],'title' => $_GET["title"], 'description' => $_GET["description"], 'link' => $_GET["link"], 'target' => $_GET["target"], 'align' => $_GET["align"], 'status' => $_GET["status"] ) );
        $hiddenVal = 'new_banner';
        $btValue = 'Inserir Dados';
        $blockquoteValue = '<strong>Olá</strong>, preencha o formulário abaixo corretamente.';
    }
    $submitReturn = (!isset($_GET["msg"]) ? -1 : $_GET["msg"]);
?>
        <div class="title"><h5>Produtos - Item</h5></div>
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
                    echo '  <p><strong>FALHOU: </strong>Este banner já foi cadastrado. Por favor, preencha com novos dados.</p>';
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
        <!--form action="" id="valid" class="mainForm"-->
        <form action="pages/item_action.php" method="post" class="mainForm" id="productUploadForm">
            <fieldset>
                <div class="widget first">    
                    <div class="head"><h5 class="iImageList">Dados do Produto</h5></div>
                    
                    <input type="hidden" name="nvg" value="<?php print $hiddenVal; ?>" />
                    <input type="hidden" name="bid" value="<?php print $row['id']; ?>" />

                    <div class="rowElem">
                        <label style="width:auto">Imagens cadastradas: <!--br><em style="font-size:11px;">certifique-se de que a imagem tenha pelo menos 300x300 de dimensão para manter a proporção e não haver espaços.</em--></label>
                        <div id="bannerPreview" class="pics preview products" style="text-align: center;">
                            <ul>
                            <?php 
                                $oSlctImages = $oConn->SQLselector("*","galeria",'pid = '.$_GET["pid"],'');
                                if ($oSlctImages->rowCount() > 0) {
                                    while ( $row = $oSlctImages->fetch(PDO::FETCH_ASSOC) ) {
                                        echo '<li>';
                                        echo '  <a href="javascript:void(0);"><img src="../'.$row['src'].'" alt=""></a>';
                                        echo '  <div class="actions" style="display: none;"><a href="#" title=""><img src="images/edit.png" alt=""></a><a href="#" title=""><img src="images/delete.png" alt=""></a></div>';
                                        echo '</li>';                                      
                                    }
                                }else{
                                    echo '<li><p style="padding:5px; text-align:center;font-size:11px;">Nenhuma imagem cadastrada.</p></li>';
                                }
                                /*

                                if(isset($row['image'])){ 
                                    echo '<li style="height:300px;"><img src="../'.$row['image'].'" alt="'.$row['title'].'"></li>';
                                }else{
                                    echo '<li><p style="padding:5px; text-align:center;font-size:11px;">Nenhuma imagem cadastrada.</p></li>';
                                }*/
                            ?>
                            </ul> 
                            <div class="fix"></div>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Imagem:</label>
                        <div class="formRight" style="margin: 5px 12px 0 0">
                            <div id="fileUploader">
                                <input type="text" class="validate[required] hide" name="src" id="src" value="<?php print $row['src']; ?>" />
                                <input name="FileInput[]" id="FileInput" type="file" multiple="multiple" />
                                <input type="button"  id="btUploadMultiImages" value="Subir Imagem" />
                                <img src="images/uploader/throbber.gif" id="loading-img" style="display:none;" alt="Aguarde..."/>
                            </div>
                            <div id="uploadProgress"></div>
                            <div id="output"></div>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Título:</label>
                        <div class="formRight">
                            <input type="text" name="title" id="title" value="<?php print $row['title']; ?>" />
                        </div>
                        <div class="fix"></div>
                    </div>
                
                    <div class="rowElem">
                        <label>Descrição:</label>
                        <textarea class="wysiwyg" name="description" id="description" rows="5" cols=""><?php print $row['description']; ?></textarea>                
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Cores disponíveis:</label>
                        <div class="formRight moreFields colors">
                            <ul>
                            <?php 

                                $colors = $oConn->SQLselector("*","colors","pid='".$_GET["pid"]."'",'');
                                if ($colors->rowCount() > 0) {
                                    while ( $row_colors = $colors->fetch(PDO::FETCH_ASSOC) ) {
                                    echo '<li>';
                                    echo '    <input type="text" class="colorpick" id="colorpickerField'.$row_colors['id'].'" value="'.$row_colors['color'].'" /><label for="colorpickerField'.$row_colors['id'].'" class="pick"></label><span style="background-color:#'.$row_colors['color'].'">&nbsp;</span>';
                                    echo '</li>';
                                    echo '<li class="sep"><a class="remove" href="javascript:void(0);"><img src="images/icons/dark/close.png" alt="Remover cor" /></a></li>';
                                    echo '<li class="line">&nbsp;</li>';
                                    }
                                }else{
                                    echo '<li>';
                                    echo '    <input type="text" class="colorpick" id="colorpickerField" value="" /><label for="colorpickerField" class="pick"></label>';
                                    echo '</li>';
                                }
                            ?>
                                <li class="sep"><a class="add" href="javascript:void(0);"><img src="images/icons/dark/add.png" alt="Adicionar mais cores" /></a></li>
                            </ul>
                            
                            
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Tamanho/Capacidade:</label>
                        <div class="formRight">
                            <input type="text" style="width:15%" name="title" id="title" value="<?php print $row['size']; ?>" /> <span style="font-size:11px;"><strong>Use:</strong> ml, P, M, G, GG, XG e números inteiros ou deixe em branco para tamanho Único</span>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Dimensões:</label>
                        <div class="formRight moreFields">
                            <ul>
                                <li><input type="text" name="comprimento" maxlength="6" value="<?php print $row['comprimento']; ?>" /></li>
                                <li class="sep">x</li>
                                <li><input type="text" name="largura" maxlength="6" value="<?php print $row['largura']; ?>" /></li>
                                <li class="sep">x</li>
                                <li><input type="text" name="profundidade" maxlength="6" value="<?php print $row['profundidade']; ?>" /></li>
                                <li><span style="font-size:11px;">Comprimento x Largura x Profundidade</span></li>
                            </ul>

                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Raio:</label>
                        <div class="formRight moreFields onlyNums">
                            <ul>
                                <li><input type="text" name="raio" maxlength="6" value="<?php print $row['raio']; ?>"></li>
                                <li class="sep">x</li>
                                <li><input type="text" name="height" maxlength="6" value="<?php print $row['height']; ?>"></li>
                                <li><span style="font-size:11px;">Raio Maior x Altura</span></li>
                            </ul>

                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Peso:</label>
                        <div class="formRight">
                            <input type="text" style="width:15%" name="title" id="title" value="<?php print $row['weight']; ?>" /><span style="font-size:11px;"> em gramas (gr)</span>
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
                    echo '<input type="button" value="Excluir Produto" class="redBtn floatright deleteBanner first" />';
            ?>
        </form>   
      
                
