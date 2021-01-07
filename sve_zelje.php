<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sve želje</title>
</head>

<body>
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
        $filename = $wishes_dir . '/' . $wish_url;
        $h = fopen($filename, 'r');
        $json_entry = fread($h, filesize($filename));
        $wish = json_decode($json_entry, true);
        echo '<tr>';
        foreach ($wish as $field) {
          echo '<td>' . $field . '</td>';
        }
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
</body>

</html>