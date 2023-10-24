<?php 
$path = '/index.php/';
if (isset($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
    require_once(dirname(__FILE__) . "/../app/views" . $path . '.php');
}else{
    echo "tidak ada";
}
