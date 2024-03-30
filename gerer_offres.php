<?php include 'connecteoupas.php'; ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>noStage</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style_navbar.css" />
  <link rel="stylesheet" href="style/style_gerer_offres.css" />
  <link rel="stylesheet" href="style/style_fenetre_creer_offre_stage.css" />
  <script src="API/code_postal_ville.js" defer></script>


  <script src='js/js_verification_formulaire.js'></script>

  <script src="js/js_gerer.js" defer></script>


  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>




<body>
  <?php include 'Navbar.php'; ?>
  <?php
  if (!(isset($_SESSION['statut']) && ($_SESSION['statut'] == 'admin') || $_SESSION['statut'] == 'enseignant')) {
    header('Location: pasacces.php');
  }
  ?>
  <main>
    <div class="container2">
      <div class="menu">
        <ul>
          <li><a href="gerer_pilotes.php">Pilotes</a></li>
          <div class="square">
            <li class="active"><a href="#">Offres</a></li>
          </div>
          <li><a href="gerer_etudiants.php">Étudiants</a></li>
          <li><a href="gerer_entreprises.php">Entreprise</a></li>
        </ul>
      </div>
      <div class="squaredg">
        <div class="headertab">
          <div class="search-container">
            <input type="search" id="searchbar" placeholder="Rechercher..." />
            <img id="imgsearch" src="image/loupe.png" />
          </div>
          <div class="btncountainer">
            <button class="btnajouter">
              <img class="imgplus" src="image/plus.png" />Ajouter des offres
              via un fichier CSV
            </button>
            <button onclick="openPopup1()" class="btnajouter">
              <img class="imgplus" src="image/plus.png" />Ajouter une offre
            </button>
          </div>
        </div>
        <div class="table-container">
          <table>
            <tr>
              <th class="bordure">#</th>
              <th class="bordure">Secteur d'activité</th>
              <th class="bordure">Entreprises</th>
              <th class="bordure">Date de début</th>
              <th class="bordure">Date de fin</th>
              <th class="bordure">Rémunération</th>
              <th class="bordure"></th>
            </tr>

            <tbody id="myTable"></tbody>
          </table>
        </div>
      </div>
    </div>

    <div id="popupautre">
      <div onclick="openPopup2()">
        <img src="image/edit.png" />
        Modifier
      </div>
      <div onclick="openPopup3()">
        <img src="image/delete.png" />
        Supprimer
      </div>
    </div>
    <!-- 
    <div id="popupmodifier">
      <div class="box">
        <div class="box_connexion">
          <div class="box_connexion_contenu">
            <label class="titre-pop-up">Modifier une offre</label>

            <div class="ligne">

              <input id="nom_offre" class="colonne-gauche" placeholder="Nom de l'offre" />

              <input id="date_stage" class="colonne-milieu calendrier" type="text" placeholder="Dates de début" />

              <input id="remuneration" class="colonne-droite" type="text" placeholder="Date de fin" />

            </div>


            <div class="ligne">


              <input id="competences" class="colonne-gauche" placeholder="Rémunération" />

              <input id="promo" class="colonne-milieu" placeholder="Promotion concernée" />

              <input id="secteur_activite" class="colonne-droite" placeholder="Secteurs d'activité" />

            </div>



            <div class="ligne">

              <input id="adresse_mail" class="colonne-gauche" type="email" placeholder="Adresse mail" />


              <input id="nombre_place" class="colonne-milieu" placeholder="Nombre de places" />

              <input id="code_postal" name="code_postal" class="colonne-droite" placeholder="Code postal" />



            </div>


            <div class="ligne">


              <select class="select-colonne-gauche" id="ville" placeholder="Ville"> </select>

              <input id="num_rue" class="colonne-milieu" placeholder="Numéro de rue" />

              <input id="nom_rue" class="colonne-droite" placeholder="Nom rue" />

            </div>



            <div class="ligne">
              <textarea id="description_annonce" class="description" placeholder="Description de l'annonce, compétences"></textarea>
            </div>

            <div id="closecircle"></div>

            <img id="close" src="image/close.png" onclick="openPopup2()" />




            <button class="btn_creer_offre">Créer une offre</button>
          </div>
        </div>
      </div>

    </div> -->

    <div id="popupajout1">
      <div class="box">
        <div class="box_connexion">
          <div class="box_connexion_contenu">
            <label class="titre-pop-up">Ajouter une offre</label>
            <form id="creer_offre">
              <div class="offre_page_1sur2">
                <div class="conteneur_page_1_creer_offre">
                  <div class="partie_gauche">

                    <div class="ligne">
                      <input id="nom_offre" placeholder="Nom de l'offre" />
                    </div>

                    <a id="verif_nom_offre"></a>

                    <div class="ligne">
                      <input id="nom_entreprise" placeholder="Nom de l'entreprise" />
                    </div>

                    <a id="verif_nom_entreprise"></a>

                    <div class="ligne">

                      <input id="nombre_place" type="number" placeholder="Nombre de place" />
                    </div>

                    <div class="ligne">
                      <input id="promo_concernees" type="email" placeholder="Promo concernées" />
                    </div>

                    <a id="verif_promo_concernees"></a>
                  </div>

                  <div class="trait"></div>
                  <div class="partie_droite">

                    <div class="ligne">
                      <input id="code" name="code" placeholder="Code postal" />
                    </div>
                    <a id="verif_code_postal"></a>



                    <div class="ligne">

                      <select id="ville_sortie" placeholder="Ville"> </select>
                    </div>

                    <div class="ligne">

                      <input id="num_rue" type="number" placeholder="Numéro rue" />


                    </div>

                    <div class="ligne">
                      <input id="nom_rue" placeholder="Nom rue" />

                    </div>

                    <a id="verif_nom_rue"></a>
                    <div class="positionnement_btn_suivant_1">
                      <button class="btn_suivant_1" onclick="offre_page_vers_2sur2()"> Suivant</button>
                    </div>

                  </div>

                </div>



              </div>

              <div class="offre_page_2sur2">

                <div class="ligne_2 premiere_ligne">
                  <label for="date_debut">Date de début :</label>
                  <input id="date_debut" type="date" class="colonne-gauche" />
                </div>

                <div class="ligne_2">
                  <label for="date_debut">Date de fin : </label>
                  <input id="date_fin" type="date" class="colonne-gauche" />

                </div>
                <div class="virgule">
                <label > Veuillez séparer les compétences avec une virgule </label>
                </div>
                <div class="ligne_2_de3">
                
                  <input id="competence" class="colonne-gauche" placeholder=" Compétences" />

                  <input id="secteur_activite" class="colonne-gauche"  placeholder="Secteur d'activité" />
                  <input id="duree_stage" class="colonne-milieu" type="number" placeholder="Durée stage (sem)" />

                </div>

                <div class="ligne">
                  <textarea id="description_annonce" class="description" placeholder="Description de l'annonce"></textarea>
                </div>

                <div class="btn_prece_valid">
                  <button class="btn_precedent_1" onclick="offre_page_vers_1sur2()"> Précédent</button>
                  <button class="btn_valider" type="submit"> Valider</button>
                </div>

              </div>


            </form>

            <div id="closecircle"></div>

            <img id="close" src="image/close.png" onclick="openPopup1()" />





            <form>
              <div id="closecircle"></div>

              <img id="close" src="image/close.png" onclick="openPopup1()" />

          </div>
        </div>
      </div>
    </div>
    </div>
    </div>

    <div id="popupsuppr">
      <div class="popupsuppr-content">
        <div id="txtpopupsuppr">
          Voulez-vous supprimer ce pilote de manière définitive ?
        </div>
        <div>
          <button id="Supprimer">Supprimer</button>
          <button id="Annuler" onclick="openPopup3()">Annuler</button>
        </div>
      </div>
    </div>



  </main>

  <?php include 'footer.php'; ?>

</body>

</html>