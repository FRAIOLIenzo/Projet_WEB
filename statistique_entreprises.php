<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Statistiques</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_navbar.css" />
    <link rel="stylesheet" href="style/style_footer.css" />
    <link rel="stylesheet" href="style/style_statistique_entreprise.css" />
    
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="js/js_donut_campus.js" async defer></script>
    <script src="js/js_donut_secteur_activite.js" async defer></script>
    

  </head>
  <body>
  <?php include 'Navbar.php'; ?>


    <main>
     
    
    <div class="emplacement_titre">
    <h1 class="tableau_de_bord">Tableau de bord</h1>
    </div>


    <div class="menu">
        <ul>
          
            <li class="active"><a href="statistique_offres_stage.html">Offres</a></li>
          
          
          <li><a href = "statistique_etudiant.html">Étudiants</a></li>
          <div class="square">
          <li><a href="#">Entreprise</a></li>
          </div>
        </ul>
    </div>



      <div class="box">

        <div class="box_connexion emplacement_box_gauche">
          <div class="box_connexion_contenu">
            
            <div class = "secteur_activite">
          
              <h1>Répartition par secteur d'activité</h1>
              <div class = "donut" id="donut_secteur_activite"></div>
    
            </div>
          </div>
        </div>

        <div class="box_connexion emplacement_box_milieu">
          <div class="box_connexion_contenu">
            
            <div class = "localisation">
          
              <h1>Répartition par localisation</h1>
              <div class = "donut" id="donut_campus"></div>
    
            </div>
          </div>
        </div>


        <div class="box_connexion emplacement_box_droite">
          <div class="box_connexion_contenu">
            
            <div class = "entreprise_note">
          
              <h1>Entreprises les mieux notées</h1>

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


        <div class="box_connexion emplacement_tableau">
          <div class="box_connexion_contenu">
            
            <div class = "tableau_offre">
          
              <h1>Annonces les plus solicitées</h1>

              <table>
               
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th >Secteurs d'activité</th>
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
        


      



      </div>




    </main>




    <?php include 'footer.php'; ?>


  </body>
</html>
