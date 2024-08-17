<?php
include 'conf.php';

header('Content-type: application/xml; charset=utf-8');
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';

$slugs = scandir('baza/mahsulotlar/slug');
$data = date('Y-m-d');

$xml = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$xml .= '<url>
    <loc>'.DOMAIN_HTTPS.'</loc>
    <lastmod>'.$data.'</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
    </url>';

foreach ($slugs as $v){
    if ($v == '.' or $v == '..')
        continue;
    
    $data = date('Y-m-d', file_get_contents('baza/mahsulotlar/slug/'.$v));
    
    $xml .= '<url>
    <loc>'.DOMAIN_HTTPS.'/m/'.$v.'</loc>
    <lastmod>'.$data.'</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
    </url>';
}

$xml .= '</urlset>';

echo $xml;