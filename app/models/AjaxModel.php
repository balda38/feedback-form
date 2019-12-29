<?php

    class AjaxModel
    {
        function __construct()
        {
            $this->conn = new Connection();
        }

        function insert_data()
        {
            $pdo = $this->conn->connect();

            $messageParams = array(
                'name' => $_POST["user_name"],
                'email' => $_POST["email"],
                'message' => $_POST["message"],
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