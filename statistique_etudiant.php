<?php include 'connecteoupas.php'; ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Statistiques</title>
  <meta name="description" content="statistiques des etudiants" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="style/style_statistique_etudiant.css" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="js/js_donut_campus.js" async defer></script>
  <script src="js/js_donut_secteur_activite.js" async defer></script>


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
        <li class="active"><a href="statistique_offres_stage.php">Offres</a></li>
        <div class="square">
          <li><p>Étudiants</p></li>
          </div>
          <li><a href="statistique_entreprises.php">Entreprise</a></li>
      </ul>
    </div>
    </div>
    <div class="container_box">
      <div class="box_stats">
        <div class="box_stats_contenu">
            <h1>Répartition par centre</h1>
            <div class="donut" id="donut_secteur_activite"></div>
        </div>
      </div>
      <div class="box_stats">
        <div class="box_stats_contenu">
            <h1>Répartition par promotion</h1>
            <div class="donut" id="donut_campus"></div>
        </div>
      </div>


      <div class="box_stats">
        <div class="box_stats_contenu">
          <h1>Promotions avec le plus d'étudiants</h1>
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

          <h1>Étudiants avec le plus d'avis effectués</h1>
          <table>
            <thead>
              <tr>
                <th>Nom</th>
                <th>Promotion</th>
                <th>Localisation</th>
                <th>Nombre d'avis effectués</th>
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


  
<?php
// Récupérez vos données depuis la base de données et encodez-les en JSON
$username = "max";
$password = "]$;8ytb]%n-Jg;^";
try {
    $pdo = new PDO('mysql:host=db.aws.gop.onl;dbname=max', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour obtenir le nom du secteur d'activité et le nombre d'apparitions
    $sql = "SELECT c.nom_centre, COUNT(e.id_compte) AS nombre_de_comptes
    FROM etudiant AS e
    JOIN etudie_dans AS ed ON e.id_compte = ed.id_compte
    JOIN Centre AS c ON ed.id_centre = c.id_centre
    GROUP BY c.nom_centre;
    ";
    $stmt = $pdo->query($sql);
    $data = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array($row['nom_centre'], intval($row['nombre_de_comptes']));
    }
    $json_data = json_encode($data);
//----------------------------------------------------------------------------------------------
    $sql2 = "SELECT p.nom_promo, COUNT(e.id_compte) AS nombre_de_comptes
    FROM etudiant AS e
    JOIN etudie_dans AS ed ON e.id_compte = ed.id_compte
    JOIN promo AS p ON ed.id_promo = p.id_promo
    GROUP BY p.nom_promo";

$stmt2 = $pdo->query($sql2);
$data2 = array();

while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $data2[] = array($row['nom_promo'], intval($row['nombre_de_comptes']));
}
$json_data2 = json_encode($data2);
 //----------------------------------------------------------------------------------------------
 $sql3 = "SELECT p.nom_promo, COUNT(e.id_compte) AS nombre_etudiants
 FROM promo AS p
 JOIN etudie_dans AS ed ON p.id_promo = ed.id_promo
 JOIN etudiant AS e ON ed.id_compte = e.id_compte
 GROUP BY p.nom_promo
 ORDER BY nombre_etudiants DESC;
 ";
 
   $stmt3 = $pdo->query($sql3);
   $data3 = array();
 
 
   while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
     $data3[] = array($row['nom_promo'], intval($row['nombre_etudiants']));
   }
 
   $json_data3 = json_encode($data3);
     //----------------------------------------------------------------------------------------------
     $sql4 = "SELECT CONCAT(c.nom, ' ', c.prenom) AS nom_etudiant, p.nom_promo, v.nom_ville, COUNT(a.id_compte) AS nombre_avis
     FROM etudiant AS e
     JOIN etudie_dans AS ed ON e.id_compte = ed.id_compte
     JOIN Centre AS ct ON ed.id_centre = ct.id_centre
     JOIN promo AS p ON ed.id_promo = p.id_promo
     JOIN adresse AS ad ON ct.id_adresse = ad.id_adresse
     JOIN se_localise AS sl ON ad.id_adresse = sl.id_adresse
     JOIN ville AS v ON sl.id_ville = v.id_ville
     JOIN compte AS c ON e.id_compte = c.id_compte
     LEFT JOIN Avis AS a ON e.id_compte = a.id_compte
     GROUP BY nom_etudiant, p.nom_promo, v.nom_ville
     ORDER BY nombre_avis DESC;";
     
       $stmt4 = $pdo->query($sql4);
       $data4 = array();
     
     
       while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
         $data4[] = array(
           $row['nom_etudiant'],
           $row['nom_promo'],
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
<script src="js/js_donut_etudiant.js" async defer></script>


</body>

</html>