<?php

/** 
 * Класс, отвечающий за взаимодействие с данными из таблицы messages БД.
 * Наследуется от базового класса Model.
 */
class MessagesModel extends Model
{
    /**
     * При создании нового объекта класса устанавливает новое подключение.
     * 
     * @return void
     */
    function __construct()
    {
        $this->__conn = new Connection();
    }

    /**
     * Метод, получающий данные из БД посредством SQL-запроса.
     * 
     * @return PDOStatement - результат выборки по запросу.
     */
    function getData()
    {
        $pdo = $this->__conn->connect();

        $stmt = $pdo->query('SELECT * FROM messages ORDER BY id DESC');    
        
        $pdo = $this->__conn->closeConnection();
        
        return $stmt;                   
    }

    /**
     * Метод для вставки данных из полей формы в БД посредством SQL-запроса
     * 
     * @return bool - указатель правильности введенных данных.
     */
    function insertData()
    {
        $pdo = $this->__conn->connect();

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

        $json = array(
            'correctData' => $row['correct_data']
        );
        
        $pdo = $this->__conn->closeConnection();

        return json_encode($json);
    }
}
