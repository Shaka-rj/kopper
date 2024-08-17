<?php
require_once('functions.php');

$type = $_GET['type'];

if (isset($_POST['info'])){
    file_put_contents('../baza/sayt/info.txt', $_POST['text']);
    header('Location: ../admin');
} elseif (isset($_POST['short_info'])){
    file_put_contents('../baza/sayt/short_info.txt', $_POST['text']);
    header('Location: ../admin');
} elseif (isset($_POST['links'])){
    for ($i=1; $i<=6; $i++){
        $l = $_POST["l$i"];
        $lv = $_POST["lv$i"];
        
        $arr[$i]['name'] = $l;
        $arr[$i]['url'] = $lv;
    }
    
    file_put_contents('../baza/sayt/links.txt', json_encode($arr));
                
    header('Location: ../admin');
}
?>

<html>
    <body>
        <form method="POST">
            <?php
            if ($type == 'info'){
                $info = file_get_contents('../baza/sayt/info.txt');
                echo "<textarea name='text'>$info</textarea><br>
                <input type='submit' name='info' value='Saqlash'>";
            } elseif ($type == 'short_info'){
                $short_info = file_get_contents('../baza/sayt/short_info.txt');
                echo "<textarea name='text'>$short_info</textarea><br>
                <input type='submit' name='short_info' value='Saqlash'>";
            } elseif ($type == 'links'){
                $links = json_decode(file_get_contents('../baza/sayt/links.txt'), true);
                echo "<input type='text' value='Havola nomi' readonly><input type='text' value='Havola manzili' readonly><br><br>";
                
                for ($i=1; $i<=6; $i++){
                    $l = $links[$i]['name'];
                    $lv = $links[$i]['url'];
                    echo "<input type='text' name='l$i' value='$l'><input type='text' name='lv$i' value='$lv'><br><br>";
                }
                
                echo "<input type='submit' name='links' value='Saqlash'>";
            }
            ?>
        </form>
    </body>
</html>