<?php

require_once('connexion.php');

$stmt = $connexion->prepare("SELECT * FROM agent WHERE codePostal LIKE 33000 ORDER BY codePostal DESC");

$stmt->setFetchMode(PDO::FETCH_OBJ);

// Les résultats retournés par la requête seront traités en 'mode' objet

$stmt->execute();

 

// Parcours des enregistrements retournés par la requête : premier, deuxième…
echo "<table border=2>";
while($enregistrement = $stmt->fetch())

{

  // Affichage des champs nom et prenom de la table 'utilisateur'

  echo "<tr><td>".$enregistrement->nom."</td><td>".$enregistrement->prenom."</td><td>".$enregistrement->adresse1."</td></tr>";
 
}
 echo "</table>";
?>