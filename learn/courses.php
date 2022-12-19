<?php

  session_start();
  include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
    require_once('../vendor/autoload.php');

  $get_id = (int) trim($_GET['id']);

  if(empty($get_id)){
    header('Location: /blog');
    exit;
  }

  /*********************************************************************
  * Cette requette sql recupere tous les donnees concernant un cours
  *
  ***********************************************************************/
  $req = $DB->query("SELECT l.*, u.prenoms, u.nom, u.avatar, c.titre as titre_cat
    FROM cours l
    LEFT JOIN utilisateurs u ON u.id = l.auteur_id
    LEFT JOIN categorie c ON c.id_categorie = l.id_categorie
    WHERE l.id = ?
    ORDER BY l.date_created_at",
    array($get_id));

    $req = $req->fetch();



#$Parsedown = new Parsedown();
#$req['text'] = $Parsedown->text($req['text']);

?>
<!DOCTYPE html>
<html>

<head>
    <base href="/All_engineering/" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= $req['titre'] ?></title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/default.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"
        integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <link rel="stylesheet" href="style/bootstrap.min.css" />
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="style/learn.css">
</head>

<body>
    <?php include_once('../tools/nav-bar.php');
    ?>
    <div id="container1">
        <div class="container container-pub">
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div
                        style="width:800px; margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
                        <!-- <--!h1 style="color: #666; text-decoration: none; font-size: 28px; text-align:center"><?= $req['titre'] ?></h1> -->
                        <div style="border-top: 2px solid #EEE; padding: 15px 0">

                            <div class="text-1-part" style="display: block; padding-left:20px">
                            <h1 ><?php echo $req['titre']; ?></h1>
                            <h3 class="begin-course">Commencer le cours</h3>
                                <div class="text" ><?= nl2br($req['descriptions']); ?></div>
                            </div>
                            <div  style="display: block; margin-left:20px; margin-top:50px; background-color: black; width: 700px; height: 300px">

                            </div>
                            <div
                                style="padding-top: 15px; color: gray; font-style: italic; text-align: right;font-size: 12px; ">
                                Fait par <?= $req['nom'] . " " . $req['prenoms'] ?> le
                                <?= date_format(date_create($req['date_created_at']), 'D d M Y à H:i'); ?> dans le thème
                                <?= $req['titre_cat'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="level">
                        <div>
                            precedent
                        </div>
                        <div>
                            suivant
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include('../tools/footer.php');   ?>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
    <script>
    hljs.highlightAll();
    </script>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
</body>

</html>