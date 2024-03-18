<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>noStage</title>
    <link rel="stylesheet" href="style/style_profil.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
  </head>
  <body>
  <?php include 'Navbar.php'; ?>
  <main>
    <div >
        <div id="square-main">
          <div id="container-profil">
            <img id="profil" src="image/profil.png" alt="profil utilisateur" />
            <div id="Nom">Maxime Auchet</div>
            </div>
            <div id="info-perso"> Information personnels : </div>
            <div id="container-info-perso">
                <div class="item">Centre : </div>
                <div class="item">Promotion concernée :</div>
                <div class="item">Addresse mail : </div>
                <div class="item">Mot de passe : </div>
            </div>
            <div id="info-pilote"> Pilote :  </div>
            <div id="container-pilote">

                <img id="pp-pilote" src="image/profil.png" alt="profil utilisateur" />
                <div>Kamal Alaili

                </div> 
            </div>

        </div>
    </div>



  </main>

  <?php include 'footer.php'; ?>
  </body>
</html>
