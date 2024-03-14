<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Navbar NoStage</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_navbar.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
  </head>
  <body>
    <header>
      <img
        class="logo"
        src="image/logo entreprise.png"
        alt="logo de l'entreprise"
      />
      <nav class="navbar">
        <a href="Page_acceuil.html">Accueil</a>
        <div class="dropdown_1">
          <button>Chercher</button>
          <div class="content">
            <a href="#">Entreprises</a>
            <a href="Recherche_stage.html">Stages</a>
          </div>
        </div>
        <div class="dropdown_2">
          <button>Gérer</button>
          <div class="content_gerer">
            <a href="gerer_pilotes.html">Pilotes</a>
            <a href="gerer_entreprises.html">Entreprises</a>
            <a href="gerer_etudiants.html">Etudiants</a>
            <a href="#">Offres</a>
          </div>
        </div>
        <div class="dropdown_3">
          <button>Statistiques</button>
          <div class="content_stat">
            <a href="statistique_entreprises.html">Entreprises</a>
            <a href="statistique_etudiant.html">Etudiants</a>
            <a href="statistique_offres_stage.html">Offres</a>
          </div>
        </div>
        <div class="profil-container">
          <img class="profil" src="image/profil.png" alt="profil utilisateur" />
          <button>
            <img
              class="menu_profil"
              src="image/menu profil.png"
              alt="menu profil utilisateur"
            />
          </button>
          <div class="content_profil">
            <a href="#">Maxime AUCHET</a>
            <a href="#">Voir le compte</a>
            <a href="#">Se déconnecter</a>
          </div>
        </div>
      </nav>
    </header>
    <script src="" async defer></script>
  </body>
</html>
