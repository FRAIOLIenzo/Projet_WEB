<?php 
$username= "sql11692929"; 
$password= "lBxIuH8Sie";
try {
    $db = new PDO('mysql:host=sql11.freesqldatabase.com;dbname=sql11692929', $username, $password);
    }
 catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();}
?>