<?php

require_once('connexion.php');

if (!isset($_POST['btnSeConnecter'])) { /* L'entrée btnSeConnecter est vide = le formulaire n'a pas été submit=posté, on affiche le formulaire */

    echo '

    <form action="" method = "post" ">

        Nom: <input name="nom" type="text" size ="30"">

        Prenom: <input name="prenom" type="text" size ="30"">

        Adresse: <input name="adresse" type="text" size ="30"">

        <input type="submit" name="btnSeConnecter"  value="Ok">

    </form>';

} else
 
{
    $stmt = $connexion->prepare("INSERT INTO formulaire (nom, prenom, adresse) VALUES (:nom, :prenom, :adresse)");

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
 

    $stmt->bindValue(':nom', $nom, PDO::PARAM_STR_CHAR);

    $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR_CHAR);

    $stmt->bindValue(':adresse', $adresse, PDO::PARAM_STR_CHAR);


    $stmt->execute();

    $nb_ligne_affectees = $stmt->rowCount();

    echo $nb_ligne_affectees." ligne() insérée(s).<BR>";
}

?>