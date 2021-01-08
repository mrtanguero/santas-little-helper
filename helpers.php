<?php

$cities = [
  'pg' => 'Podgorica',
  'nk' => 'Nikšić',
  'pv' => 'Pljevlja',
  'bp' => 'Bijelo Polje',
  'bd' => 'Budva',
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

// Ispituje da li je string sastavljen isključivo od slova
function is_alpha_mne($string)
{
  $abeceda = mb_str_split('abcdefghijklmnopqrstuvwxyzčćšđžśź');
  $string_arr = mb_str_split(mb_strtolower($string));

  foreach ($string_arr as $char) {
    if (!in_array($char, $abeceda)) {
      return false;
    }
  }
  return true;
}

// Radi validaciju unosa u formu i vraća niz sa šiframa grešaka, ako ih ima 
function validacija()
{
  global $cities;
  $wish_arr = $_POST;

  $greske = [];

  $first_name = $wish_arr['first-name'];
  $last_name = $wish_arr['last-name'];
  $city = $cities[$wish_arr['city']];
  $wish = $wish_arr['wish-text'];

  if (empty($first_name)) {
    $greske[] = 0;
  }

  if (!is_alpha_mne($first_name)) {
    $greske[] = 1;
  }

  if (empty($last_name)) {
    $greske[] = 2;
  }

  if (!is_alpha_mne($last_name)) {
    $greske[] = 3;
  }

  if (!isset($wish_arr['was-good']) || $wish_arr['was-good'] !== 'on') {
    $greske[] = 4;
  }

  if (empty($city)) {
    $greske[] = 5;
  }

  if (empty($wish)) {
    $greske[] = 6;
  }

  return $greske;
}

// Kreira novi niz od $_POST za upis u fajl
function create_arr($arr)
{
  $res = [];
  global $cities;
  foreach ($arr as $field => $value) {
    switch ($field) {
      case 'first-name':
        $res['firstName'] = $value;
        break;
      case 'last-name':
        $res['lastName'] = $value;
        break;
      case 'city':
        $res['city'] = $cities[$value];
        break;
      case 'wish-text':
        $res['wish'] = $value;
        break;
    }
  }
  return $res;
}
