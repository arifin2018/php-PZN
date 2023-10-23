<?php 
$path = '/index';
if (isset($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
}else{
    echo "tidak ada";
}

require_once(dirname(__FILE__) . "/../app/views" . $path . '.php');