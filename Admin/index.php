<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    
<table with="100">
<thead>
<tr>
      <th>Ime</th>
      <th>Prezime</th>
      <th>Naslov</th>
      <th>Vrijeme</th>
</tr>
</thead>
<tbody>

<?php

include "pdo.php";

$query = $db->query("SELECT * FROM autorrad");
$autorrad = $query->fetchAll();

$query = $db->query("SELECT * FROM autor");
$autor = $query->fetchAll();

$query = $db->query("SELECT * FROM rad ORDER BY datuprijave DESC");
$rad = $query->fetchAll();


foreach ($autor as $autori) {

    echo "<tr><td>" . $autori["ime"] . "</td>";
    echo "<td>" . $autori["prezime"] . "</td>";

    foreach ($rad as $radovi) {

        echo "<td>" . $radovi["naslov"] . "</td>";
        echo "<td>" . $radovi["datumprijaverada"] . "</td></tr>";
    }

}



?>

</tbody>
</table>

</body>
</html>