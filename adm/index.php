<?php 
    session_start();
    session_destroy(); 
    include 'inc/head.php';
?>
<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="backTo"><a href="http://www.spatula.com.br" title=""><img src="images/icons/topnav/mainWebsite.png" alt="" /><span>Main website</span></a></div>
            <div class="userNav">
                <ul>
                    <li><a href="mailto:rafaelkellows@hotmail.com" title=""><img src="images/icons/topnav/contactAdmin.png" alt="" /><span>Contate o Administrador</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Login form area -->
<div class="loginWrapper">
	<div class="loginLogo"><img src="../images/logoSpatula.png" alt="" /></div>
    <div class="loginPanel">
        <div class="head"><h5 class="iUser">Login</h5></div>
        <form action="syslogin/controle.php" method="post" target="_self" id="valid" class="mainForm">
            <fieldset>
                <div class="loginRow noborder">
                    <label for="req1">Login:</label>
                    <div class="loginInput"><input type="text" id="login" name="login" class="validate[required]" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <label for="req2">Senha:</label>
                    <div class="loginInput"><input type="password" id="password" name="password" class="validate[required]" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <!--div class="rememberMe"><input type="checkbox" id="check2" name="chbox" /><label>Lembre-me</label></div-->
                    <input type="submit" id="acao" name="acao" value="entrar" class="submitForm" />
                    <div class="fix"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<!-- Footer -->
<?php
    include 'inc/footer.php';
?>

</body>
</html>
