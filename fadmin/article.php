<?php
    session_start();
  include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD

  if (!isset($_SESSION['id'])){
    header('Location: acces-denied-you-have-sommething-to-acces-somewhere-ncneubaksbc');
    exit;
  }
  /*if($_SESSION['role'] <> 1){
    //header('Location: /blog');
    //exit;
  }*/

  /* Recuperons l'id du dernier articles puis incrementons le pour obtenir celui du prochain articles */
  $nbres_articles = $DB->query("SELECT MAX(id) FROM blog");
  $nbres_articles = $nbres_articles->fetch();
  $nbres_articles = $nbres_articles[0] + 1;

  if(!empty($_POST)){
    extract($_POST);
    $valid = true;

    if (isset($_POST['creer-article'])){
      $titre  = (string) htmlentities(trim($titre));
      $introduction = (string) htmlentities(trim($introduction));
      $contenu = (string) htmlentities(trim($contenu));
      $contenu1 = (string) htmlentities(trim($contenu1));
      $categorie = (int) htmlentities(trim($categorie));

      if(empty($titre)){
        $valid = false;
        $er_titre = ("Il faut mettre un titre");
      }elseif(strlen($titre)< 50 ){
        $valid = false;
        $er_titre = ("Le titre doit contenir plus de 20 caracteres");
      }

      if(empty($introduction)){
        $valid = false;
        $er_introduction = ("Il faut mettre une introduction");
      } elseif(strlen($introduction)< 255 ){
        $valid = false;
        $er_introduction = ("Le titre doit contenir plus de 255 caracteres");
      }
      if(empty($contenu)){
        $valid = false;
        $er_contenu = ("Il faut mettre un contenu");
      }elseif(strlen($contenu)< 255 ){
        $valid = false;
        $er_contenu = ("Le titre doit contenir plus de 255 caracteres");
      }
      if(empty($contenu1)){
        $valid = false;
        $er_contenu1 = ("Il faut mettre un contenu");
      }elseif(strlen($contenu1)< 255 ){
        $valid = false;
        $er_contenu1 = ("Le titre doit contenir plus de 255 caracteres");
      }


      if(empty($categorie)){
        $valid = false;
        $er_categorie = "Le thème ne peut pas être vide";
      }else{
        // On vérifit que le mail est disponible
        $verif_cat = $DB->query("SELECT id, titre
          FROM categorie
          WHERE id = ?",
          array($categorie));

        $verif_cat = $verif_cat->fetch();

        if (!isset($verif_cat['id'])){
          $valid = false;
          $er_categorie = "Ce thème n'existe pas";
        }
      }


      if($valid){

        $dossier = '../images/img-articles/'. $nbres_articles."/" ;

      if(!is_dir($dossier)){
        mkdir($dossier);
      }
      $file_1 = 'file_1';
      $file_2 = 'file_2';
      $file_3 = 'file_3';
      $article = $DB->query("SELECT * FROM blog WHERE id_user = ?",array($_SESSION['id']));
      $article = $article->fetch();
      if(checkExtension($_FILES[$file_1]['name']) && checkExtension($_FILES[$file_2]['name'])
                          && checkExtension($_FILES[$file_3]['name'])){
        $fichier_1 = basename($_FILES[$file_1]['name']);
        $fichier_2 = basename($_FILES[$file_2]['name']);
        $fichier_3 = basename($_FILES[$file_3]['name']);


        if(move_uploaded_file($_FILES[$file_1]['tmp_name'], $dossier . $fichier_1) && move_uploaded_file($_FILES[$file_2]['tmp_name'], $dossier . $fichier_2)&& move_uploaded_file($_FILES[$file_3]['tmp_name'], $dossier . $fichier_3)) {
            if(file_exists("../images/img-articles/". $nbres_articles.'/'.$article['img_title']) && isset($article['img_title'])){
              unlink("../images/img-articles/". $nbres_articles."/".$article['img_title']);
            }
            if(file_exists("../images/img-articles/". $nbres_articles.'/'.$article['img_milieu']) && isset($article['img_milieu'])){
              unlink("../images/img-articles/". $nbres_articles."/".$article['img_milieu']);
            }
            if(file_exists("../images/img-articles/". $nbres_articles.'/'.$article['img_fin']) && isset($article['img_fin'])){
              unlink("../images/img-articles/". $nbres_articles."/".$article['img_fin']);
            }
          }
        $date_creation = date('Y-m-d H:i:s');
        $DB->insert("INSERT INTO blog (id_user, titre,introduction, text, text1, date_creation, id_categorie,img_title , img_milieu, img_fin) VALUES
          (?, ?, ?, ?, ?, ?, ?,?,?,?)",
          array($_SESSION['id'], $titre, $introduction, $contenu,  $contenu1, $date_creation, $categorie, $fichier_1, $fichier_2, $fichier_3));

        }else{
          $valid = false;
          $er_image = "Impossible de charger une image de ce type";
        }
      }
    }
  }

  function checkExtension($filename){
    $bool = false;
    $file_parts = pathinfo($filename);
    switch($file_parts['extension'])
          {
            case "jpg"|"png"|"jpg"|"jpeg"|"gif"|"bmp":
                  $bool = true;
                  break;
            case "exe":
                 $bool = false;
                  break;
            case "": // Handle file extension for files ending in '.'
              $bool = false;
                  break;
            case NULL: // Handle no file extension
                  $bool = true;
                  break;
            default:
                $bool = false;
            break;
          }
      return $bool;
  }
  ?>
