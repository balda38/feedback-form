<?php
	/*
	 * Базовый класс отвечающий за взаимодействие с моделью и отрисовку вьюшки.
	**/

	class Controller {		
		private $model;
		private $view;
		
		function __construct()
		{
			$this->view = new View();
		}
	}

?>