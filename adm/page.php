<?php 
    require_once 'syslogin/usuario.php';
    require_once 'syslogin/autenticador.php'; 
    require_once 'syslogin/sessao.php';
    require_once 'connector.php'; 
     
    $aut = Autenticador::instanciar();
     
    $usuario = null;
    if ($aut->esta_logado()) {
        $usuario = $aut->pegar_usuario();
    }
    else {
        $aut->expulsar();
}
    include 'inc/head.php';
?>
<body>

    <!-- Top navigation bar -->
    <?php 
        include 'inc/top_nav.php';
    ?>
    <!-- Header -->
    <?php 
        include 'inc/header.php';
    ?>

    <!-- Content wrapper -->
    <div class="wrapper">
    	<!-- Left navigation -->
        <?php 
            include 'inc/left_nav.php';
        ?>
    
        <!-- Content -->
        <div class="content">
        <?php
            switch ( $_GET["nvg"] ) {
                case 'home':
                    include 'pages/home.php';
                    break;
                
                case 'users':
                    include 'pages/users.php';
                    break;
                
                case 'user':
                    include 'pages/user.php';
                    break;
                
                case 'user_action':
                    include 'pages/user_action.php';
                    break;
                
                case 'banners':
                    include 'pages/banners.php';
                    break;
                
                case 'banner':
                    include 'pages/banner.php';
                    break;
                
                case 'categories':
                    include 'pages/categories.php';
                    break;
                
                case 'prod_destaque':
                    include 'pages/prod_destaque.php';
                    break;
                
                case 'itens':
                    include 'pages/itens.php';
                    break;

                case 'item':
                    include 'pages/item.php';
                    break;
                
                default:
                    include 'pages/404.php';
                    break;
            }
        ?>
        </div>
        <div class="fix"></div>
    </div>

    <!-- Footer -->
    <?php 
        include 'inc/footer.php';
    ?>
</body>
</html>
