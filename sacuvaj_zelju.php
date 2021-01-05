<?php
$cities = [
  'pg' => 'Podgorica',
  'nk' => 'Nikšić',
  'pv' => 'Pljevlja',
  'bp' => 'Bijelo Polje',
  'ct' => 'Cetinje',
  'br' => 'Bar',
  'hn' => 'Herceg Novi',
  'ba' => 'Berane',
  'ul' => 'Ulcinj',
  'tv' => 'Tivat',
  'ro' => 'Rožaje',
  'ko' => 'Kotor',
  'dg' => 'Danilovgrad',
  'mk' => 'Mojkovac',
  'pl' => 'Plav',
  'kl' => 'Kolašin',
  'zb' => 'Žabljak',
  'pz' => 'Plužine',
  'an' => 'Andrijevica',
  'sv' => 'Šavnik'
];
$abeceda = "/a-zčćžđ/i";
$wish_list = $_POST;
$first_name = $wish_list['first-name'];
$last_name = $wish_list['last-name'];
$city = $cities[$wish_list['city']];
?>
<!DOCTYPE html>
<html lang="sr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sačuvaj želju</title>
  <link rel="stylesheet" href="./style.css" />
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>

<body>
  <div class="container confirmation-container">
    <?php
    echo '<h2>🎅️ Tvoja želja je uspješno evidentirana! 🎅️</h2>';
    echo "Ime: $first_name, Prezime: $last_name, Grad: $city";
    if (ctype_alpha($first_name)) {
      echo '<p>Ime je ok!<p>';
    }
    ?>
  </div>
  <!-- Pahulje -->
  <script src="https://unpkg.com/magic-snowflakes/dist/snowflakes.min.js"></script>
  <script>
    const sf = new Snowflakes({
      color: "#ffffff",
      count: 100,
      speed: 1.5,
      minSize: 15,
      maxSize: 30,
    });
  </script>
</body>

</html>