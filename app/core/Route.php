<?php

namespace App\Core;

/** 
 * Класс-маршрутизатор для определения запрашиваемой страницы.
 * Цепляет классы контроллеров и моделей.
 * Создает экземпляры контролеров страниц и вызывает действия этих контроллеров. 
 */
class Route
{
    /**
     * Метод, запускающий роутер.
     * 
     * @return void
     */
    public function __construct()
    {
        $controller_name = 'Messages';
        $action_name = 'getMessagesList';
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[2])) {
            $controller_name = $routes[2];
        }

        if (!empty($routes[3])) {
            $action_name = $routes[3];
        }

        $controller_name = '\App\Controllers\\'.$controller_name.'Controller';   
        $action_name = $action_name.'Action';  

        if (class_exists($controller_name)) {
            $controller = new $controller_name();

            if (method_exists($controller, $action_name)) {
                $controller->$action_name();
            } else {
                Route::errorPage404();
            }
        } else {
            Route::errorPage404();
        }     
    }

    /**
     * Метод для вызова страницы 404.
     * 
     * @return void
     */
    private static function errorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}    
