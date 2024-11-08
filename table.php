<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Titre de la page</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

<?php
$nb = 8;
echo "<table border=2>";
for ($x = 0; $x <= 10; $x++)
    echo "<tr><td>".$x." * ".$nb." =  </td><td>".$x*$nb."</td></tr>";
echo "</table>";
?>

</body>
</html>