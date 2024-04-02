<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="description" content="voici la page d'acceuil de notre site noStage" />
  <title>noStage</title>
  <link rel="icon" href="image/logo_onglet.png" type="image/png">
  <link rel="stylesheet" href="style/style_navbar.css" />
  <link rel="stylesheet" href="style/style_page_acceuil.css" />
  <?php  include 'lien_fichier_manifest.php'; ?>



  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>
<?php include 'Navbar.php';?>

<body>
   <div class="container_haut_de_page">

    <div class="bloc_slogan">
      <ul>
      
      <li><p>Pas de stage ?</p></li>
      <li><p>Pas de stagiaire ?</p></li>
      <li><p>Pas de problème !</p></li>
      </ul>

      <div>
      <p class="phrase_acceuil">
        Votre futur commence ici : découvrez nos offres de stages pour vous lancer dans votre carrière !
      </p>
      </div>

      <button class="bouton_commencer">Commencer à rechercher</button>
    </div>

    <div class="bloc_homme_loupe">
      <img alt =" homme loupe " class="homme_loupe" src="image/homme_loupe.webP" />

    </div>


  </div>





  <main>
    <h1>Pourquoi utiliser noStage ?</h1>
    <div class="texte_center">
      <p>
        noStage est un site de recherche de stage facile et pratique
        d’utilisation. Nous savons, en tant qu’étudiants, que la recherche de
        stage n’est pas forcément évidente. C’est pourquoi noStage est un site
        Web qui regroupe différentes offres de stage et qui permet de stocker
        les données des entreprises ayant déjà pris un stagiaire ou qui en
        recherchent un.
      </p>
    </div>

    <h1>Nos partenaires</h1>

    <div class="texte_center">
      <p>
        noStage a la chance d’avoir élaboré de nombreux partenariats avec
        diverses entreprises
      </p>
      <img alt ="ensemble des partenaires de CESI " class="partenaires" src="image/partenaires.png" />
    </div>

    <h1>Nos collaborateurs</h1>

    <div class="container_collaborateur">

      <div class="container_collaborateur_items">
        <img alt="Maxime Auchet" src="image/maxime.webP" />
        <div class="nom">
          <p>Maxime Auchet</p>
        </div>
      </div>

      <div class="container_collaborateur_items">
        <img alt="Alexis Peiffer" src="image/alexis.webP" />
        <div class="nom">
          <p>Alexis Peiffer</p>
        </div>
      </div>

      <div class="container_collaborateur_items">
        <img alt="Enzo Fraïoli" src="image/enzo.webP" />
        <div class="nom">
          <p>Enzo Fraïoli</p>
        </div>
      </div>
    </div>




  </main>

  <?php include 'footer.php'; ?>
  

</body>

</html>