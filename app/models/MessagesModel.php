<?php

namespace App\Models;
use App\Core\Model as BaseModel;

/** 
 * Класс, отвечающий за взаимодействие с данными из таблицы messages БД.
 * Наследуется от базового класса Model.
 */
class MessagesModel extends BaseModel
{
    /**
     * Метод, получающий данные из БД посредством SQL-запроса.
     * 
     * @return PDOStatement - результат выборки по запросу.
     */
    public function getData()
    {
        $stmt = self::$conn->query('SELECT * FROM messages ORDER BY id DESC');         
                
        return $stmt;                   
    }

    /**
     * Метод для вставки данных из полей формы в БД посредством SQL-запроса
     * 
     * @return JSON, содержащий указатели правильности ввода имени и email.
     */
    public function insertData()
    {
        $messageParams = array(
            'name' => htmlspecialchars($_POST["user_name"]),
            'email' => htmlspecialchars($_POST["email"]),
            'message' => htmlspecialchars($_POST["message"]),
            'date' => date("Y-m-d"),
        );
    
        $stmt = self::$conn->prepare(
            'CALL check_inserted_data(:name, :email, :message, :date, @proc_out)'
        ); 
        
        $stmt->execute($messageParams);    
    
        $stmt1 = self::$conn->query('SELECT @proc_out as correct_data'); 
        $row = $stmt1->fetch();     

        return $row['correct_data'];
    }
}
