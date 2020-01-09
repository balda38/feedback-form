<?php

namespace App;
use App\Core\Route;

/**
 * Скрипт отвечающий за подключение отдельных файлов MVC-компонентов, 
 * а так же файла-класса для подключения к БД MySQL.  
 */

require_once 'core/Connection.php';
require_once 'core/Model.php';
require_once 'core/View.php';
require_once 'core/Controller.php';
require_once 'core/Route.php';

$router = new Route();
    