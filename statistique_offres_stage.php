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

        

          <h1>Offres les mieux notées</h1>

            <div class="emplacement_box_droite">
              <ol>
                <li>Maxime</li>
                <li>Alexis</li>
                <li>Enzo</li>
                <li>Maxime</li>
                <li>Alexis</li>
                <li>Enzo</li>

              </ol>
            </div>


          
        </div>
      </div>
      </div>

    


    <div class="container_box_tableau">
      <div class="box_stats_tableau">

        <div class="tableau_offre">

          <h1>Annonces les plus solicitées</h1>

          <table>

            <thead>
              <tr>
                <th>Nom</th>
                <th>Secteurs d'activité</th>
                <th>Localisation</th>
                <th>Promotions concernées</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>Programmeur</td>
                <td>informatique</td>
                <td>Nancy</td>
                <td>
                  CPI A2
                </td>
              </tr>

              <tr>
                <td>Programmeur</td>
                <td>informatique</td>
                <td>Nancy</td>
                <td>
                  CPI A2
                </td>
              </tr>

              <tr>
                <td>Programmeur</td>
                <td>informatique</td>
                <td>Nancy</td>
                <td>
                  CPI A2
                </td>
              </tr>


              <tr>
                <td>Programmeur</td>
                <td>informatique</td>
                <td>Nancy</td>
                <td>
                  CPI A2
                </td>
              </tr>



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

<script src="js/js_donut_offres.js" async defer></script>


</html>
