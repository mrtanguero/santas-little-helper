<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sve želje</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>

<body>
  <div class="container table-page">
    <h1>🎅️ Lista svih želja 🎅️</h1>
    <table>
      <thead>
        <tr>
          <th>Ime</th>
          <th>Prezime</th>
          <th>Grad</th>
          <th>Želja</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $wishes_dir = './zelje_db';
        $wishes_arr = scandir($wishes_dir);
        foreach ($wishes_arr as $wish_url) {
          if ($wish_url === '.' || $wish_url === '..') {
            continue;
          }
          // Kreiranje fajl urla i čitanje jed(i)ne linije iz njega
          $filename = $wishes_dir . '/' . $wish_url;
          $h = fopen($filename, 'r');
          $json_entry = fgets($h);
          fclose($h);

          // Dekodiranje JSON-a i vraćanje podataka iz niza u ćelije tabele
          $wish = json_decode($json_entry, true);
          echo '<tr>';
          foreach ($wish as $field) {
            echo '<td>' . $field . '</td\n>';
          }
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>