<?php

namespace App\Core;
use App\Core\Connection;

/** 
 * Базовый класс отвечающий за взаимодействие с данными на сервере.
 */
abstract class Model
{
    protected static $conn;

    /**
     * Базовый метод, выполняющийся при создании экземпляра класса.
     * Записывает объект PDO подключения в свойство $conn; 
     * 
     * @return void
     */
    public function __construct()
    {
        self::$conn = Connection::$pdo;
    }

    /**
     * Базовый метод для получения данных.
     * 
     * @return void
     */
    protected function getData()
    {
        
    }

    /**
     * Базовый метод для вставки данных.
     * 
     * @return void
     */
    protected function insertData()
    {

    }
}
