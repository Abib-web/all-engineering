<?php
  session_start();
  include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD

  if (!isset($_SESSION['id'])){
    header('Location: /all_engineering/connexion');
    exit;
  }
  /*if($_SESSION['role'] <> 1){
    //header('Location: /blog');
    //exit;
  }*/

  /* Recuperons l'id du dernier articles puis incrementons le pour obtenir celui du prochain articles */
  $nbres_courses = $DB->query("SELECT MAX(id) FROM cours");
  $nbres_courses = $nbres_courses->fetch();
  $nbres_courses = $nbres_courses[0] + 1;

  if(!empty($_POST)){
    extract($_POST);
    $valid = true;

    if (isset($_POST['creer-cours'])){
      $cours_title = (string) htmlentities(trim($cours_title));
      $categorie = (int) htmlentities(trim($categorie));
      $contenu = (string) htmlentities(trim($contenu));

      if(empty($contenu)){
        $valid = false;
        $er_contenu = ("Il faut remplir la descrisption du cours");
      }

      if(empty($cours_title)){
        $valid = false;
        $er_cours_title = ("Il faut mettre un titre au cours");
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

    $date_creation = date('Y-m-d H:i:s');
    $DB->insert("INSERT INTO cours (titre, date_created_at, id_categorie, descriptions) VALUES
          (?, ?, ?, ?)",
          array( $cours_title, $date_creation, $categorie, $contenu));

      if($valid){

        $dossier = '../images/img-courses/'. $nbres_courses."/" ;

      if(!is_dir($dossier)){
        mkdir($dossier);
      }
      $file_1 = 'file_1';
      $article = $DB->query("SELECT * FROM cours WHERE date_created_at = ?",array($date_creation));
      $article = $article->fetch();
      $fichier_1 = basename($_FILES[$file_1]['name']);
        if(move_uploaded_file($_FILES[$file_1]['tmp_name'], $dossier . $fichier_1)) {
            if(file_exists("../images/img-courses/". $nbres_courses.'/'.$article['img_title']) && isset($article['img_fin'])){
                unlink("../images/img-courses/". $nbres_courses."/".$article['img_title']);
        }
    }

    $DB->insert("UPDATE cours SET img_title = ? WHERE id = '$nbres_courses'",
          array($fichier_1));

      }
    }
  }
?>
<!DOCTYPE html>
<html>

<head>
    <base href="/All_engineering/" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Créer mon article</title>
    <link rel="stylesheet" href="style/bootstrap.min.css" />
    <link rel="stylesheet" href="style/admin.css" />
</head>

<body style="display: flex">
  <?php include_once('../tools/nav-bar-ad.php');?>
  <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="cdr-ins">
                    <h1>Créer un cours</h1>
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <h1 class="btn-secondary">Cours name </h1>
                            <input class="form-control" rows="3"
                                placeholder="Entrez le nom du cours"
                                name="cours_title"><?php if(isset($cours_title)){  }?></input>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select name="categorie" class="custom-select" id="inputGroupSelect01">
                                    <?php
                      if(empty($categorie)){
                      ?>
                                    <option selected>Sélectionner votre Categorie</option>
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
                        <div class="form-group">
                            <h1 class="btn-primary">Description du cours </h1>
                            <textarea class="form-control" rows="3" placeholder="Décrivez le cours"
                                name="contenu"><?php if(isset($contenu)){ echo $contenu; }?></textarea>
                        </div>
                        <?php
                              if (isset($er_contenu)){
                        ?>
                              <div class="er-msg"><?= $er_contenu ?></div>
                        <?php
                              }
                        ?>
                        <div class="form-group">
                            <label for="file_1" style="margin-bottom: 0; margin-top: 5px; display: inline-flex">
                                Image du titre : <input id="file_1" type="file" name="file_1" class="hide-upload"
                                    required />
                                <i class="fa fa-plus image-plus"></i>
                            </label>
                        </div>
                        <div class="form-group">
                                    <button class="btn btn-primary" type="submit" name="creer-cours">Envoyer</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>