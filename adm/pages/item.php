<?php
    $oConn = New Conn();
    if( isset($_GET["pid"]) ){
        $pid = $_GET["pid"];
        $all = $oConn->SQLselector("*","produtos","id='".$_GET["pid"]."'",'');
        $row = $all->fetch(PDO::FETCH_ASSOC);
        $hiddenVal = 'produto'; 
        $btValue = 'Salvar Dados';
        $blockquoteValue = 'Produto criado em '.date_format(date_create($row['created']), 'd/m/y').' às '.date_format(date_create($row['created']), 'G:ia').' e alterado em '.date_format(date_create($row['modified']), 'd/m/y').' às '.date_format(date_create($row['modified']), 'G:ia').'.';
    }else{
        $pid = 0;
        $row = (!isset($_GET["src"]) ? 0 : Array ( 'id' => 0, 'alt' => $_GET["alt"],'title' => $_GET["title"], 'description' => $_GET["description"], 'link' => $_GET["link"], 'target' => $_GET["target"], 'align' => $_GET["align"], 'status' => $_GET["status"] ) );
        $hiddenVal = 'new_product';
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
                    <input type="hidden" name="pid" value="<?php print $row['id']; ?>" />

                    <div class="rowElem">
                        <label>Título:</label>
                        <div class="formRight">
                            <input type="text" class="validate[required]" name="title" id="title" value='<?php print $row['title']; ?>' />
                        </div>
                        <div class="fix"></div>
                    </div>
                
                    <div class="rowElem">
                        <label>Chamada:</label>
                        <div class="formRight">
                            <textarea class="validate[required]" maxlength="100" name="resume" id="resume" rows="3" cols=""><?php print $row['resume']; ?></textarea>
                            <span style="font-size:11px; padding: 2px;">Digite um resumo de até 100 caracteres.</span>
                        </div>                
                        <div class="fix"></div>
                    </div>
                            
                    <div class="rowElem">
                        <label>Descrição:</label>
                        <!--div class="formRight">
                            <textarea class="wysiwyg validate[required]" name="description" id="description" rows="5" cols=""><?php print $row['description']; ?></textarea>                
                            <textarea class="validate[required]" maxlength="100" name="description" id="description" rows="5" cols=""></textarea>
                            <span style="font-size:11px; padding: 2px;"><strong>Dica de estilo:</strong> Use 'strong/strong' para aplicar <strong>Negrito</strong> no texto e 'em/em' para aplicar <em>Itálico</em>.</span>
                        </div-->                
                        <textarea class="wysiwyg validate[required]" name="description" id="description" rows="5" cols=""><?php print $row['description']; ?></textarea>
                        <span style="font-size:11px; display: inline-block; padding: 10px 2px 2px;"><strong>Importante:</strong> não copie e cole um conteúdo diretamente no editor. Isso pode alterar no resultado final.</span>
                        <div class="fix"></div>
                    </div>
                            
                    <div class="rowElem">
                        <label>Categoria:</label>
                        <div class="formRight">                        
                            <select name="category" class="validate[required]" style="width:200px">
                                <option value="0">Nenhuma</option>

                            <?php 
                                $oSlctCats = $oConn->SQLselector("*","categories",'','');
                                if ($oSlctCats->rowCount() > 0) {
                                    while ( $row_category = $oSlctCats->fetch(PDO::FETCH_ASSOC) ) {
                                        $checked = ($row_category["id"] == $row["cid"]) ? 'selected="selected"' : '';
                                        echo '<option value="'.$row_category["id"].'" '. $checked .'>'.$row_category["name"].'</option>';
                                    }
                                }else{
                                    echo '<option value="0">Nenhuma categoria cadastrada</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Subcategoria:</label>
                        <div class="formRight">                        
                            <?php 
                                $oSlctCats = $oConn->SQLselector("*","categories",'','');
                                $i_cat = 0;
                                if ($oSlctCats->rowCount() > 0) {
                                    while ( $row_category = $oSlctCats->fetch(PDO::FETCH_ASSOC) ) {
                                        echo '<select name="subcategory_'.$row_category['id'].'" style="width:200px">';
                                        $oSlctSubcats = $oConn->SQLselector("*","subcategories",'cid="'.$row_category['id'].'"','');
                                        if ($oSlctSubcats->rowCount() > 0) {
                                            echo '<option value="0">Nenhuma</option>';
                                            while ( $row_subcategory = $oSlctSubcats->fetch(PDO::FETCH_ASSOC) ) {
                                                if( $row_subcategory["id"] == $row["sid"] && $i_cat === 0 ){
                                                    $i_cat = "subcategory_".$row_category["id"];
                                                }
                                                $checked = ($row_subcategory["id"] == $row["sid"]) ? 'selected="selected"' : '';
                                                echo '<option value="'.$row_subcategory["id"].'" '. $checked .'>'.$row_subcategory["name"].'</option>';
                                            }
                                        }else{
                                            echo '<option value="0">Nenhuma subcategoria cadastrada</option>';
                                        }
                                        echo "</select>";
                                    }
                                    echo '<input type="hidden" name="i_subcategory" value="'.$i_cat.'" />';
                                }
                            ?>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label style="width:auto">Imagens cadastradas: </label>
                        <div class="formRight">
                            <input type="radio" name="orderProducts" value="0" /><label>Original</label>
                            <input type="radio" name="orderProducts" value="1" checked="checked" /><label>Miniaturas</label>
                        </div>
                        <div class="fix"></div>
                        <div id="productsPreview" class="pics preview products thumbs" style="text-align: center;">
                            <span style="font-size: 13px; padding-bottom: 0; display: block; padding-bottom: 10px;"><strong>Capa:</strong> selecione uma das imagens abaixo para aparecer como capa do produto.</span>
                            <ul>
                            <?php 
                                $oSlctImages = $oConn->SQLselector("*","galeria",'pid = '.$pid,'id ASC');
                                if ($oSlctImages->rowCount() > 0) {
                                    while ( $row_images = $oSlctImages->fetch(PDO::FETCH_ASSOC) ) {
                                        echo '<li>';
                                        echo '  <input type="hidden" name="gallery[]" value="'.$row_images['src'].'" />';
                                        echo '  <a href="javascript:void(0);"><img src="../'.$row_images['src'].'" alt=""></a>';
                                        echo '  <input type="radio" name="capa" value="'.$row_images['id'].'" '.(( $row['capa'] == $row_images['id'] ) ? 'checked="checked" ' : '').' />'; 
                                        echo '  <div class="actions" style="display: none;"><a class="delete" href="javascript:void(0);" title=""><img src="images/delete.png" alt=""></a></div>';
                                        echo '</li>';                                      
                                    }
                                }else{
                                    echo '<li class="none"><p style="padding:5px; text-align:center;font-size:11px;">Nenhuma imagem cadastrada.</p></li>';
                                }
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
                                <input type="text" class="validate[required] hide" name="src" id="src" value="" />
                                <input name="FileInput" id="FileInput" type="file" />
                                <input type="button"  id="btUploadMultiImages" value="Carregar Imagem" />
                                <img src="images/uploader/throbber.gif" id="loading-img" style="display:none;" alt="Aguarde..."/>
                            </div>
                            <div id="uploadProgress"></div>
                            <div id="output"></div>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Cores disponíveis:</label>
                        <div class="formRight moreFields colors">
                            <ul>
                            <?php 
                                $colors = $oConn->SQLselector("*","colors","pid='".$pid."'",'id ASC');
                                if ($colors->rowCount() > 0) {
                                    while ( $row_colors = $colors->fetch(PDO::FETCH_ASSOC) ) {
                                    echo '<li>';
                                    echo '  <input type="hidden" name="colors[]" value="'.$row_colors['color'].'" />';
                                    echo '  <input type="text" name="color" disabled value="'.$row_colors['color'].'" />';
                                    echo '  <span style="background-color:#'.$row_colors['color'].'">&nbsp;</span>';
                                    /*echo '  <select name="lbl_color">';
                                    echo '      <option value="0">Cores adicionadas</option>';
                                    $slc_color = $oConn->SQLselector("*","colors","","");
                                    while ( $row_slc_color = $slc_color->fetch(PDO::FETCH_ASSOC) ) {
                                        if(!empty($row_slc_color['label'])){
                                            echo '<option value="'.$row_slc_color['color'].'">'.$row_slc_color['label'].'</option>';
                                        }
                                    }
                                    echo '  </select>';
                                    echo '  <input class="color_label" type="text" placeholder="Defina aqui um nome para essa cor" name="color_label[]" value="'.$row_colors['label'].'" />';*/
                                    echo '</li>';
                                    echo '<li class="sep"><a class="remove" href="javascript:void(0);"><img src="images/icons/dark/close.png" alt="Remover cor" /></a></li>';
                                    echo '<li class="line">&nbsp;</li>';
                                    }
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
                            <input type="text" style="width:15%" name="size" id="size" value="<?php print $row['size']; ?>" /> <span style="font-size:11px;"><strong>Use:</strong> ml, P, M, G, GG, XG e números inteiros ou deixe em branco para tamanho Único</span>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Dimensões:</label>
                        <div class="formRight moreFields">
                            <ul>
                                <li><input type="text" name="length" maxlength="6" value="<?php print $row['length']; ?>" /></li>
                                <li class="sep">x</li>
                                <li><input type="text" name="width" maxlength="6" value="<?php print $row['width']; ?>" /></li>
                                <li class="sep">x</li>
                                <li><input type="text" name="depth" maxlength="6" value="<?php print $row['depth']; ?>" /></li>
                                <li><span style="font-size:11px;">Comprimento x Largura x Profundidade (em cm)</span></li>
                            </ul>

                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Especificações:</label>
                        <div class="formRight moreFields">
                            <ul>
                                <li><input type="text" name="radius" maxlength="6" value="<?php print $row['radius']; ?>"></li>
                                <li class="sep">x</li>
                                <li><input type="text" name="height" maxlength="6" value="<?php print $row['height']; ?>"></li>
                                <li><span style="font-size:11px;">Diâmetro x Altura (em cm)</span></li>
                            </ul>

                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Peso:</label>
                        <div class="formRight">
                            <input type="text" style="width:15%" name="weight" id="weight" value="<?php print $row['weight']; ?>"> <span style="font-size:11px; margin-top: 4px; display: block; float: right; width: 420px;">O PagSeguro utiliza o peso total dos produtos para o cálculo do frete. Mínimo 0,300Kg e Máximo 10Kg por cada item. <a href="https://pagseguro.uol.com.br/para_seu_negocio/envio-facil.jhtml#rmcl" target="_blank">Veja + detalhes</a></span>
                        </div>
                        <div class="fix"></div>
                    </div>


                    <div class="rowElem">
                        <label>Valor Unitário:</label>
                        <div class="formRight">
                            <input type="text" style="width:15%" name="max_price" id="max_price" value="<?php print $row['max_price']; ?>" /> <span style="font-size:11px;">Ex. 10,00 (use vírgula)</span>
                        </div>
                        <div class="fix"></div>
                    </div>

                     <!--div class="rowElem">
                        <label>Valor Mínimo:</label>
                        <div class="formRight">
                            <input type="text" style="width:15%" name="min_price" id="min_price" value="<?php print $row['min_price']; ?>" /><span style="font-size:11px;"> maior que 1 unidade</span>
                        </div>
                        <div class="fix"></div>
                    </div-->
                    
                   <div class="rowElem" style="visibility: hidden; overflow: hidden; height: 0; padding:0;">
                        <label>Código de Compra:</label>
                        <div class="formRight">
                            <input type="text" name="prod_code" id="prod_code" value="<?php print $row['prod_code']; ?>" /><span style="font-size:11px;"> código cadastrado no PagSeguro</span>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Destaque:</label> 
                        <div class="formRight">
                            <input type="radio" name="highlight" <?php if( $row['highlight'] == 1 ) print 'checked="checked" '; ?> value="1" /><label>Sim</label>
                            <input type="radio" name="highlight" <?php if( $row['highlight'] == 0 ) print 'checked="checked" '; ?> value="0" /><label>Não</label><span style="font-size:11px; margin-top: 4px; display: block;">Marque SIM para o produto aparecer no carrossel da home abaixo do banner</span>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Combina com você:</label> 
                        <div class="formRight">
                            <input type="radio" name="combine" <?php if( $row['combine'] == 1 ) print 'checked="checked" '; ?> value="1" /><label>Sim</label>
                            <input type="radio" name="combine" <?php if( $row['combine'] == 0 ) print 'checked="checked" '; ?> value="0" /><label>Não</label><span style="font-size:11px; margin-top: 4px; display: block;">Marque SIM para o produto aparecer no carrossel do "Produtos que combinam com você" de cada categoria</span>
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
                    echo '<input type="button" value="Excluir Produto" class="redBtn floatright deleteProduct first" />';
            ?>
        </form>   
      
                
