<?php

namespace App\Models;
use App\Core\Model as BaseModel;
use App\Core\Connection;

/** 
 * Класс, отвечающий за взаимодействие с данными из таблицы messages БД.
 * Наследуется от базового класса Model.
 */
class MessagesModel extends BaseModel
{
    /**
     * При создании нового объекта класса устанавливает новое подключение.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Connection();
    }

    /**
     * Метод, получающий данные из БД посредством SQL-запроса.
     * 
     * @return PDOStatement - результат выборки по запросу.
     */
    public function getData()
    {
        $pdo = $this->conn->connect();

        $stmt = $pdo->query('SELECT * FROM messages ORDER BY id DESC');    
        
        $pdo = $this->conn->closeConnection();
        
        return $stmt;                   
    }

    /**
     * Метод для вставки данных из полей формы в БД посредством SQL-запроса
     * 
     * @return bool - указатель правильности введенных данных.
     */
    public function insertData()
    {
        $pdo = $this->conn->connect();

        $messageParams = array(
            'name' => htmlspecialchars($_POST["user_name"]),
            'email' => htmlspecialchars($_POST["email"]),
            'message' => htmlspecialchars($_POST["message"]),
            'date' => date("Y-m-d"),
        );
    
        $stmt = $pdo->prepare(
            'CALL check_inserted_data(:name, :email, :message, :date, @proc_out)'
        ); 
        
        $stmt->execute($messageParams);    
    
        $stmt1 = $pdo->query('SELECT @proc_out as correct_data'); 
        $row = $stmt1->fetch();     
        
        $pdo = $this->conn->closeConnection();

        return $row['correct_data'];
    }
}
