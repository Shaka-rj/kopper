<?php
$request = $_SERVER['REQUEST_URI'];
$slug = substr($request, 3);

require_once('../functions.php');

$m = mahsulot(mahsulot_slug($slug));
?>
<html lang="uz">
<?php
    $variable = [$m['nomi'], DOMAIN_HTTPS, $m['short_info'], DOMAIN_HTTPS.'/baza/img/'.$m['rasm'], DOMAIN_HTTPS.'/m/'.$slug];
    
    echo head($variable);
?>

<body>
    <div class="header">
        <h1><?=$m['nomi']?></h1>
        <img src="<?='../baza/img/'.$m['rasm']?>" class="dorirasm">
    </div>
    
    <?php
    if (strlen($m['qoshimcha']) > 2)
        echo '<div class="article">'.$m['qoshimcha'].'</div>';
    ?>
    
    <div class="article">
        <?=$m['info']?>
    </div>
    
    <h3 class="vebsite"><a href="<?=DOMAIN_HTTPS?>" class="vebsite"><?=SITE_NAME?></a></h3>
    <br><br>
    <?=links()?>
</body>
</html>