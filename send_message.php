<?php
    $host = '127.0.0.1'; // адрес сервера 
    $database = 'test_db'; // имя базы данных
    $user = 'root'; // имя пользователя
    $password = '123root321'; // пароль

    $dsn = "mysql:host=$host;dbname=$database";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $password, $opt);

    /* $data = [
        'name' => $_POST[user_name],
        'email' => $_POST[email],
        'message' => $_POST[message],
    ]; */
    /* $stmt = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
    $stmt->bindParam(':name', $_POST[user_name]);
    $stmt->bindParam(':email', $_POST[email]);
    $stmt->bindParam(':message', $_POST[message]);
    $stmt->execute(); */

    $statement = $pdo->prepare('INSERT INTO messages (name, email, message)
    VALUES (:fname, :sname, :age)');

    $statement->execute([
        'fname' => $_POST["user_name"],
        'sname' => $_POST["email"],
        'age' => $_POST["message"],
    ]);

    //$pdo->exec('INSERT INTO messages (name, email, message) values ("{$_POST[user_name]}", "{$_POST[email]}", "{$_POST[message]}"');
?>