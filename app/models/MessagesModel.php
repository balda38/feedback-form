<?php
    /*
     * Класс MessagesModel отвечающий за взаимодействие с данными из табыли messages БД.
     * Наследуется от базового класса Model.
     *      Метод getData() отвечает за получение данных от сервера.
     *      Метод insertData() отвечает за отправку данных на сервер;
     *      выходной параметр @proc_out необходим для определения корректности введенных данных.
    **/

    class MessagesModel extends Model
    {
        function __construct()
        {
            $this->conn = new Connection();
        }

        function getData()
        {
            $pdo = $this->conn->connect();

            $stmt = $pdo->query('SELECT * FROM messages ORDER BY id DESC');    
            
            $pdo = $this->conn->closeConnection();
            
            return $stmt;                   
        }

        function insertData()
        {
            $pdo = $this->conn->connect();

            $messageParams = array(
                'name' => htmlspecialchars($_POST["user_name"]),
                'email' => htmlspecialchars($_POST["email"]),
                'message' => htmlspecialchars($_POST["message"]),
                'date' => date("Y-m-d"),
            );
        
            $stmt = $pdo->prepare('CALL check_inserted_data(:name, :email, :message, :date, @proc_out)'); 
            
            $stmt->execute($messageParams);    
        
            $stmt1 = $pdo->query('SELECT @proc_out as wrong_data'); 
            $row = $stmt1->fetch();
        
            $result = array(
                'messageParams' => $messageParams,
                'wrongData' => $row['wrong_data'],
            );        
            
            $pdo = $this->conn->closeConnection();

            return $result;
        }
    }

?>