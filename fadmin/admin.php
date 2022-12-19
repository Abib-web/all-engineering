<?php
  session_start();
  include('../bd/connexionDB.php');

  /* Recuperons l'id du dernier articles puis incrementons le pour obtenir celui du prochain articles */
  $nbres_articles = $DB->query("SELECT * FROM blog");
  $nbres_articles = $nbres_articles->fetchAll();
  $nbres_articles= count($nbres_articles);

  /* Recuperons l'id du dernier articles puis incrementons le pour obtenir celui du prochain articles */
  $nbres_cours = $DB->query("SELECT * FROM cours");
  $nbres_cours = $nbres_cours->fetchAll();
  $nbres_cours= count($nbres_cours);

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
    <div class="dashbord">
        <div class="articles-pub">
          <h1 class="articles-pub-title"> Les articles publier </h1>
          <hr>
          <p class="articles-pub-nomb">
              <?= $nbres_articles?>
          </p>
        </div>
        <div class="cours-pub">
          <h1 class="cours-pub-title"> Les Cours publier </h1>
          <hr>
          <p class="cours-pub-nomb">
          <?= $nbres_cours?>
          </p>
        </div>
        <div class="questions-pub">
          <h1 class="questions-pub-title"> Les Questions publier </h1>
          <hr>
          <p class="questions-pub-nomb">

          </p>
        </div>
    </div>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>