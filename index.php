<!DOCTYPE html>
<html>
    <head>
        <title>Форма обратной связи</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>  
        <div class="header">
            <div class="header-title">Супер-компания Troickiy111</div>
        </div>

        <div class="contacts-container">
            <div class="contacts">                
                <div class="contacts-title">
                    Контакты
                </div>
                <div class="contacts-info">
                    <div class="address">
                        <img src="img/location.png" width="24" height="24"><b> Архангельск</b><br>                
                        пр. Троицкий 111, 11 этаж<br>
                        график работы: будни с 11:11 до 23:23
                    </div>
                    <div class="e-contacts">
                        <b><img src="img/email.png" width="24" height="24"> E-mail: </b> troickiy111@111.ru<br>
                        <b><img src="img/vk.png" width="24" height="24"> VK: </b> vk.com/troickiy111<br>
                        <b><img src="img/viber.png" width="24" height="24"> Viber/WhatsApp: </b> 8 (111) 111-11-11<br>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="messages" class="messages-frame">
            <div class="messages-frame-title">
                Нам пишут:
            </div>
            <div class="messages">
                <?php
                    require_once "connection.php";

                    $stmt = $pdo->query('SELECT * FROM messages');
                    $months = [" январь ", " февраль ", " март ", " апрель ", " май ", " июнь ", " июль ", " август ", " сентябрь ", " октябрь ", " ноябрь ", " декабрь "];
                    
                    while($row = $stmt->fetch()){

                        /* Перевод даты в российский формат.
                         * Необходим поскольку даты в БД содержатся в формате '2019-12-23', выглядещем не очень
                        **/
                        $dateComponents = explode("-", $row['date']);
                        $buff = $dateComponents[0];
                        $dateComponents[0] = $dateComponents[2];
                        $dateComponents[2] = $buff;   
                        $numericDate = "";
                        foreach($dateComponents as $value){
                            $numericDate .= $value;
                        }                           
                        $rusDate = str_replace($dateComponents[1], $months[intval($dateComponents[1]) - 1], $numericDate);                        

                        echo "<div class='message-block'>
                            <div class='message-author'>".
                                $row['name']." ".
                                "<div class='message-author-email'>".
                                $row['email'].
                                "</div>
                            </div>      
                            <div class='message-date'>".
                                $rusDate." г.".
                            "</div>            
                            <div class='message'>".  
                                $row['message'].
                            "</div>
                        </div>";
                    }                    
                ?>                
            </div>
        </div>
        
        <div class="form-container">
            <form class="form" action="php/send_message.php" method="POST">
                <div class="form-title">
                    Напишите и Вы!
                </div>
                <input type="text" name="user_name" required id="name" class="form-input" placeholder="Введите Ваше имя..."/>
                <input type="email" name="email" required pattern="[a-zA-Z0-9]{3,}@[a-zA-Z]{3,}.[a-zA-Z]{2,}" id="email" class="form-input" placeholder="Введите Ваш email..."/>                
                <textarea type="text" name="message" required id="new_message" class="form-input" placeholder="Введите Ваше сообщение..."></textarea>
                <input type="submit" class="submit-button"/>            
            </form>
        </div>
    </body>
</html>