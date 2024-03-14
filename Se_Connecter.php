<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Se connecter</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_navbar.css" />
    <link rel="stylesheet" href="style/style_connecter.css" />
    <link rel="stylesheet" href="style/style_footer.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
  </head>
  <body>
  <?php include 'Navbar.php'; ?>


    <div class="box">
      <div class="box_connexion">
        <div class="box_connexion_contenu">
          <label class="text_connexion">Se connecter</label>
          <input
            class="email"
            type="email"
            id="email"
            placeholder="Adresse email"
          />
          <div class="box_password">
            <input
              class="password"
              type="password"
              id="password"
              placeholder="Mot de passe"
            />
            <button class="btn_password">afficher</button>
          </div>
          <a href="Changer_mdp.html">Mot de passe oublié ?</a>
          <button class="btn_connexion">Se connecter</button>
        </div>
      </div>
    </div>
    <footer>
      <div class="contenu_footer">
        <div class="bloc_footer_a_propos">
          <h3>A propos</h3>
          <div class="liste_a_propos">
            <li><a class="interligne" href="#"> Mentions légales</a></li>
            <li><a class="interligne" href="#"> Tous droits réservés</a></li>
            <li>
              <a class="interligne" href="#"> Politiques de confidentialité</a>
            </li>
          </div>
        </div>

        <div class="bloc_footer_nous_contacter">
          <h3>Nous contacter</h3>
          <div class="liste_nous_contacter">
            <li><a class="interligne"> 07 83 41 25 40</a></li>
            <li><a class="interligne"> 06 09 82 16 83</a></li>
            <li><a class="interligne"> 06 89 77 85 64</a></li>
          </div>
        </div>

        <div class="bloc_footer_reseaux_sociaux">
          <h3>Nos réseaux sociaux</h3>
          <div class="liste_reseaux_sociaux">
            <a href="https://www.youtube.com/">
              <img src="image/youtube.png"
            /></a>
            <a href="https://www.linkedin.com/">
              <img src="image/linkedin.png"
            /></a>
            <a href="https://twitter.com/"> <img src="image/twitterx.png" /></a>
            <a href="https://www.instagram.com/"
              ><img src="image/instagram.png"
            /></a>
          </div>
        </div>
      </div>
      <p class="noStage">© noStage 2024</p>
    </footer>
    <script src="js/js_connecter.js" async defer></script>
  </body>
</html>
