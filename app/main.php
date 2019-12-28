<?php
    /*
     * Скрипт отвечающий за подключение отдельных файлов MVC-компонентов, а так же файла скрипта для подключения к БД MySQL.
    **/
    
    require_once 'core/Connection.php';
    require_once 'core/Model.php';
    require_once 'core/View.php';
    require_once 'core/Controller.php';
    require_once 'core/Route.php';
    
    Route::start();
?>