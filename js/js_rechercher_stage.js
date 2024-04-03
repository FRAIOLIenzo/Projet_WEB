$(document).ready(function() {
  $('.img_plus').click(function() {
      var popupId = $(this).parent().attr('data-popup-id');
      var popup = $('#popup_offre_de_stage' + popupId);
      if (popup.length) {
          $('#overlay').show();
          popup.show();
      }
  });

  $('.btn_annuler').click(function() {
      $(this).closest('.popup_offre_de_stage').hide();
      $('#overlay').hide();
  });

  $('.btn_postuler').click(function() {
      $('#popup_postuler').show();
      $(this).closest('.popup_offre_de_stage').hide();
      $('#overlay').show();
  });

  $('#popup_postuler .btn_annuler').click(function() {
      $('#popup_postuler').hide();
      $('#overlay').hide();
  });

  $('#popup_postuler .btn_envoyer').click(function() {
      $('#popup_postuler').hide();
      $('#overlay').hide();
  });

  $('.img_wishlist').click(function() {
      var currentSrc = $(this).attr('src');
      if (currentSrc === 'image/bookmark.png') {
          $(this).attr('src', 'image/bookmark_2.png');
      } else {
          $(this).attr('src', 'image/bookmark.png');
      }
  });

  // Gestionnaire d'événements pour la recherche dynamique
  $('#text_recherche').on('input', function() {
      var searchTerm = $(this).val().toLowerCase();
      $('.offre_stage').each(function() {
          var domaine = $(this).find('.text_domaine_stage').text().toLowerCase();
          var entreprise = $(this).find('.nom_entreprise').text().toLowerCase();
          if (domaine.startsWith(searchTerm) || entreprise.startsWith(searchTerm)) {
              $(this).show();
          } else {
              $(this).hide();
          }
      });
  });


  document.getElementById('custom_btn').addEventListener('click', function() {
  document.getElementById('file_input').click();
});

document.getElementById('file_input').addEventListener('change', function() {
    // Gérer le fichier sélectionné
    var selectedFile = this.files[0];
    console.log(selectedFile);
});


});