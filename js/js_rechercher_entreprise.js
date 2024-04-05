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

    popup.find(".etoiles_avis").attr("src", "image/etoile_avis_vide.png");
    popup.find(".commentaire_avis").val("");
  });

  // Code pour gérer le clic sur les étoiles et les remplir progressivement
  $(".etoiles_avis").click(function () {
    var clickedIndex = $(this).index();

    $(this)
      .siblings()
      .addBack()
      .each(function (index) {
        if (index <= clickedIndex) {
          $(this).attr("src", "image/etoile_avis.png");
        } else {
          $(this).attr("src", "image/etoile_avis_vide.png");
        }
      });
  });

  // Gestionnaire d'événements pour la recherche dynamique
  $("#text_recherche").on("input", function () {
    var searchTerm = $(this).val().toLowerCase();
    $(".aff_entreprise").each(function () {
      var entreprise = $(this).find(".nom_entreprise").text().toLowerCase();
      if (entreprise.startsWith(searchTerm)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});
