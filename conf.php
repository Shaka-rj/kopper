<?php
define('SITE_NAME', 'DINA PHARM XOS');
define('USERNAME', 'username');
define('PASSWORD', 'password');

///automatic variables
define('DOMAIN', $_SERVER['SERVER_NAME']);
define('DOMAIN_HTTPS', 'https://'.DOMAIN);
define('SITE_LOGO', DOMAIN_HTTPS.'/img/logo.png');

$file = 'baza/sayt/short_info.txt';
define('SHORT_INFO', (file_exists($file)) ? file_get_contents($file) : '');
