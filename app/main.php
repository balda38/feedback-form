<?php

namespace App;
use App\Core\Route;
use App\Core\Connection;

/**
 * Скрипт отвечающий за подключение отдельных файлов MVC-компонентов, 
 * а так же файла-класса для подключения к БД MySQL.  
 */

$connection = new Connection();
$router = new Route();
    