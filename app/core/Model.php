<?php
	/*
	 * Базовый класс отвечающий за взаимодействие с данными на сервере.
	**/

	class Model
	{
		private $conn;

		function __construct()
        {
            $this->conn = new Connection();
        }

		function getData()
		{
			
		}

		function insertData()
		{

		}
	}

?>