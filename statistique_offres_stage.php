<?php include 'connecteoupas.php'; ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Statistiques</title>
  <meta name="description" content="statistiques des offres de stage" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style_statistique_offres_stage.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



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
   
    <div class="espace" ></div>

    <div class="menu">
      <ul>

        <div class="square">
   
            <li class="active"><p>Offres</p></li>
     
        </div>

          <li><a href="statistique_etudiant.php">Étudiants</a></li>
          <li><a href="statistique_entreprises.php">Entreprise</a></li>
        
      </ul>
    </div>
    </div>



    <div class="container_box">

      <div class="box_stats">
        <div class="box_stats_contenu">

        

            <h1>Répartition par compétence</h1>
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
          <h1>Offres par promotions</h1>
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

          <h1>Offres de stages les plus longues</h1>
          <table>
            <thead>
              <tr>
                <th>Domaine</th>
                <th>Entreprise</th>
                <th>Localisation</th>
                <th>Durée</th>
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
    $sql = "SELECT c.description_competence, COUNT(*) AS nombre_d_occurrences
    FROM offre_de_stage AS o
    INNER JOIN necessite AS n ON o.id_offre_de_stage = n.id_offre_de_stage
    INNER JOIN competence AS c ON n.id_competence = c.id_competence
    GROUP BY c.description_competence;";
    $stmt = $pdo->query($sql);
    $data = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array($row['description_competence'], intval($row['nombre_d_occurrences']));
    }
    $json_data = json_encode($data);
//----------------------------------------------------------------------------------------------
    $sql2 = "SELECT v.nom_ville, COUNT(*) AS nombre_d_occurrences
    FROM offre_de_stage AS o
    INNER JOIN entreprise AS e ON o.id_entreprise = e.id_entreprise
    INNER JOIN réside AS r ON e.id_entreprise = r.id_entreprise
    INNER JOIN adresse AS a ON r.id_adresse = a.id_adresse
    INNER JOIN se_localise AS sl ON a.id_adresse = sl.id_adresse
    INNER JOIN ville AS v ON sl.id_ville = v.id_ville
    GROUP BY v.nom_ville;";

$stmt2 = $pdo->query($sql2);
$data2 = array();

while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $data2[] = array($row['nom_ville'], intval($row['nombre_d_occurrences']));
}
$json_data2 = json_encode($data2);
  //----------------------------------------------------------------------------------------------
  $sql3 = "SELECT types_de_promotion, COUNT(*) AS nombre_offres
  FROM offre_de_stage
  GROUP BY types_de_promotion
  ORDER BY nombre_offres DESC;";

  $stmt3 = $pdo->query($sql3);
  $data3 = array();


  while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
    $data3[] = array($row['types_de_promotion'], intval($row['nombre_offres']));
  }

  $json_data3 = json_encode($data3);
    //----------------------------------------------------------------------------------------------
    $sql4 = "SELECT 
    ods.domaine_stage AS domaine_de_stage, 
    ent.nom_entreprise AS nom_entreprise, 
    v.nom_ville AS nom_ville, 
    CONCAT(FLOOR(DATEDIFF(ods.date_de_fin, ods.date_de_debut) / 30), ' mois ', DATEDIFF(ods.date_de_fin, ods.date_de_debut) % 30, ' jours') AS duree_offre
FROM 
    offre_de_stage AS ods
JOIN 
    entreprise AS ent ON ods.id_entreprise = ent.id_entreprise
JOIN 
    réside AS r ON ent.id_entreprise = r.id_entreprise
JOIN 
    adresse AS ad ON r.id_adresse = ad.id_adresse
JOIN 
    se_localise AS sl ON ad.id_adresse = sl.id_adresse
JOIN 
    ville AS v ON sl.id_ville = v.id_ville
ORDER BY duree_offre DESC;
;
    ";
    
      $stmt4 = $pdo->query($sql4);
      $data4 = array();
    
    
      while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
        $data4[] = array(
          $row['domaine_de_stage'],
          $row['nom_entreprise'],
          $row['nom_ville'], // Ajouter le secteur d'activité
          $row['duree_offre'] // Ajouter la ville
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
<script src="js/js_donut_offres.js" async defer></script>


</html>
