<?php include 'connecteoupas.php'; ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Statistiques</title>
  <meta name="description" content="statistiques des entreprises" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style_statistique_entreprise.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php include 'Navbar.php'; ?>
  <?php
  if (!(isset($_SESSION['statut']) && ($_SESSION['statut'] == 'admin') || $_SESSION['statut'] == 'pilote')) {
    header('Location: pasacces.php');
  }
  ?>


  <main>
    <div class="container_haut_page">
      <h1 class="tableau_de_bord">Tableau de bord</h1>
      <div class="espace"></div>
      <div class="menu">
        <ul>
          <li class="active"><a href="statistique_offres_stage.php">Offres</a></li>
          <li><a href="statistique_etudiant.php">Étudiants</a></li>
          <div class="square">
            <li>
              <p>Entreprise</p>
            </li>
          </div>
        </ul>
      </div>
    </div>



    <div class="container_box">
      <div class="box_stats">
        <div class="box_stats_contenu">
          <h1>Répartition par secteur d'activité</h1>
          <div class="donut" id="donut_secteur_activite"></div>
        </div>
      </div>
      <div class="box_stats">
        <div class="box_stats_contenu">
          <h1>Répartition par localisation</h1>
          <div class="donut" id="donut_campus"></div>
        </div>
      </div>
      <div class="box_stats">
        <div class="box_stats_contenu">
          <h1>Entreprises les mieux notées</h1>
          <div class="emplacement_box_droite">
            <ol id="listeEntreprises">
            </ol>
          </div>
        </div>
      </div>
    </div>




    <div class="container_box_tableau">
      <div class="box_stats_tableau">
        <div class="tableau_offre">

          <h1>Entreprise avec le plus d'avis</h1>
          <table>
            <thead>
              <tr>
                <th>Nom</th>
                <th>Secteurs d'activité</th>
                <th>Localisation</th>
                <th>Nombre d'avis</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              <!-- Les lignes du tableau seront générées dynamiquement ici -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <?php include 'footer.php'; ?>
</body>




<?php
// Récupérez vos données depuis la base de données et encodez-les en JSON
$username = "max";
$password = "]$;8ytb]%n-Jg;^";
try {
  $pdo = new PDO('mysql:host=db.aws.gop.onl;dbname=max', $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Requête SQL pour obtenir le nom du secteur d'activité et le nombre d'apparitions
  $sql = "SELECT s.nom_secteur_activite AS secteur, COUNT(*) AS nombre_apparitions
            FROM entreprise e
            JOIN possede p ON e.id_entreprise = p.id_entreprise
            JOIN secteur_activite s ON p.id_secteur_activite = s.id_secteur_activite
            GROUP BY s.nom_secteur_activite
            ORDER BY nombre_apparitions DESC";
  $stmt = $pdo->query($sql);
  $data = array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = array($row['secteur'], intval($row['nombre_apparitions']));
  }
  $json_data = json_encode($data);
  //----------------------------------------------------------------------------------------------
  $sql2 = "SELECT v.nom_ville, COUNT(*) AS nombre_apparitions
            FROM entreprise e
            JOIN réside r ON e.id_entreprise = r.id_entreprise
            JOIN adresse a ON r.id_adresse = a.id_adresse
            JOIN se_localise s ON a.id_adresse = s.id_adresse
            JOIN ville v ON s.id_ville = v.id_ville
            GROUP BY v.nom_ville";

  $stmt2 = $pdo->query($sql2);
  $data2 = array();


  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $data2[] = array($row['nom_ville'], intval($row['nombre_apparitions']));
  }
  $json_data2 = json_encode($data2);
  //----------------------------------------------------------------------------------------------
  $sql3 = "SELECT  e.nom_entreprise, ROUND(moyenne_notes.moyenne, 0) AS moyenne_arrondie
FROM entreprise AS e
LEFT JOIN Avis AS a ON e.id_entreprise = a.id_entreprise
INNER JOIN (
    SELECT id_entreprise, AVG(note_globale) AS moyenne
    FROM Avis
    GROUP BY id_entreprise
) AS moyenne_notes ON e.id_entreprise = moyenne_notes.id_entreprise
GROUP BY e.nom_entreprise, e.id_entreprise
ORDER BY moyenne_arrondie DESC;";

  $stmt3 = $pdo->query($sql3);
  $data3 = array();


  while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
    $data3[] = array($row['nom_entreprise'], intval($row['moyenne_arrondie']));
  }

  $json_data3 = json_encode($data3);
    //----------------------------------------------------------------------------------------------
    $sql4 = "SELECT e.nom_entreprise, v.nom_ville, sa.nom_secteur_activite, COUNT(a.id_entreprise) AS nombre_avis
    FROM entreprise AS e
    JOIN réside AS r ON e.id_entreprise = r.id_entreprise
    JOIN adresse AS ad ON r.id_adresse = ad.id_adresse
    JOIN se_localise AS sl ON ad.id_adresse = sl.id_adresse
    JOIN ville AS v ON sl.id_ville = v.id_ville
    JOIN possede AS p ON e.id_entreprise = p.id_entreprise
    JOIN secteur_activite AS sa ON p.id_secteur_activite = sa.id_secteur_activite
    LEFT JOIN Avis AS a ON e.id_entreprise = a.id_entreprise
    GROUP BY e.nom_entreprise, v.nom_ville, sa.nom_secteur_activite
    ORDER BY nombre_avis DESC;";
    
      $stmt4 = $pdo->query($sql4);
      $data4 = array();
    
    
      while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
        $data4[] = array(
          $row['nom_entreprise'],
          $row['nom_secteur_activite'],
          $row['nom_ville'], // Ajouter le secteur d'activité
          $row['nombre_avis'] // Ajouter la ville
      );;
      }
    
      $json_data4 = json_encode($data4);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
?>







<script>
  var donutData = <?php echo $json_data; ?>
</script>
<script>
  var donutData2 = <?php echo $json_data2; ?>
</script>
<script>
  var donutData3 = <?php echo $json_data3; ?>
</script>
<script>
  var donutData4 = <?php echo $json_data4; ?>
</script>
<script src="js/js_donut_entreprise.js" async defer></script>

</html>