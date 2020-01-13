<?php

namespace App;
use App\Core\Route;
use App\Core\Connection;

/**
 * Скрипт отвечающий за подключение отдельных файлов MVC-компонентов, 
 * а так же файла-класса для подключения к БД MySQL.  
 */

spl_autoload_register(
    function ($class_name) {
        include $class_name.'.php';
    }
);

$connection = new Connection();
$router = new Route();
    