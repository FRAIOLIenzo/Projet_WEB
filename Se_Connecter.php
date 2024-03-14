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
    <?php include 'footer.php'; ?>

    <script src="js/js_connecter.js" async defer></script>
  </body>
</html>
