    <div id="topNav">
        <div class="fixed">
            <div class="wrapper"> 
                <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Olá, <?php print $usuario->getName(); ?>!</span></div>
                <div class="userNav">
                    <ul>
                        <li><a href="page.php?nvg=user&uid=<?php print $usuario->getId(); ?>" title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Meu Perfil</span></a></li>
                        <!--li><a href="#" title=""><img src="images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>
                        <li class="dd"><img src="images/icons/topnav/messages.png" alt="" /><span>Messages</span><span class="numberTop">8</span>
                            <ul class="menu_body">
                                <li><a href="#" title="">new message</a></li>
                                <li><a href="#" title="">inbox</a></li>
                                <li><a href="#" title="">outbox</a></li>
                                <li><a href="#" title="">trash</a></li>
                            </ul>
                        </li>
                        <li><a href="#" title=""><img src="images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li-->
                        <li><a href="syslogin/controle.php?acao=sair" title=""><img src="images/icons/topnav/logout.png" alt="Sair" /><span>Sair</span></a></li>
                    </ul>
                </div>
                <div class="fix"></div>
            </div>
        </div>
    </div>
