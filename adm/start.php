<?php 
    require_once 'syslogin/usuario.php';
    require_once 'syslogin/autenticador.php';
    require_once 'syslogin/sessao.php';
     
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
            include 'pages/contacts.php';
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
