<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Titre de la page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<?php

require_once("connexion.php");

// Vérifier si l'activité a été choisie (si la variable 'active' existe dans $_GET)
if (!isset($_GET["active"])) {
    // Si l'activité n'a pas été choisie, afficher le formulaire pour la sélection
    $stmt = $connexion->prepare("SELECT `libelle` FROM `activite`");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    
    echo "<form action='test.php' method='get'>";
    echo "<label>Activité : </label>";
    echo "<select name='active'>";
    
    // Boucle pour afficher toutes les activités
    while ($enregistrement = $stmt->fetch()) {
        echo "<option value='$enregistrement->libelle'>" . $enregistrement->libelle . "</option>";
    }
    
    echo "</select>";
    echo "<input type='submit' value='Voir les actions'>";
    echo "</form>";

} else {
    // Si une activité a été choisie, récupérer la valeur de 'active'
    $choix = $_GET["active"];

    // Récupérer les actions en fonction de l'activité choisie
    $stmt2 = $connexion->prepare("
        SELECT `numeroActivite`, `intitule` 
        FROM `action` 
        WHERE `numeroActivite` IN (SELECT `numero` FROM `activite` WHERE `libelle` = :libelle)
    ");
    $stmt2->bindParam(':libelle', $choix, PDO::PARAM_STR);
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_OBJ);

    // Afficher les actions pour l'activité choisie
    echo "<h2>Actions pour : " . htmlspecialchars($choix) . "</h2>";
    echo "<form><table border='2'>";

    if ($stmt2->rowCount() > 0) {
        while ($enregistrement = $stmt2->fetch()) {
            echo "<tr><td>" . htmlspecialchars($enregistrement->intitule) . "</td></tr>";
        }
    } else {
        echo "<tr><td>Aucune action disponible pour cette activité.</td></tr>";
    }

    echo "</table></form>";
}

?>

</body>

</html>
