<?php
require_once('functions.php');

$mahsulotlar = get_mahsulotlar();


?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Dina pharm - admin</title>
    </head>
    <body>
        <h3>Mahsulotlar</h3>
        <table>
            <tr>
                <th>Nomi</th>
                <th>O'rni</th>
                <th>Amal</th>
                <th>Amal</th>
            </tr>
            <?php
            foreach ($mahsulotlar as $v){
                echo '<tr>
                    <td>'.$v['nomi'].'</td>
                    <td>1</td>
                    <td><a href="forma?id='.$v['id'].'">Tahrir</a></td>
                    <td><a href="forma?del='.$v['id'].'">Uchir</a></td>
                </tr>';
            }
            ?>
        </table>
        <br><br>
        <a href="forma">Mahsulot qo'shish</a><br>
        <a href="variable?type=info">Biz haqimizda matnini o'zgartirish</a><br>
        <a href="variable?type=short_info">Shiorni o'zgartirish</a><br>
        <a href="variable?type=links">Havolalarni o'zgartirish</a><br>
    </body>
</html>