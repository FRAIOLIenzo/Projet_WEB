<?php
// traitement.php

// Vérification si la requête AJAX a été envoyée
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Vérification si les données nécessaires sont présentes
    if (isset($_POST["rating"]) && isset($_POST["entrepriseId"])) {
        // Récupération des données envoyées depuis JavaScript
        $rating = $_POST["rating"];
        $entrepriseId = $_POST["entrepriseId"];
        
        // Vous pouvez utiliser ces valeurs pour effectuer des actions, telles que la mise à jour de la base de données
        
        // Exemple : Mise à jour de la note dans la base de données
        // $pdo = new PDO('mysql:host=your_host;dbname=your_database', 'username', 'password');
        // $stmt = $pdo->prepare("UPDATE entreprise SET note = :rating WHERE id = :entrepriseId");
        // $stmt->bindParam(':rating', $rating);
        // $stmt->bindParam(':entrepriseId', $entrepriseId);
        // $stmt->execute();
        
        // Vous pouvez envoyer une réponse à JavaScript si nécessaire
        echo "La note $rating a été enregistrée pour l'entreprise avec l'ID $entrepriseId.";
    } else {
        // Réponse si des données sont manquantes
        http_response_code(400); // Bad Request
        echo "Des données sont manquantes.";
    }
} else {
    // Réponse si ce n'est pas une requête AJAX
    http_response_code(403); // Forbidden
    echo "Accès refusé.";
}
?>