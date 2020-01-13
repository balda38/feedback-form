<?php

namespace App;
use App\Core\Route;
use App\Core\Connection;

/**
 * Скрипт отвечающий открытие подключения с БД и старт роутера.  
 */

$connection = new Connection();
$router = new Route();
    