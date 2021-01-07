<?php
require('./helpers.php');
$greske = validacija();

if (count($greske) === 0) {
  // Kreiranje novog foldera, ako već ne postoji
  $new_folder = './zelje_db';
  if (!is_dir($new_folder)) {
    $oldmask = umask(0);
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
  header('Location: javascript:history.go(-1)');
}
