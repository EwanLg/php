<html>

<body>

<?php 

try {

    $dns = 'mysql:host=localhost;dbname=bddformation'; 

    $utilisateur = 'root';

    $motDePasse = ''; 

    $connection = new PDO( $dns, $utilisateur, $motDePasse );

  } catch (Exception $e) {

      echo "Connexion à MySQL impossible : ", $e->getMessage();

      die();

  }


$select = $connection->query("SELECT * FROM agent WHERE codePostal LIKE 33000 ORDER BY codePostal DESC");

$select->setFetchMode(PDO::FETCH_OBJ);

echo "<table border=2>";
while($enregistrement = $select->fetch())

{

 echo "<tr><td>".$enregistrement->nom."</td><td>".$enregistrement->prenom."</td><td>".$enregistrement->adresse1."</td></tr>";

}
echo "</table>";
?>

</body>

</html>