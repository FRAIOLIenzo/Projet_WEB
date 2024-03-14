<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Créer offre de stage</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_fenetre_creer_offre_stage.css"/>
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
            <label class="titre-pop-up">Créer une offre</label>

         

            <div class="ligne">

                <input id="nom_offre" class = "colonne-gauche" placeholder="Nom de l'offre"/>

                <input id="date_stage"  class = "colonne-milieu"  placeholder="Dates de stage"/>

                <input id="remuneration" class = "colonne-droite" placeholder="Rémunération"/>

            </div>



            <div class = "ligne">

       
                <input id="competences" class = "colonne-gauche"  placeholder="Compétences"/>

                <input id="promo" class = "colonne-milieu" placeholder="Promotion concernée"/>

                <input id="secteur_activite" class = "colonne-droite" placeholder="Secteurs d'activité"/>

            </div>

            <div class = "ligne">

                <input id="adresse_mail"  class = "colonne-gauche" placeholder="Adresse mail"/>

                <input id="localisation" class = "colonne-milieu" placeholder="Localisation"/>

                <input id="Nombres_place" class = "colonne-droite" placeholder="Nombre de places"/>

            </div>

            

            <div class = "ligne">
            <input id="description_annonce"  class = "description" placeholder="Description de l'annonce"/>
            </div>

        

     
            <button class="btn_creer_offre">Créer une offre</button>
        </div>
          </div>
        </div>
      </div>




    

  </body>
</html>
