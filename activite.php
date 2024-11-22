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
if(!isset($_GET["active"])){
    $stmt = $connexion->prepare("SELECT `libelle` FROM `activite`");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    echo "<form action='activite.php' method='get'>";
    echo "<label>Activité : </label>";
    echo "<select name='active'>";
    while($enregistrement = $stmt->fetch())

    {

        echo "<option value='$enregistrement->libelle'>".$enregistrement->libelle."</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Choisir'>";
    echo "</form>";
}  else { 
    $choix = $_GET["active"];
    $stmt2 = $connexion->prepare("SELECT `numeroActivite`, `intitule` FROM `action` WHERE `numeroActivite` IN (SELECT `numero` FROM `activite` WHERE `libelle` = :libelle)");
    $stmt2->bindParam(':libelle', $choix, PDO::PARAM_STR);
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_OBJ);

    echo "Actions  pour ".$choix." :";
    echo "

    <form>

    <table border='2'>";
    if ($stmt2->execute()) {
        while($enregistrement = $stmt2->fetch())
        {

            echo "
            <tr>
            <td>".$enregistrement->intitule."</td>
            </tr>";
    
        }
    }
}
    echo "</table>

    </form>";
?>

</body>

</html>   