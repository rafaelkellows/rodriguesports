        <div class="leftNav">
            <ul id="menu"> 
                <li class="dash"><a href="page.php?nvg=home" title="Início" <?php if ( $_GET["nvg"] == 'home' ) print 'class="active"'; ?>><span>Início</span></a></li>
                <li class="contacts"><a href="javascript:void(0);" title="Usuários" class="exp <?php if ( $_GET["nvg"] == 'users' || $_GET["nvg"] == 'user'  ) print 'active'; ?>"><span>Usuários</span></a>
                    <ul class="sub<?php if ( ($_GET["nvg"] != 'users') && ($_GET["nvg"] != 'user') ) print ' hide'; ?>">
                        <li><a href="page.php?nvg=users"title="">Exibir Lista</a></li>
                        <li><a href="page.php?nvg=user"title="">Adicionar Item</a></li>
                    </ul>
                </li>
                <li class="banners"><a href="javascript:void(0);" title="Banners" class="exp <?php if ( $_GET["nvg"] == 'banners' || $_GET["nvg"] == 'banner'  ) print 'active'; ?>"><span>Banners</span></a>
                    <ul class="sub<?php if ( ($_GET["nvg"] != 'banners') && ($_GET["nvg"] != 'banner') ) print ' hide'; ?>">
                        <li><a href="page.php?nvg=banners"title="">Exibir Lista</a></li>
                        <li><a href="page.php?nvg=banner"title="">Adicionar Item</a></li>
                    </ul>
                </li>
                <li class="categories"><a href="page.php?nvg=categories" title="Categorias" <?php if ( $_GET["nvg"] == 'categories' || $_GET["nvg"] == 'category' ) print 'class="active"'; ?>><span>Categorias</span></a></li>
                <li class="products"><a href="javascript:void(0);" title="Produtos" class="exp <?php if ( $_GET["nvg"] == 'itens' || $_GET["nvg"] == 'item' ) print 'active'; else print 'inactive'; ?>"><span>Produtos</span></a>
                    <ul class="sub<?php if ( $_GET["nvg"] != 'itens' && $_GET["nvg"] != 'item' ) print ' hide'; ?>">
                        <!--li><a href="page.php?nvg=prod_destaque" title="Destaques">Destaques</a></li-->
                        <li><a href="page.php?nvg=itens"title="">Exibir Lista</a></li>
                        <li><a href="page.php?nvg=item"title="">Adicionar Item</a></li>
                    </ul>
                </li>
            </ul>
        </div>