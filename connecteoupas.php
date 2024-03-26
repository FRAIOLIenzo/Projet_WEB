<?php
  // Vérifier si la session a déjà démarré
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // Vérifier si l'utilisateur est connecté en vérifiant la variable de session 'connected'
  if (!(isset($_SESSION['connected']) && $_SESSION['connected'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: Se_Connecter.php");
    exit;
  }
?>