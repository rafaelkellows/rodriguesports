           <div class="title"><h5>Bem-vindo!</h5></div> 
            <!-- Blockquote -->
            <blockquote class="first">
                <strong><?php print $usuario->getName(); ?></strong>,</span> seja bem-vindo ao Sistema de Gerencimento do site Spatula.<br>
                Seu último acesso foi em <?php print $usuario->getVisited(); ?>.<br>
            </blockquote>
            <!-- Inline buttons with icons --> 
            <div class="widget first">
                <div class="head"><h5 class="iImage2">Acesso rápido</h5></div>
                <div class="body aligncenter">
                    <a href="page.php?nvg=user" title="" class="btnIconLeft mr10 mt5"><img src="images/icons/dark/user.png" alt="" class="icon" /><span>Inserir Novo Usuário</span></a>
                    <a href="#" title="" class="btnIconLeft mr10 mt5"><img src="images/icons/dark/image2.png" alt="" class="icon" /><span>Inserir Novo Banner</span></a>
                    <a href="#" title="" class="btnIconLeft mr10"><img src="images/icons/dark/expose.png" alt="" class="icon" /><span>Inserir Novo Produto  </span></a>
                </div>
            </div>