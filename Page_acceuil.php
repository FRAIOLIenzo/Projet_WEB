<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>noStage</title>
    <link rel="stylesheet" href="style/style_navbar.css" />
    <link rel="stylesheet" href="style/style_page_acceuil.css" />


    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
  </head>

  <body>
  <?php include 'Navbar.php'; ?>


    <div class="acceuil_slogan">
      
      <div class="container_haut_de_page">

        <div class="bloc_slogan">
          <li><a>Pas de stage ?</a></li>
          <li><a>Pas de stagiaire ?</a></li>
          <li><a>Pas de problème !</a></li>


          <p class="phrase_acceuil">
          Votre futur commence ici : découvrez nos offres de stages pour vous lancer dans votre carrière !
          </p>
      
          <button class="bouton_commencer">Commencer à rechercher</button>
        </div>

        <div class="bloc_homme_loupe">
          <img class="homme_loupe" src="image/homme_loupe.png" />

        </div>


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
        <img class="partenaires" src="image/partenaires.png" />
      </div>

      <h1>Nos collaborateurs</h1>

      <section class="alignement">
        <img src="image/maxime.png" />

        <img src="image/alexis.png" />

        <img src="image/enzo.png" />
      </section>

      <div class="nom">
        <p>Maxime Auchet</p>
        <p>Alexis Peiffer</p>
        <p>Enzo Fraïoli</p>
      </div>
    </main>

    <?php include 'footer.php'; ?>

  </body>
</html>
