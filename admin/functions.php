<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


session_start();

if ($_SESSION['aktiv'] != true and basename($_SERVER['PHP_SELF']) != 'login.php' and basename($_SERVER['PHP_SELF']) != 'm.php'){
    header("Location: login");
    exit;exit();
}

function slug($text, $divider = '_')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

$baza = '../baza/mahsulotlar/';

function get_mahsulotlar(){
    global $baza;
    
    $nomi = scandir($baza.'nomi');
    $javob = [];
    foreach ($nomi as $v){
        if ($v == '.' or $v == '..') continue;
        $javob[] = [
            'nomi' => file_get_contents($baza.'nomi/'.$v),
            'short_info' => file_get_contents($baza.'short_info/'.$v),
            'id' => $v
        ];
    }
    
    return $javob;
}

function mahsulot($id){
    global $baza;
    $javob = [
        'nomi' => file_get_contents($baza.'nomi/'.$id),
        'short_info' => file_get_contents($baza.'short_info/'.$id),
        'info' => file_get_contents($baza.'info/'.$id),
        'rasm' => file_get_contents($baza.'rasm/'.$id),
        'slug' => file_get_contents($baza.'slug2/'.$id),
        'qoshimcha' => file_get_contents($baza.'qoshimcha/'.$id)
    ];
    
    return $javob;
}

function mahsulot_slug($slug){
    global $baza;
    return file_get_contents($baza."slug/$slug");
}