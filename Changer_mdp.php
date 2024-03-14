<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Changer de mdp</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_navbar.css" />
    <link rel="stylesheet" href="style/style_changer_mdp.css" />
    <link rel="stylesheet" href="style/style_footer.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
  </head>
  <body>
  <?php include 'Navbar.php'; ?>


<div class="box">
    <div class="box_mdp">
      <div class="box_mdp_contenu">
        <label class="text_mdp">Changer le mot de passe</label>
        <div class="box_password">
          <input
            class="password"
            type="password"
            id="password"
            placeholder="Mot de passe"
          />
          <button class="btn_password">afficher</button>
        </div>
        <div class="box_conf_password">
          <input
            class="conf_password"
            type="password"
            id="conf_password"
            placeholder="Confirmer le mot de passe"
          />
          <button class="btn_conf_password">afficher</button>
        </div>
        <a href="Se_Connecter.html"
          ><button class="btn_valider">Valider</button></a
        >
      </div>
    </div>
  </div>

  
  <?php include 'footer.php'; ?>


    <script src="js/js_changer_mdp.js" async defer></script>
  </body>
</html>
