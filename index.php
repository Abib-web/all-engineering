<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All engineering</title>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/50d8944cef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>
<body onkeypress="showChar(event);">
<?php include_once('tools/nav-bar.php') ;?>
    <main class="wrapper">
        <article class="articles">
            <div class="lastest-video">
                <h3>
                    Derniers Videos
                </h3>
                <i class="fa-regular fa-hand-back-point-right"></i>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/R-ih_XfrOfQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
                <span>
                    <a href="">
                        Toutes les videos
                    </a>
                </span>
            </div>
            <div class="courses">
                <h1>
                    Les cours offerts
                </h1>
                <div class="courses-flex">
                    <div>
                        <a href="http://">
                            <img src="images/img-courses/C_Sharp.png" alt="" srcset="" width="100px" height="100px">
                        </a>
                    </div>
                    <div>
                        <a href="http://">
                            <img src="images/img-courses/images.jpg" alt="" srcset="" width="100px" height="100px">
                        </a>
                    </div>
                    <div>
                        <a href="http://">
                            <img src="images/img-courses/py.jpg" alt="" srcset="" width="100px" height="100px">
                        </a>
                    </div>
                    <div>
                        <a href="http://">
                            <img src="images/img-courses/raspi.png" alt="" srcset="" width="100px" height="100px">
                        </a>
                    </div>
                    <div>
                        <a href="http://">
                            <img src="images/img-courses/reactjs.png" alt="" srcset="" width="100px" height="100px">
                        </a>
                    </div>
                    <div>
                        <a href="http://">
                            <img src="images/img-courses/stm32.jpg" alt="" srcset="" width="100px" height="100px">
                        </a>
                    </div>
                    <div>
                        <a href="http://">
                            <img src="images/img-courses/The_C.png" alt="" srcset="" width="100px" height="100px">
                        </a>
                    </div>
                    <div>
                        <a href="http://">
                            <img src="images/img-courses/xilinx-amd-logo.jpg" alt="" srcset="" width="100px" height="100px">
                        </a>
                    </div>
                </div>
            </div>
            <div class="lastest-article">
                    <h3>
                        Derniers Articles
                    </h3>
                    <ul>
                        <li>
                            <img src="images/img-articles/Arduino.jpg" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                Allumer un led depuis une page web: Arduino, Javascript
                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/cybersecurity-freepik.jpg" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                La science de la cryptographie
                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/cybersecurity-freepik.jpg" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                La Cybersecurite par quoi commence ?
                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/cybersecurity-freepik.jpg" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                            Comprendre l'algorithme de chiffrement RSA
                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/stm32.jpg" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                Introduction a la carte STM32 NUCLEO-64
                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/682250062.png" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                STM32 NUCLEO-64: Comment utiliser la carte SPI ?
                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/stm32.jpg" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                STM32 NUCLEO-64: Comment utiliser la carte I2C ?                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/kali-terminals.png" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                Fuff: comment recuperer des informations sur un site ?
                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/py.jpg" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                Introduction a Python
                            </a>
                        </li>
                        <li>
                            <img src="images/img-articles/The_C.png" alt="" srcset="" width="50px" height="50px" style="border-radius: 40px ;">
                            <a href="">
                                Introduction au langage c
                            </a>
                        </li>
                    </ul>
            </div>

            <div class="lastest-questions">
                    <h3>
                        Questions
                    </h3>
                    <ul>
                        <li>
                            <a href="">
                                Allumer un led depuis une page web: Arduino, Javascript
                            </a>
                        </li>
                        <li>
                            <a href="">
                                La science de la cryptographie
                            </a>
                        </li>
                        <li>
                            <a href="">
                                La Cybersecurite par quoi commence ?
                            </a>
                        </li>
                        <li>
                            <a href="">
                            Comprendre l'algorithme de chiffrement RSA
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Introduction a la carte STM32 NUCLEO-64
                            </a>
                        </li>
                        <li>
                            <a href="">
                                STM32 NUCLEO-64: Comment utiliser la carte SPI ?
                            </a>
                        </li>
                        <li>
                            <a href="">
                                STM32 NUCLEO-64: Comment utiliser la carte I2C ?                            </a>
                        </li>
                        <li>
                            <a href="">
                                Fuff: comment recuperer des informations sur un site ?
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Introduction a Python
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Introduction au langage c
                            </a>
                        </li>
                    </ul>
            </div>

        </article>
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
<script src="js/script.js"></script>
</html>