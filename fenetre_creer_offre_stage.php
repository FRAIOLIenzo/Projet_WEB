<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Créer offre de stage</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style_fenetre_creer_offre_stage.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />



</head>


<body>


  <div class="box">
    <div class="box_connexion">
      <div class="box_connexion_contenu">
        <label class="titre-pop-up">Créer une offre</label>


        <form method="post" id="formulaire_creer_offre_de_stage">
        <div class="ligne">

          <input id="nom_offre" class="colonne-gauche" placeholder="Nom de l'offre" required />

          <input id="date_stage" class="colonne-milieu calendrier" type="text" placeholder="Dates de début" required />

          <input id="remuneration" class="colonne-droite" type="text" placeholder="Date de fin" required/>

        </div>



        <div class="ligne">


          <input id="competences" class="colonne-gauche" placeholder="Rémunération" required/>

          <input id="promo" class="colonne-milieu" placeholder="Promotion concernée" required/>

          <input id="secteur_activite" class="colonne-droite" placeholder="Secteurs d'activité" required />

        </div>



        <div class="ligne">

          <input id="adresse_mail" class="colonne-gauche" type="email" placeholder="Adresse mail" required />


          <input id="nombre_place" class="colonne-milieu" placeholder="Nombre de places" required/>

          <input id="code_postal" class="colonne-droite" placeholder="Code postal" required />



        </div>


        <div class="ligne">


          <select class="select-colonne-gauche" id="ville" placeholder="Ville"> </select>

          <input id="num_rue" class="colonne-milieu" placeholder="Numéro de rue" required/>

          <input id="nom_rue" class="colonne-droite" placeholder="Nom rue" required/>

        </div>



        <div class="ligne">
          <input id="description_annonce" class="description" placeholder="Description de l'annonce, compétences" required/>
        </div>




        
        <input type="submit" class="btn_creer_offre" value="Valider" />
        <form>
      </div>
    </div>
  </div>





  <script src="API/code_postal_ville.js"></script>

</body>

</html>