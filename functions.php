<?php

include dirname(__FILE__).'/conf.php';
$baza = dirname(__FILE__).'/baza/mahsulotlar/';


function get_mahsulotlar(){
    global $baza;
    
    $nomi = scandir($baza.'nomi');
    $javob = [];
    foreach ($nomi as $v){
        if ($v == '.' or $v == '..') continue;
        $javob[] = [
            'nomi' => file_get_contents($baza.'nomi/'.$v),
            'short_info' => file_get_contents($baza.'short_info/'.$v),
            'rasm' => file_get_contents($baza.'rasm/'.$v),
            'slug' => file_get_contents($baza.'slug2/'.$v)
        ];
    }
    
    $javob = array_reverse($javob);
    
    return $javob;
}

function mahsulot($id){
    global $baza;
    $javob = [
        'nomi' => file_get_contents($baza.'nomi/'.$id),
        'short_info' => file_get_contents($baza.'short_info/'.$id),
        'info' => file_get_contents($baza.'info/'.$id),
        'rasm' => file_get_contents($baza.'rasm/'.$id),
        'slug' => file_get_contents($baza.'slug2/'.$id)
    ];
    
    return $javob;
}

function mahsulot_slug($slug){
    global $baza;
    return file_get_contents($baza."slug/$slug");
}

function head($variable = [SITE_NAME, DOMAIN_HTTPS, SHORT_INFO, SITE_LOGO, DOMAIN_HTTPS]){
    $html = file_get_contents(dirname(__FILE__).'/components/head.html');
    
    $replace = ['H_NAME', 'DOMAIN_HTTPS', 'H_INFO', 'HEAD_IMG', 'H_URL'];
    
    return str_replace($replace, $variable, $html);
}

function links(){
    $html = file_get_contents(dirname(__FILE__).'/components/links.html');
    
    $links = json_decode(file_get_contents(dirname(__FILE__).'/baza/sayt/links.txt'), true);
    
    $links_var = '';
    foreach ($links as $v){
        if (strlen($v['name']) > 0){
            $links_var .= '<a href="'.$v['url'].'">'.$v['name'].'</a>';
        }
    }
    
    return str_replace('LINKS', $links_var, $html);   
}
?>