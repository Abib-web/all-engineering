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
  * Cette requette sql recupere tous les donnees concernant un articles
  *
  ***********************************************************************/
  $req = $DB->query("SELECT b.*, u.prenoms, u.nom, u.avatar, c.titre as titre_cat
    FROM blog b
    LEFT JOIN utilisateurs u ON u.id = b.id_user
    LEFT JOIN categorie c ON c.id_categorie = b.id_categorie
    WHERE b.id = ?
    ORDER BY b.date_creation",
    array($get_id));

    $req = $req->fetch();

     /*********************************************************************
  * Cette requette sql recupere tous les commentaires concernant un articles
  *
  ***********************************************************************/
    $req_commentaire = $DB->query("SELECT BC.*, DATE_FORMAT(BC.date_creation, 'Le %d/%m/%Y à %H\h%i') as date_c, U.prenoms, U.nom, U.avatar
    FROM blog_commentaire BC
    LEFT JOIN utilisateurs U ON U.id = BC.id_user
    WHERE id_blog = ?
    ORDER BY date_creation DESC",
    array($get_id));
    $req_commentaire = $req_commentaire->fetchAll();

        // La requete pour avoir la listes des articles
    $req_blog = $DB->query("SELECT b.*, u.prenoms, u.nom, c.titre as titre_cat
    FROM blog b
    LEFT JOIN utilisateurs u ON u.id = b.id_user
    LEFT JOIN categorie c ON c.id_categorie = b.id_categorie
    ORDER BY b.date_creation DESC");

  $req_blog = $req_blog->fetchAll();


  if(!empty($_POST)){
      extract($_POST);
      $valid = true;
      if (isset($_POST['ajout-commentaire'])){
          $text  = (String) trim($text);
          if(empty($text)){
              $valid = false;
              $er_commentaire = "Il faut mettre un commentaire";
            }elseif(iconv_strlen($text, 'UTF-8') <= 3){
            $valid = false;
            $er_commentaire = "Il faut mettre plus de 3 caractères";
        }

        $text = htmlentities($text);
        if($valid){
            $date_creation = date('Y-m-d H:i:s');
            $DB->insert("INSERT INTO blog_commentaire (id_user, id_blog, text, date_creation) VALUES (?, ?, ?, ?)",
            array($_SESSION['id'], $get_id, $text, $date_creation));
            header('Location: /forumxcience/blog/' . $get_id);
            exit;
        }
    }


}
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
   /*********************************************************************
  * Cette requette sql recupere tous les donnees concernant la liste des categories
  *
  ***********************************************************************/
  $req_cat = $DB->query("SELECT * FROM cours");

  $req_cat = $req_cat->fetchAll();

   /*********************************************************************
  * Cette requette sql recupere tous les donnees concernant la liste des Articles
  *
  ***********************************************************************/
  $req_artic = $DB->query("SELECT * FROM blog");

  $req_artic = $req_artic->fetchAll();

$Parsedown = new Parsedown();
$req['text'] = $Parsedown->text($req['text']);
$req['text1'] = $Parsedown->text($req['text1']);

?>
<!DOCTYPE html>
<html>

<head>
    <base href="/All_engineering/" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= $req['titre'] ?></title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css" />

</head>

<body>
    <?php include_once('../tools/nav-bar.php');
    ?>
    <div class="container">
        <div class="vide">

        </div>
            <div class="main-pub item" style="margin-top: 20px">
                <div class="">
                <h1 style="background-color: white; z-index:10; border-radius:10px ; padding:  20px; width: 800px"><?php echo $req['titre']; ?></h1>
                    <div
                        style="width:800px; margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
                        <!-- <--!h1 style="color: #666; text-decoration: none; font-size: 28px; text-align:center"><?= $req['titre'] ?></h1> -->
                        <div style="border-top: 2px solid #EEE; padding: 15px 0">
                            <div class="introduction-part-1" style="display: flex; flex-direction: column;">
                            <?php if(file_exists("../images/img-articles/". $req['id'] . "/" . $req['img_title'])){ ?>
                                <img class="image-article-title"
                                    src="<?= "/All_engineering/images/img-articles/". $req['id'] . "/" . $req['img_title']; ?>"
                                    width="620" height="400px";/>
                            <?php } else{ ?>

                            <?php } ?>
                            <br>
                            <br>
                            <br>
                            <br>
                                <div class="introdution"><?= nl2br($req['introduction']); ?></div>
                            </div>
                            <br>
                            <br>
                            <div class="text-1-part" style="display: block; padding-left:20px">
                                <div class="text" ><?= nl2br($req['text']); ?></div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?php if(file_exists("../images/img-articles/". $req['id'] . "/" . $req['img_milieu'])){ ?>
                            <img class="image-article-texte"
                                src="<?= "/All_engineering/images/img-articles/". $req['id'] . "/" . $req['img_milieu']; ?>"
                                width="620" height="400" />
                            <?php } else{ ?>

                                <?php } ?>
                            <br>
                            <br>
                            <div class="text-2-part" style="display: block; padding-left:20px">
                                <div class="text" ><?= nl2br($req['text1']); ?></div>
                            </div>
                            <br>
                            <?php if(file_exists("../images/img-articles/". $req['id'] . "/" . $req['img_fin'])){ ;?>
                            <img class="image-article-texte"
                                src="<?= "/All_engineering/images/img-articles/". $req['id'] . "/" . $req['img_fin']; ?>"
                                width="720" height="400" />
                                <?php } else{ ?>

                                <?php } ?>
                            <div
                                style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px; float:left;text-align:center">
                                Fait par <?= $req['nom'] . " " . $req['prenoms'] ?> le
                                <?= date_format(date_create($req['date_creation']), 'D d M Y à H:i'); ?> dans le thème
                                <?= $req['titre_cat'] ?>
                            </div>
                        </div>
                    </div>


                    <!-- Commentaires -->
                    <?php
    if(isset($_SESSION['id'])){
    ?>
                              <div
                        style=" width: 800px;background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, .15); padding: 5px 10px; border-radius: 10px; margin-top: 20px">
                                    <h3>Participer à l'article</h3>
                                    <?php
         if(isset($er_commentaire)){
     ?>
                                    <div class="er-msg"><?= $er_commentaire ?></div>
                                    <?php
        }
?>
                        <form method="post">
                            <div class="form-group">
                                <textarea class="form-control" name="text" rows="4"
                                    placeholder="Écrivez-votre commentaire ..."></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="ajout-commentaire">Envoyer</button>
                            </div>
                        </form>
                    </div>
                    <?php
    }
 ?>  <div style="width: 800px; background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, .15); padding: 5px 10px; border-radius: 10px; margin-top: 20px">
                        <h3>Commentaires</h3>
                        <?php
        foreach($req_commentaire as $rc){
            ?>
                        <div style="background: #eee; margin-top: 20px; padding: 5px 10px; border-radius: 10px">
                            <?php $resultat =  $rc['avatar'] ?  $rc['avatar'] : 'default.svg' ; if($rc['avatar'] )
                        {
                    ?>
                            <div style="font-weight: bold"><a href="/forumxcience/voir_profil/<?=$rc['id_user']?>"><img
                                        src="<?= "/forumxcience/image/upload/". $rc['id_user'] . "/" . $resultat ; ?>"
                                        width="20" /><?= "De " . $rc['nom'] . " " . $rc['prenoms'] . " : "?></a></div>
                            <?php } else{?>
                            <div style="font-weight: bold"><a href="/forumxcience/voir_profil/<?=$rc['id_user']?>"><img
                                        src="<?= "/forumxcience/image/upload/". "/" . $resultat ; ?>"
                                        width="20" /><?= $rc['nom'] . " " . $rc['prenoms'] ?></a></div>
                            <?php } ?>

                            <?= nl2br($rc['text']) ?>
                            <div style="text-align: right; font-size: 12px; color: #665"><?= $rc['date_c'] ?></div>
                        </div>
                        <?php
        }
        ?>
                    </div>
                </div>

            </div>
            <div class="categorie-display item">
                    <ul class="list-cat">
                        <h3 class="cat-header"> Les cours disponible</h3>
                        <?php
                             foreach($req_cat as $req_cat_containe){
                        ?>
                                <li><?= $req_cat_containe['titre'] ?></li>
                        <?php
                            }
                        ?>
                    </ul>
                    <ul class="list-arc">
                        <li class="arc-header"> Les Articles disponibles</li>
                        <?php
                             foreach($req_artic as $req_article){
                        ?>
                                <li><?= $req_article['titre'] ?></li>
                        <?php
                            }
                        ?>
                    </ul>
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
    <script src="https://kit.fontawesome.com/50d8944cef.js" crossorigin="anonymous"></script>
</body>

</html>