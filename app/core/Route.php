<?php

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
    static function start()
    {
        $controller_name = 'Messages';
        $action_name = 'messagesList';
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[2])) {
            $controller_name = $routes[2];
        }

        if (!empty($routes[3])) {
            $action_name = $routes[3];
        }

        $model_name = $controller_name.'Model';
        $controller_name = $controller_name.'Controller';
        $action_name = $action_name.'Action';

        $model_file = $model_name.'.php';
        $model_path = "app/models/".$model_file;
        if (file_exists($model_path)) {
            include_once "app/models/".$model_file;
        }

        $controller_file = $controller_name.'.php';
        $controller_path = "app/controllers/".$controller_file;
        if (file_exists($controller_path)) {
            include_once "app/controllers/".$controller_file;
        } else {
            Route::errorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;
        
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::errorPage404();
        }
    
    }

    /**
     * Метод для вызова страницы 404.
     * 
     * @return void
     */
    static function errorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}    
