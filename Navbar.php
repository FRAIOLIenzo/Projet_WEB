<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Navbar NoStage</title>
  <meta name="description" content="haut de page du site noStage" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style_navbar.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
  <script src="/sw.js" async></script>
</head>

<body>
<?php
  error_reporting(0);
  session_start();
  if ((isset($_SESSION['connected']) && $_SESSION['connected'])) {
    $name=$_SESSION['name'];
    $lastname=$_SESSION['lastname'];
  }
  else{
    $name= 'Connectez';
    $lastname='vous';}
    
    ?>

  <header>
  <a  id="imgnostagehref" href="index.php" alt="logo de notre site"><img  class="logo" src="image/logo entreprise.png" alt="logo de l'entreprise" /></a>
    <nav class="navbar">
      <a href="index.php">Accueil</a>
      <div class="dropdown_1">
        <button>Chercher</button>
        <div class="content">
          <a href="Recherche_entreprise.php">Entreprises</a>
          <a href="Recherche_stage.php">Offres</a>
        </div>
      </div>
      <?php if(isset($_SESSION['statut']) && $_SESSION['statut'] == 'admin' || $_SESSION['statut'] == 'pilote'): ?>
      <div class="dropdown_2">
        <button>Gérer</button>
        <div class="content_gerer">
        <?php if(isset($_SESSION['statut']) && $_SESSION['statut'] == 'admin'): ?>
          <a href="gerer_pilotes.php">Pilotes</a>
        <?php endif; ?>

          <a href="gerer_entreprises.php">Entreprises</a>
          <a href="gerer_etudiants.php">Etudiants</a>
          <a href="gerer_offres.php">Offres</a>
        <?php endif; ?>
        </div>
      </div>
      <div class="dropdown_3">
        <button>Statistiques</button>
        <div class="content_stat">
          <a href="statistique_entreprises.php">Entreprises</a>
          <?php if(isset($_SESSION['statut']) && $_SESSION['statut'] == 'admin' || $_SESSION['statut'] == 'pilote'): ?>
          <a href="statistique_etudiant.php">Etudiants</a>
          <?php endif; ?>
          <a href="statistique_offres_stage.php">Offres</a>
        </div>
      </div>
      <div class="profil-container">
        <img class="profil" src="image/profil.png" alt="profil utilisateur" />
        <button>
          <img class="menu_profil" src="image/menu profil.png" alt="menu profil utilisateur" />
        </button>
        <div class="content_profil">
          <a ><?php echo $name;?>  <?php echo $lastname; ?> </a>
          <a href="deconnexion.php">Se déconnecter</a>
        </div>
      </div>
    </nav>
  </header>
  <script src="image/porte.png" async defer></script>
</body>

</html>