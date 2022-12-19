
<header class="menu-admin">
    <nav >
        <?php
            if(!isset($_SESSION['id']))
                {
                  ?>
                    <h1 class="logo-ad">
                            All engineering
                    </h1>
                    <ul class="menu-liens-ad">
                        <li>
                            <a href="fadmin/article">Articles</a>
                        </li>
                        <li>
                            <a href="fadmin/learn">Apprendre</a>
                        </li>
                        <li>
                            <a href="fadmin/">Services</a>
                        </li>
                        <li>
                            <a href="">Forum</a>
                        </li>
                        <li>
                            <a href="connexion">Connexion</a>
                        </li>
                        <li>
                            <a href="inscription">Inscription</a>
                        </li>
                    </ul>
        <?php
                }else{
                ?>
                <h1 class="logo-ad">
                    <a href="QWggfasYtTrFPmmnbh347hHggjh-GFagtftf-AGttfhjtqqq-15552a@@@@@-qwwwe">
                            All engineering
                    </a>
                    </h1>
                    <ul class="menu-liens-ad">
                        <li>
                            <a href="acces-denied-you-have-sommething-to-acces-somewhere-ncneubaksbc">Articles</a>
                        </li>
                        <li>
                            <a href="creer-cours">Creer Cours</a>
                        </li>
                        <li>
                            <a href="creer-lecon">Creer Lecon</a>
                        </li>
                        <li>
                            <a href="services">Services</a>
                        </li>
                        <li>
                            <a href="fadmin/">Forum</a>
                        </li>
                        <li>
                            <a href="deconnexion">Deconnexion</a>
                        </li>
                    </ul>
        <?php }?>

        </nav>
    </header>