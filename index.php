<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding("UTF-8"); 

function my_autoloader($class)
{
    $type = explode('_',$class);
    switch ($type[0]) {
        case 'C':
            include_once('c/'.$class.'.php');
            break;
        case 'M':
            include_once('m/'.$class.'.php');
            break;
    }
}

spl_autoload_register('my_autoloader');

$controller = new C_SiteMap();
$controller->Request();