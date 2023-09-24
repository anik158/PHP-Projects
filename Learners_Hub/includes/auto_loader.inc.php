<?php

spl_autoload_register('myAutoLoader');
define('ROOT_PATH', 'C:\xampp\htdocs\Learners_Hub'); 

function myAutoLoader($className){
    $path = ROOT_PATH . '/classes/'; 
    $ext = ".class.php";
    $fullPath = $path.$className.$ext;
    include_once $fullPath;
}
