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

function validacija()
{
  global $cities;
  $wish_arr = $_POST;

  $greske = [];

  $first_name = $wish_arr['first-name'];
  $last_name = $wish_arr['last-name'];
  $city = $cities[$wish_arr['city']];
  $wish = $wish_arr['wish-text'];

  if (!is_alpha_mne($first_name)) {
    $greske[] = "fname";
  }

  if (!is_alpha_mne($last_name)) {
    $greske[] = "lname";
  }

  if (!isset($wish_arr['was-good']) || $wish_arr['was-good'] !== 'on') {
    $greske[] = "isnt-good";
  }

  if (empty($city)) {
    $greske[] = "city";
  }

  if (empty($wish)) {
    $greske[] = "wish";
  }

  return $greske;
}

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
