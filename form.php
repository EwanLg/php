<?php
$nb = $_GET["txtNumber"];
echo "<table border=2>";
for ($x = 0; $x <= 10; $x++)
    echo "<tr><td>".$x." * ".$nb." =  </td><td>".$x*$nb."</td></tr>";
echo "</table>";
?>

</body>
</html>