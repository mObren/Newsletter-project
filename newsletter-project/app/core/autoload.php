<?php
function autoload($className) {
    $file =  dirname(__FILE__) . '/' . str_replace("App\Core\\", '', $className) . '.php';
    if (file_exists($file)) {
                require $file;
            }      
    }
   
spl_autoload_register('autoload');