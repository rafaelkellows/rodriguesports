<?php
    $oConn = New Conn();
    if( isset($_GET["bid"]) ){
        $all = $oConn->SQLselector("*","banners","id='".$_GET["bid"]."'",'');
        $row = $all->fetch(PDO::FETCH_ASSOC);
        $hiddenVal = 'banner'; 
        $btValue = 'Salvar Dados';
        $blockquoteValue = 'Banner criado em '.date_format(date_create($row['created']), 'd/m/y').' às '.date_format(date_create($row['created']), 'G:ia').' e alterado em '.date_format(date_create($row['modified']), 'd/m/y').' às '.date_format(date_create($row['modified']), 'G:ia').'.';
    }else{
        $row = (!isset($_GET["src"]) ? 0 : Array ( 'id' => 0, 'alt' => $_GET["alt"],'title' => $_GET["title"], 'description' => $_GET["description"], 'link' => $_GET["link"], 'target' => $_GET["target"], 'align' => $_GET["align"], 'status' => $_GET["status"] ) );
        $hiddenVal = 'new_banner';
        $btValue = 'Inserir Dados';
        $blockquoteValue = '<strong>Olá</strong>, preencha o formulário abaixo corretamente.';
    }
    $submitReturn = (!isset($_GET["msg"]) ? -1 : $_GET["msg"]);
?>
        <div class="title"><h5>Banner</h5></div>
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
        <form action="pages/banner_action.php" method="post" class="mainForm" id="bannerUploadForm">
            <fieldset>
                <div class="widget first">    
                    <div class="head"><h5 class="iImage2">Dados do Banner</h5></div>
                    
                    <input type="hidden" name="nvg" value="<?php print $hiddenVal; ?>" />
                    <input type="hidden" name="bid" value="<?php print $row['id']; ?>" />

                    <div class="rowElem">
                        <label style="width:auto">Pré-visualização do Banner: <br><em style="font-size:11px;">certifique-se de que o banner tenha pelo menos 920x340 de dimensão para manter a proporção e não haver espaços.</em></label>
                        <div id="bannerPreview" class="pics preview">
                            <ul>
                            <?php 
                                if(isset($row['src'])){ 
                                    echo '<li><img src="../'.$row['src'].'" alt="'.$row['alt'].'"></li>';
                                }else{
                                    echo '<li><p style="padding:5px; text-align:center;font-size:11px;">Nenhuma imagem cadastrada.</p></li>';
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
                                <input type="text" class="validate[required] hide" name="src" id="src" value="<?php print $row['src']; ?>" />
                                <input name="FileInput" id="FileInput" type="file" />
                                <input type="button"  id="btUploadImage" value="Subir Imagem" />
                                <img src="images/uploader/throbber.gif" id="loading-img" style="display:none;" alt="Aguarde..."/>
                            </div>
                            <div id="uploadProgress"></div>
                            <div id="output"></div>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>alt:</label>
                        <div class="formRight">
                            <input type="text" name="alt" id="alt" value="<?php print $row['alt']; ?>" />
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
                        <label>Link:</label>
                        <div class="formRight">
                            <input type="text" name="link" id="link" value="<?php print $row['link']; ?>" />
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem noborder">
                        <label>Alvo (target):</label>
                        <div class="formRight">                        
                            <select name="target" style="width:200px">
                                <option <?php if( $row['target'] == "_self" ) print 'selected'; ?> value="_self">_self: mesma página</option>
                                <option <?php if( $row['target'] == "_blank" ) print 'selected'; ?> value="_blank">_blank: nova página</option>
                            </select>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem noborder">
                        <label>Alinhamento (align):</label>
                        <div class="formRight">                        
                            <select name="align" style="width:150px">
                                <option <?php if( $row['align'] == "left" ) print 'selected'; ?> value="left">á esquerda</option>
                                <option <?php if( $row['align'] == "center" ) print 'selected'; ?> value="center">ao centro</option>
                                <option <?php if( $row['align'] == "right" ) print 'selected'; ?> value="right">a direita</option>
                            </select>
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
                    echo '<input type="button" value="Excluir Banner" class="redBtn floatright deleteBanner first" />';
            ?>
        </form>   
      
                
