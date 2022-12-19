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


    if (isset($_POST['creer-lecon'])){
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
          FROM cours
          WHERE id = ?",
          array($categorie));

        $verif_cat = $verif_cat->fetch();
        echo $verif_cat;
        if (!isset($verif_cat['id'])){
          $valid = false;
          $er_categorie = "Ce thème n'existe pas";
        }
      }
    $date_creation = date('Y-m-d H:i:s');
    $DB->insert("INSERT INTO lecon (titre_lecon, date_created_at, id_cours, contenu) VALUES
          (?, ?, ?, ?)",
          array( $cours_title, $date_creation, $categorie, $contenu));
    }
  }
?>
<!DOCTYPE html>
<html>

<head>
    <base href="/All_engineering/" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Créer une lecon</title>
    <link rel="stylesheet" href="style/bootstrap.min.css" />
    <link rel="stylesheet" href="style/admin.css" />
</head>

<body style="display: flex">
  <?php include_once('../tools/nav-bar-ad.php');?>
  <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="cdr-ins">
                    <h1>Créer une lecon</h1>
                    <form method="post" enctype="multipart/form-data">
                        <?php
                // S'il y a une erreur sur le nom alors on affiche
                if (isset($er_categorie)){
                ?>
                        <div class="er-msg"><?= $er_categorie ?></div>
                        <?php
                }
              ?>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select name="categorie" class="custom-select" id="inputGroupSelect01">
                                    <?php
                      if(empty($categorie)){
                      ?>
                                    <option selected>Sélectionner le cours</option>
                                    <?php
                      }else{
                      ?>
                                   <option value="<?= $categorie ?>"><?= $verif_cat['titre'] ?></option>
                                    <?php

                      }

                      $req_cat = $DB->query("SELECT *
                        FROM cours");
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
                        <div class="er-msg"><?= $er_titre ?></div>
                        <?php
                }
              ?>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Votre titre" name="cours_title"
                                value="<?php if(isset($cours_title)){ echo $cours_title; }?>">
                        </div>
                        <?php
                        if (isset($er_contenu)){
                  ?>
                        <div class="er-msg"><?= $er_contenu ?></div>
                        <?php
                  }
              ?>
                        <div class="form-group">
                            <h1 class="btn-primary">Contenu du cours </h1>
                            <textarea class="form-control" rows="3" placeholder="Décrivez votre article(premier partie)"
                                name="contenu"><?php if(isset($contenu)){ echo $contenu; }?></textarea>
                        </div>


                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" name="creer-lecon">Envoyer</button>
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