<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>noStage</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_navbar.css" />
    <link rel="stylesheet" href="style/style_gerer_entreprises.css" />
    <script src="js/js_recherche_pilote.js" defer></script>

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
  </head>
  <body>
  <?php include 'Navbar.php'; ?>


    <main>
      <div class="container2">
        <div class="menu">
          <ul>
            <li><a href="gerer_pilotes.php">Pilotes</a></li>

<<<<<<< HEAD
            <li><a href="gerer_offres.php">Offres</a></li>
=======
            <li><a href="#">Offres</a></li>
>>>>>>> 877d3bcd8ce6109493d250b1998ca4a8934939c1
            <li><a href="gerer_etudiants.php">Étudiants</a></li>
            <div class="square">
              <li><a class="active" href="gerer_entreprises.php">Entreprise</a></li>
            </div>
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
                <img class="imgplus" src="image/plus.png" />Ajouter des
                entreprises via un fichier CSV
              </button>
              <button onclick="openPopup1()" class="btnajouter">
                <img class="imgplus" src="image/plus.png" />Ajouter une entreprise
              </button>
            </div>
          </div>
          <div class="table-container">
            <table>
              <tr>
                <th class="bordure">#</th>
                <th class="bordure">Nom</th>
                <th class="bordure">Secteur d'activitée</th>
                <th class="bordure">Ville</th>
                <th class="bordure">Mail</th>
                <th class="bordure">Telephone</th>
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

      <div id="popupmodifier">
        <div class="popupcontent">
          <div id="creertxt">Modifier le profil de l'entreprise</div>

          <form
            action="/votre-page-de-traitement"
            method="post"
            class="formcreer1"
          >
            <div id="nomprenom">
              <input
                type="text"
                id="prenom"
                name="prenom"
                placeholder="Prénom"
                required
              />
              <input
                type="text"
                id="nom"
                name="nom"
                placeholder="Nom"
                required
              />
            </div>
            <select id="centre" name="centre">
              <option value="" disabled selected>Centre</option>

              <option value="centre1">Centre 1</option>
              <option value="centre2">Centre 2</option>
              <option value="centre3">Centre 3</option>
            </select>
            <select id="promotion" name="promotion">
              <option value="" disabled selected>Promotion</option>
              <option value="promotion1">Promotion 1</option>
              <option value="promotion2">Promotion 2</option>
              <option value="promotion3">Promotion 3</option>
            </select>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Adresse e-mail"
              required
            />
            <input
              type="password"
              id="motdepasse"
              name="motdepasse"
              placeholder="Mot de passe"
              required
            />
            <input type="submit" value="Valider" />
          </form>
          <div id="closecircle"></div>

          <img id="close" src="image/close.png" onclick="openPopup2()" />
        </div>
      </div>

      <div id="popupajout1">
        <div class="popupcontent">
          <div id="creertxt">Créer le profil d'entreprise</div>

          <form
            action="/votre-page-de-traitement"
            method="post"
            class="formcreer1"
          >
            <div id="nomprenom">
              <input
                type="text"
                id="prenom"
                name="prenom"
                placeholder="Prénom"
                required
              />
              <input
                type="text"
                id="nom"
                name="nom"
                placeholder="Nom"
                required
              />
            </div>
            <select id="centre" name="centre">
              <option value="" disabled selected>Centre</option>

              <option value="centre1">Centre 1</option>
              <option value="centre2">Centre 2</option>
              <option value="centre3">Centre 3</option>
            </select>
            <select id="promotion" name="promotion">
              <option value="" disabled selected>Promotion</option>
              <option value="promotion1">Promotion 1</option>
              <option value="promotion2">Promotion 2</option>
              <option value="promotion3">Promotion 3</option>
            </select>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Adresse e-mail"
              required
            />
            <input
              type="password"
              id="motdepasse"
              name="motdepasse"
              placeholder="Mot de passe"
              required
            />
            <input type="submit" value="Valider" />
          </form>
          <div id="closecircle"></div>

          <img id="close" src="image/close.png" onclick="openPopup1()" />
        </div>
      </div>

      <div id="popupsuppr">
        <div class="popupsuppr-content">
          <div id="txtpopupsuppr">
            Voulez-vous supprimer cette entreprise de manière définitive ?
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