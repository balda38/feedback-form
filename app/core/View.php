<?php
	/*
	 * Базовый класс отвечающий за отрисовку вьюшки.
	**/

	class View
	{
			function generate($content_view, $template_view, $data)
		{
			require_once 'app/views/'.$content_view;
		}
	}

?>