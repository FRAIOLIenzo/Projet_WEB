<?php 
$username= "max"; 
$password= "]$;8ytb]%n-Jg;^";
try {
    $db = new PDO('mysql:host=db.aws.gop.onl;dbname=max', $username, $password);
    }
 catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();}
?>