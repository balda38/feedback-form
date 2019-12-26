<?php
    /*
     * Скрипт для отправки сообщения из формы на сервер посредством PDO.
     * Результат работы запроса вернет значение 0 или 1:
     *      0 - данные введены корректно;
     *      1 - данные введены некорректно.
     * Так же отправка JSON-файла с сообщением и указателем правильности ввода данных на AJAX-контроллер
    **/

    require_once "../connection.php";
    
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

    echo json_encode($result);
?>
