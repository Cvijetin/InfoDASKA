<?php 

include "pdo.php";

$query = $db->query("SELECT * FROM autor;");
$autor = $query->fetchAll();

// ovo mijenjat po potrebi
$query = $db->query("select * from rad order by datumprijaverada desc;");
$rad = $query->fetchAll();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    

  <table class="table table-dark">
  <thead>
    <tr>
      <!-- Autor -->
      <th scope="col">Sifra</th>
      <th scope="col">Ime</th>
      <th scope="col">Prezime</th>
      <th scope="col">E-mail</th>
      <th scope="col">Fakultet</th>
      <th scope="col">Datum (autor)</th>

      <!-- Rad -->
<<<<<<< HEAD
     
=======
      <th scope="col">Sifra</th>
      <th scope="col">Naslov</th>
      <th scope="col">Sažetak</th>
      <th scope="col">Ključne riječi</th>
      <th scope="col">Datum (rad)</th>
>>>>>>> fbe0788da58cdddd606f6808f983e470fa9ae4a4

    </tr>
  </thead>
  <tbody>

  <?php

foreach ($autor as $autori) {

    echo "<tr><td>" . $autori["sifra"] . "</td>" .
         "<td>" . $autori["ime"] . "</td>" .
         "<td>" . $autori["prezime"] . "</td>" .
         "<td>" . $autori["email"] . "</td>" .
         "<td>" . $autori["fakultet"] . "</td>" .
<<<<<<< HEAD
         "<td>" . $autori["datumprijave"] . "</td></tr>";
=======
         "<td>" . $autori["datumprijave"] . "</td>";
}

foreach ($rad as $radovi) {

    echo "<td>" . $radovi["sifra"] . "</td>" .
         "<td>" . $radovi["naslov"] . "</td>" .
         "<td>" . $radovi["sazetak"] . "</td>" .
         "<td>" . $radovi["kljucnerijeci"] . "</td>" .
         "<td>" . $radovi["datumprijaverada"] . "</td></tr>";
         
>>>>>>> fbe0788da58cdddd606f6808f983e470fa9ae4a4
}

?>

</tbody>
</table>


<<<<<<< HEAD
<table class="table table-dark">
  <thead>
    <tr>
<th scope="col">Sifra</th>
      <th scope="col">Naslov</th>
      <th scope="col">Sažetak</th>
      <th scope="col">Ključne riječi</th>
      <th scope="col">Datum (rad)</th>
      </tr>
  </thead>
  <tbody>
<?php

      foreach ($rad as $radovi) {

echo "<tr><td>" . $radovi["sifra"] . "</td>" .
     "<td>" . $radovi["naslov"] . "</td>" .
     "<td>" . $radovi["sazetak"] . "</td>" .
     "<td>" . $radovi["kljucnerijeci"] . "</td>" .
     "<td>" . $radovi["datumprijaverada"] . "</td></tr>";
     
}

?>

=======
>>>>>>> fbe0788da58cdddd606f6808f983e470fa9ae4a4
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>