<?php
require_once('functions.php');

$idhtml = '';
if (isset($_GET['id'])){
    $id = $_GET['id'];
    
    $submit = "edit";
    $idhtml = "<input type='hidden' name='id' value='".$id."'>";
    $m = mahsulot($id);
} elseif (isset($_GET['del'])) {
    $id = $_GET['del'];
    
    $baza = '../baza/mahsulotlar/';
    
    unlink($baza."nomi/$id");
    unlink($baza."info/$id");
    unlink($baza."short_info/$id");
    $rasm = file_get_contents($baza."rasm/$id");
    unlink($baza."rasm/$id");
    unlink("../baza/img/$rasm");
    $slug = file_get_contents($baza."slug2/$id");
    unlink($baza."slug2/$id");
    unlink($baza."slug/$slug");
    
    header("Location: ./");
} else {
    $submit = "new";
}

if (isset($_POST['new'])){
    $imgreq = 'required';
    $time = time();
    $slug = slug($_POST['nomi']);
    
    $file_tmp = $_FILES['rasm']['tmp_name'];
    $img_type = $_FILES['rasm']['type']; 
    $size = filesize($file_tmp);
    
    if ($size < 1336026){
        $img_name = $slug."_$time.png";
        
        move_uploaded_file($file_tmp, "../baza/img/$img_name");
    } else {
        echo "Rasm juda katta. Orqaga qaytib kichikroq yuklang";
        exit;
    }
    
    
    
    $baza = "../baza/mahsulotlar/";
    file_put_contents($baza.'nomi/'.$time, $_POST['nomi']);
    file_put_contents($baza.'short_info/'.$time, $_POST['short_info']);
    file_put_contents($baza.'qoshimcha/'.$time, $_POST['qoshimcha']);
    file_put_contents($baza.'info/'.$time, $_POST['info']);
    file_put_contents($baza.'slug/'.$slug, $time);
    file_put_contents($baza.'slug2/'.$time, $slug);
    file_put_contents($baza.'rasm/'.$time, $img_name);
    
    header('Location: ./');
} elseif (isset($_POST['edit'])){
    $id = $_POST['id'];
    
    $baza = "../baza/mahsulotlar/";
    file_put_contents($baza.'nomi/'.$id, $_POST['nomi']);
    file_put_contents($baza.'short_info/'.$id, $_POST['short_info']);
    file_put_contents($baza.'info/'.$id, $_POST['info']);
    file_put_contents($baza.'qoshimcha/'.$id, $_POST['qoshimcha']);
    
    if (filesize($_FILES['rasm']['tmp_name']) > 5000){

        
        $m = mahsulot($id);
        $time = time();
        $file_tmp = $_FILES['rasm']['tmp_name'];
        $img_type = $_FILES['rasm']['type']; 
        $size = filesize($file_tmp);
        
        if ($size < 1336026){
            $img_name = $m['slug']."_$time.png";
            
            move_uploaded_file($file_tmp, "../baza/img/$img_name");
            file_put_contents($baza.'rasm/'.$id, $img_name);
            unlink("../baza/img/".$m['rasm']);
        } else {
            echo "Rasm juda katta. Orqaga qaytib kichikroq yuklang";
            exit;
        }
    }
    
    
    header('Location: ./');
}

?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Tahrir</title>
    <script src="https://cdn.ckeditor.com/4.17.0/standard/ckeditor.js"></script>
</head>
<body>
    <a href="./">Orqaga</a>
    <form class="inputs" method="POST" enctype="multipart/form-data">
        <input type="text" name="nomi" placeholder="Nomi" required value="<?=$m['nomi']?>">
        
        <?=$idhtml?>
        
        <textarea placeholder="Qisqacha ma'lumot" name="short_info" required><?=$m['short_info']?></textarea>
        <br>
        <textarea placeholder="HTML" name="qoshimcha"><?=$m['qoshimcha']?></textarea>
        <br>
        
        <label>Asosiy rasmi</label>
        <input type="file" name="rasm" accept="image/png" capture <?=$imgreq?>>
        
        <textarea name="info" id="editor1" required><?=$m['info']?></textarea>
        
        <p>Asosiy sahifadagi o'rni</p>
        <select>
            <option>1</option>
            <option>1</option>
            <option>1</option>
            <option>1</option>
            <option>1</option>
        </select>
        
        <input type="submit" value="Saqlash" name="<?=$submit?>">
        
        <script>
            CKEDITOR.replace( 'editor1');
        </script>
    </form>
</body>
</html>