<base href="/All_engineering/" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Créer mon article</title>
<link rel="stylesheet" href="style/bootstrap.min.css" />
<link rel="stylesheet" href="style/admin.css" />

<body style="display: flex">
<?php include_once('../tools/nav-bar-ad.php');?>
<div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="cdr-ins">
                    <h1>Créer mon article</h1>
                    <form method="post" enctype="multipart/form-data">
                        <?php
                // S'il y a une erreur sur le nom alors on affiche
                if (isset($er_categorie)){
                ?>
                        <div class="er-msg text-danger"><?= $er_categorie ?></div>
                        <?php
                }
              ?>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select name="categorie" class="custom-select" id="inputGroupSelect01">
                                    <?php
                      if(empty($categorie)){
                      ?>
                                    <option selected>Sélectionner votre thème</option>
                                    <?php
                      }else{
                      ?>
                                    <option value="<?= $categorie ?>"><?= $verif_cat['titre'] ?></option>
                                    <?php
                      }

                      $req_cat = $DB->query("SELECT *
                        FROM categorie");
                      $req_cat = $req_cat->fetchALL();

                      foreach($req_cat as $rc){
                      ?>
                                    <option value="<?= $rc['id'] ?>"><?= $rc['titre'] ?></option>
                                    <?php
                      }
                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                if (isset($er_titre)){
                ?>
                        <div class="er-msg text-danger"><?= $er_titre ?></div>
                        <?php
                }
              ?>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Votre titre" name="titre"
                                value="<?php if(isset($titre)){ echo $titre; }?>">
                        </div>
                        <?php
                if (isset($er_introduction)){
                  ?>
                        <div class="er-msg text-danger"><?= $er_introduction ?></div>
                        <?php
                  }
              ?>
                        <div class="form-group">
                            <h1 class="btn-info">Introduction </h1>
                            <textarea class="form-control" rows="3" placeholder="Introduisez votre article"
                                name="introduction"><?php if(isset($introduction)){ echo $introduction; }?></textarea>
                        </div>
                        <?php
                        if (isset($er_contenu)){
                  ?>
                        <div class="er-msg text-danger"><?= $er_contenu ?></div>
                        <?php
                  }
              ?>
                        <div class="form-group">
                            <h1 class="btn-primary">Text 1 </h1>
                            <textarea class="form-control" rows="3" placeholder="Décrivez votre article(premier partie)"
                                name="contenu"><?php if(isset($contenu)){ echo $contenu; }?></textarea>
                        </div>
                        <?php
                        if (isset($er_contenu1)){
                  ?>
                        <div class="er-msg text-danger"><?= $er_contenu1 ?></div>
                        <?php
                  }
              ?>
                        <div class="form-group">
                            <h1 class="btn-secondary">Text 2 </h1>
                            <textarea class="form-control" rows="3"
                                placeholder="Décrivez votre article(deuxième partie)"
                                name="contenu1"><?php if(isset($contenu1)){ echo $contenu1; }?></textarea>
                        </div>
                        <div class="form-group">

                        </div>
                        <?php
                        if (isset($er_image)){
                              ?>
                          <div class="er-msg text-danger"><?= $er_image ?></div>
                        <?php
                          }
                        ?>
                        <div class="form-group">
                            <label for="file_1" style="margin-bottom: 0; margin-top: 5px; display: inline-flex">
                                Image du titre : <input id="file_1" type="file" name="file_1" class="hide-upload"
                                accept="image/*" />
                                <i class="fa fa-plus image-plus"></i>
                            </label>
                        </div>
                        <div class="form-group">
                              <div class="form-group">
                                <label for="file_2" style="margin-bottom: 0; margin-top: 5px; display: inline-flex">
                                    Image du milieu : <input id="file_2" type="file" name="file_2" class="hide-upload"
                                    accept="image/*" />
                                    <i class="fa fa-plus image-plus"></i>
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="file_3" style="margin-bottom: 0; margin-top: 5px; display: inline-flex">
                                        Image de la fin : <input id="file_3" type="file" name="file_3"
                                            class="hide-upload" accept="image/*"  />
                                        <i class="fa fa-plus image-plus"></i>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" name="creer-article">Envoyer</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>