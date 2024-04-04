<html>
<style>
    table {
        border: 1px solid black;
    }
    tr td{
        border: 1px solid black;
    }
    th {
        border: 1px solid black;
    }
</style>
<?php
$data = file('Data.txt');//à compléter. Lire le fichier Data.txt dans $data avec la fonction file

if ($data !== false) {
    //à compléter. Affichage du tableau HTML
    ?>

    <table>

        <tr>
            
        <?php
        // Tout d'abord, nous allons afficher l'entête du fichier Data.txt ( ID	Nom	Prénom	DateNaissance)
        $header = explode(",", $data[0]);//à compléter. Ajouter le séparateur 
        foreach ($header as $firstligne) {
        //à compléter. Afficher les éléments de la premiere ligne du tableau  avec htmlspecialchars
        echo "<th>" . $firstligne . "</th>"; // echo pour afficher la première ligne
        }
        ?>

        </tr>

        <?php
        $c = count($data);// la fonction count() est utilisée pour compter le nombre de lignes dans le tableau
        for ($i = 1; $i < $c; $i++) { //à compléter. Pour afficher les autres elements du tableau
            ?>

            <tr>

            <?php
            $cdata = explode(",", $data[$i]); // compléter la fonction explode 
            foreach ($cdata as $cl) {
            // à compléter. Afficher les éléments de la première ligne du tableau (ID Nom	Prénom	DateNaissance) avec htmlspecialchars
            echo "<td>" . $cl . "</td>"; 
            }
            ?>

            </tr>

        <?php } ?>

    </table>

<?php
} 
else 
{
    echo "ERREUR LECTURE FICHIER";
}
?>
</html>
