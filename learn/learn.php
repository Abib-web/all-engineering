<?php
  session_start();
  include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD

  $req_articles = $DB->query("SELECT * FROM cours");
  $req_articles =  $req_articles->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<base href="/All_engineering/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All engineering</title>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/50d8944cef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="tools/breadcrumbs.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/learn.css">
</head>
<body>
    <header>
        <nav class="menu">
            <h1 class="logo">
                All engineering
            </h1>
            <ul class="menu-liens">
                <li>
                    <a href="">Articles</a>
                </li>
                <li>
                    <a href="">Apprendre</a>
                </li>
                <li>
                    <a href="">Services</a>
                </li>
                <li>
                    <a href="">Forum</a>
                </li>
            </ul>
        </nav>


    </header>

    <main class="courses-learn">
            <div class="list-courses">
                <?php
                    foreach($req_articles as $articles)
                        { ?>
                        <div class="each-courses">
                            <a href="cours/<?=$articles['id'] ?>" class="each-courses-link">
                                 <img src="<?= "/All_engineering/images/img-courses/". $articles['id'] . "/" . $articles['img_title']; ?>" alt="">

                            </a>
                            <div class="description">
                                <a href="cours/<?=$articles['id'] ?>" class="each-courses-link">
                                    <h1>
                                        <?= $articles['titre'];?>
                                    </h1>
                                </a>
                                <p>
                                    <?= $articles['descriptions'];?>
                                </p>
                                <a href="cours/<?=$articles['id'] ?>" style="text-decoration: none; color:blue; margin-top: 15px;">
                                    <span >Suivre ce cours</span>
                                </a>
                            </div>

                        </div>
                    <?php } ?>
                <div class="each-courses">
                    <a href="./listes-articles/arduino-tmp.php" >
                        <img src="/All_engineering/images/img-articles/Arduino.jpg" alt="">
                        <h1>
                            Apprendre Arduino
                        </h1>
                    </a>
                </div>
                <div  class="each-courses">
                    <img src="/All_engineering/images/img-articles/py.jpg" alt="">
                    <h1>
                        Apprendre Raspberry
                    </h1>
                </div>
                <div  class="each-courses">
                    <a href="liste-learn/langage-c/">
                        <img src="/All_engineering/images/img-articles/The_C.png" alt="">
                            <h1>
                                Apprendre Langage C
                            </h1>
                    </a>
                </div>
                <div  class="each-courses">
                    <img src="/All_engineering/images/img-articles/binaire.jpg" alt="">
                    <h1>
                        Langage C : Maniulations des bits
                    </h1>
                </div>
                <div  class="each-courses">
                    <img src="/All_engineering/images/img-articles/ffuf_mascot_600.png" alt="">
                    <h1>
                        Comment fonctionne ffuf: Outils de Piratages?
                    </h1>
                </div>
                <div  class="each-courses">
                    <img src="/All_engineering/images/img-articles/1280px-Microchip-Logo.svg.png" alt="">
                    <h1>
                        Apprendre le Pic24
                    </h1>
                </div>
                <div  class="each-courses">
                    <img src="/All_engineering/images/img-articles/kali-terminals.png" alt="">
                    <h1>
                        Introduction a kali linux
                    </h1>
                </div>
                <div  class="each-courses">
                    <img src="/All_engineering/images/img-articles/Onion-Omega-2-Plus-Board-1024x653.png" alt="">
                    <h1>
                        Introduction a Omega Onion
                    </h1>
                </div>
            </div>
    </main>
    <footer class="footer-class">
            <div class="social-media">
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-linkedin"></a>
                <a href="#" class="fa fa-github"></a>
            </div>
            <div class="footer-flex-items">
                    <ul>
                        <li>
                            <h1>
                                <a href="">
                                    Cours
                                </a>
                            </h1>
                        </li>
                        <li>
                            <a href="">
                                Python
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Langage C
                            </a>
                        </li>
                        <li>
                            <a href="">
                                C-sharp
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Javascript
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Arduino
                            </a>
                        </li>
                        <li>
                            <a href="">
                                STM32
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <h1>
                                <a href="">
                                    Services
                                </a>
                            </h1>
                        </li>
                        <li>
                            <a href="">
                                Cours Individuels
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Projets personnels
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <h1>
                                <a href="">
                                    A propos
                                </a>
                            </h1>
                        </li>
                        <li>
                            <a href="">
                                Nous rejoindre
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Nos partenaires
                            </a>
                        </li>
                    </ul>
            </div>
    </footer>
</body>
</html>