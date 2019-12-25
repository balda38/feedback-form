<?php
    /*
     * Скрипт устанавливающий подклчение к БД MySQL посредством PDO.
    **/

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
    $pdo = new PDO($dsn, $user, $password, $opt);    
?>