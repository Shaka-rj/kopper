<?php
require_once('functions.php');
include '../conf.php';

if (isset($_POST['submit'])){
    if ($_POST['login'] == USERNAME and $_POST['password'] == PASSWORD){
        $_SESSION['aktiv'] = true;
        header("Location: ".DOMAIN_HTTPS."/admin");
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Kirish</title>
    </head>
    <body>
        <form method="POST">
            <input type="text" name="login" placeholder="login">
            <input type="password" name="password" name="password">
            <input type="submit" value="kirish" name="submit">
        </form>
    </body>
</html>