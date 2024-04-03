$(document).ready(function () {
  // Code pour afficher la popup et gérer l'annulation
  $(".img_star").click(function () {
      var popupId = $(this).parent().attr("data-popup-id");
      var popup = $("#popup_avis_entreprise" + popupId);
      if (popup.length) {
          $("#overlay").show();
          popup.show();
      }
  });

  $(".btn_annuler").click(function () {
      // Cacher la popup
      var popup = $(this).closest(".popup_avis_entreprise");
      popup.hide();
      $("#overlay").hide();
      
      // Réinitialiser les étoiles à leur état vide
      popup.find(".etoiles_avis").attr("src", "image/etoile_avis_vide.png");
      
      // Réinitialiser le texte dans la zone de texte
      popup.find(".commentaire_avis").val("");
  });

  // Code pour gérer le clic sur les étoiles et les remplir progressivement
  $(".etoiles_avis").click(function () {
      // Obtenir l'index de l'image d'étoile sur laquelle on a cliqué
      var clickedIndex = $(this).index();

      // Parcourir toutes les images d'étoiles
      $(this).siblings().addBack().each(function (index) {
          // Si l'index de l'image d'étoile actuelle est inférieur ou égal à l'index de l'étoile cliquée, mettre à jour son attribut src
          if (index <= clickedIndex) {
              $(this).attr("src", "image/etoile_avis.png");
          } else {
              // Sinon, mettre à jour l'image d'étoile avec l'image vide
              $(this).attr("src", "image/etoile_avis_vide.png");
          }
      });
  });



  
  // Gestionnaire d'événements pour la recherche dynamique
  $('#text_recherche').on('input', function() {
    var searchTerm = $(this).val().toLowerCase();
    $('.aff_entreprise').each(function() {
        var entreprise = $(this).find('.nom_entreprise').text().toLowerCase();
        if (entreprise.startsWith(searchTerm)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});

});
