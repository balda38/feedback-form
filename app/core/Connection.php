<?php

namespace App\Core;
use \PDO;

/**
 * Класс отвечающий за подключение к БД MySQL посредством PDO.
 */
class Connection
{
    public static $pdo;

    /**
     * Метод, отвечающий за подключение к БД посредством PDO.
     *
     * @return объект PDO с подключением к БД.
     */
    public function __construct()
    {
        $host = '127.0.0.1'; 
        $database = 'test_db'; 
        $user = 'root'; 
        $password = '123root321'; 
    
        $dsn = "mysql:host=$host;dbname=$database";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            self::$pdo = new PDO($dsn, $user, $password, $opt);
        } catch (PDOException $e) {
            echo 'Не удалось подключиться к серверу: ' . $e->getMessage();
        }
    }
}
