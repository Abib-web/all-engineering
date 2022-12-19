<?php
    session_start();
    include('../bd/connexionDB.php');

    // La requete pour avoir la listes des articles
    $req_blog = $DB->query("SELECT b.*, u.prenoms, u.nom, c.titre as titre_cat
    FROM blog b
    LEFT JOIN utilisateurs u ON u.id = b.id_user
    LEFT JOIN categorie c ON c.id_categorie = b.id_categorie
    ORDER BY b.date_creation DESC");

    $req_blog = $req_blog->fetchAll();

    function checkCategorieTitle(string $title){

        $retour = 0;
        if($title === "electronique"){
            $retour =  1;
        } elseif($title === "Informatique"){
            $retour = 2;
        }
        return $retour;
    }
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
    <link rel="stylesheet" href="farticles/style/style.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<?php include_once('../tools/nav-bar.php') ;?>
    <main>

            <div class="list-articles">
            <?php
        foreach($req_blog as $article){
        ?>
                <div >
                    <a href="article/<?=$article['id'] ?>">
                    <?php
                        if(file_exists("../images/img-articles/". $article['id'] . "/" . $article['img_title'])){ ?>
                            <img src="<?= "/All_engineering/images/img-articles/". $article['id'] . "/" . $article['img_title']; ?>" alt="">
                    <?php }
                        else{
                            $cat_n = checkCategorieTitle($article['titre_cat']);

                                if( $cat_n === 1){

                                ?>
                                        <img src="<?= "/All_engineering/images/img-articles/default/electronique/" . rand(1,8) .".jpg" ?>" alt="">
                                <?php } elseif($cat_n === 2){  ?>
                                        <img src="<?= "/All_engineering/images/img-articles/default/informatique/" . rand(1,5) .".jpg" ?>" alt="">
                                <?php } ?>
                    <?php } ?>
                        <h1>
                            <?php echo $article['titre'];?>
                        </h1>
                    </a>
                </div>
                <?php
        }
        ?>
                <div class="arduino-temperature-sensor">
                    <a href="./listes-articles/arduino-tmp.php">
                        <img src="images/img-articles/Arduino.jpg" alt="">
                        <h1>
                            Arduino : Le capteur de temperature
                        </h1>
                    </a>
                </div>
                <div class="raspi-blink-led-page">
                    <img src="images/img-articles/py.jpg" alt="">
                    <h1>
                        Raspberry : Allumer un led a partir d'une page web
                    </h1>
                </div>
                <div class="pointer-c">
                    <img src="images/img-articles/The_C.png" alt="">
                    <h1>
                        Langage C: Comprendre le fonctionnement des poiter en c
                    </h1>
                </div>
                <div class="binaire-c">
                    <img src="images/img-articles/binaire.jpg" alt="">
                    <h1>
                        Langage C : Maniulations des bits
                    </h1>
                </div>
                <div class="ffuf">
                    <img src="images/img-articles/ffuf_mascot_600.png" alt="">
                    <h1>
                        Comment fonctionne ffuf: Outils de Piratages?
                    </h1>
                </div>
                <div class="pic-introduction">
                    <img src="images/img-articles/1280px-Microchip-Logo.svg.png" alt="">
                    <h1>
                        Pic24: Programmation de l'affichage LED à 4 digits et 7 segments
                    </h1>
                </div>
                <div class="arduino-humidite-sensor">
                    <img src="images/img-articles/Arduino.jpg" alt="">
                    <h1>
                        Arduino : Le capteur d'humidite
                    </h1>
                </div>
                <div class="kali-linux-starter">
                    <img src="images/img-articles/kali-terminals.png" alt="">
                    <h1>
                        Introduction a kali linux
                    </h1>
                </div>
                <div class="omega-onion starter">
                    <img src="images/img-articles/Onion-Omega-2-Plus-Board-1024x653.png" alt="">
                    <h1>
                        Comment faire un streeming avec Omega Onion?
                    </h1>
                </div>
            </div>
    </main>
    <?php include_once('../tools/footer.php') ;?>

</body>
</html>