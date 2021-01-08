<?php
require('./helpers.php');
$greske = validacija();

if (count($greske) === 0) {
  // Kreiranje novog foldera, ako već ne postoji
  $new_folder = './zelje_db';
  if (!is_dir($new_folder)) {
    $oldmask = umask(0); // riješenje problema sa permissionima
    mkdir($new_folder);
    umask($oldmask);
  }

  // Kreiranje novog fajla i pisanje u njega
  $new_file = $new_folder . '/' . uniqid() . '.txt';
  $h = fopen($new_file, 'w');
  fwrite($h, json_encode(create_arr($_POST)));
  fclose($h);

  header('Location: ./zelja_poslata.html');
  exit();
} else {
  echo json_encode($_POST);
  print_r($greske);
  header(
    'Location: ./index.html'
      . '?query=' . json_encode($_POST)
      . '&errors=' . json_encode($greske)
  );
}
