<?php
require_once('functions.php');

$mahsulotlar = get_mahsulotlar();

?>
<html lang="uz">
<?=head()?>
<body>
    <div class="main">
        <div class="logo">
            <img src="img/logo.png">
            <h1><?=SITE_NAME?></h1>
            <i><p><?=SHORT_INFO?></p></i>
        </div>
        <div class="mahsulotlar">
            <h2>Mahsulotlar</h2>
            <?php
            
            foreach ($mahsulotlar as $v){
                $img = 'baza/img/'.$v['rasm'];
                
                if (filesize($img) < 4097) $img = 'img/logo.png';
                
                
                echo '<div class="mahsulot">
                    <img src="'.$img.'">
                    <h3>'.$v['nomi'].'</h3>
                    <p>'.$v['short_info'].'</p>
                    <a href="m/'.$v['slug'].'">Batafsil</a>           
                </div>';
                
                $img = '';
            }
            
            ?>
        </div>
        <?=links()?>
        <br><br><br>
        <div class="info">
            <h2>Biz haqimizda</h2>
            <?=str_replace("\n", '<br>', file_get_contents('baza/sayt/info.txt'))?>
        </div>
    </div>
    
    <br><br>
    Created by - Shaka_Rj. v:1.3
</body>

</html>