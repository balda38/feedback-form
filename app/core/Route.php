<?php
	/*
	 * Класс-маршрутизатор для определения запрашиваемой страницы.
	 * Цепляет классы контроллеров и моделей.
	 * Создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
	**/

	class Route
	{
		static function start()
		{		
			$controller_name = 'Messages';
			$action_name = 'messagesList';
			
			$routes = explode('/', $_SERVER['REQUEST_URI']);

			if ( !empty($routes[4]) )
			{	
				$controller_name = $routes[4];
			}

			if ( !empty($routes[5]) )
			{
				$action_name = $routes[5];
			}

			$model_name = $controller_name.'Model';
			$controller_name = $controller_name.'Controller';
			$action_name = $action_name.'Action';

			$model_file = $model_name.'.php';
			$model_path = "app/models/".$model_file;
			if(file_exists($model_path))
			{
				require_once "app/models/".$model_file;
			}

			$controller_file = $controller_name.'.php';
			$controller_path = "app/controllers/".$controller_file;
			if(file_exists($controller_path))
			{
				require_once "app/controllers/".$controller_file;
			}
			else
			{
				Route::ErrorPage404();
			}

			$controller = new $controller_name;
			$action = $action_name;
			
			if(method_exists($controller, $action))
			{
				$controller->$action();
			}
			else
			{
				Route::ErrorPage404();
			}
		
		}

		static function ErrorPage404()
		{
			$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
			header('HTTP/1.1 404 Not Found');
			header("Status: 404 Not Found");
			header('Location:'.$host.'404');
		}    
	}
	
?>