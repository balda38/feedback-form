<?php

/**
 * Вьюшка со стартовой страницей. 
 */

header("Content-Security-Policy: default-src 'self' googleapis.com");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Форма обратной связи</title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="css/style.css">

        <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="js/sendForm.js"></script> 
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
                        <img src="img/location.png"><b> Архангельск</b><br>                
                        пр. Троицкий 111, 11 этаж<br>
                        график работы: будни с 11:11 до 23:23
                    </div>
                    <div class="e-contacts">
                        <img src="img/email.png"><b> E-mail: </b> troickiy111@111.ru<br>
                        <img src="img/vk.png"><b> VK: </b> vk.com/troickiy111<br>
                        <img src="img/viber.png"><b> Viber/WhatsApp: </b> 8 (111) 111-11-11<br>
                    </div>
                </div>
            </div>
        </div>        
        
        <div class="messages-frame">
            <div class="messages-frame-title">
                Нам пишут:
            </div>
            <div id="messages" class="messages">

        <?php

        $months = [" январь ", " февраль ", " март ", " апрель ", " май ", " июнь ", " июль ", " август ", " сентябрь ", " октябрь ", " ноябрь ", " декабрь "];

        while ($row = $data->fetch()) {                 
            // Перевод даты в российский формат.
            // Необходим поскольку даты в БД содержатся в формате '2019-12-23', 
            // выглядещем не очень.

            $dateComponents = explode("-", $row['date']);
            $buff = $dateComponents[0];
            $dateComponents[0] = $dateComponents[2];
            $dateComponents[2] = $buff;   
            $numericDate = "";
            foreach ($dateComponents as $value) {
                    $numericDate .= $value;
            }        
            $rusDate = str_replace($dateComponents[1], $months[intval($dateComponents[1]) - 1], $numericDate);                        
            
            echo "<div class='message-block-container'>
                <div class='message-block'>
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
                </div>
            </div>";
        } 

        ?>

            </div>
        </div>
        
        <div class="form-container">
            <form class="form" id="send_message_form" action="" method="post">
                <div class="form-title">
                    Напишите и Вы!
                </div>
                <input type="text" name="user_name" required maxlength="50" id="name" class="form-input" placeholder="Введите Ваше ФИО..."/>
                <input type="email" name="email" required maxlength="50" id="email" class="form-input" placeholder="Введите Ваш email..."/>                
                <textarea type="text" name="message" required maxlength="1000" id="new_message" class="form-input" placeholder="Введите Ваше сообщение (не более 1000 символов)..."></textarea>
                <input type="submit" id="submit_button" class="submit-button"/>            
            </form>
        </div>                    
    </body>
</html>