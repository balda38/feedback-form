<div class="messages-frame">
    <div class="messages-frame-title">
        Нам пишут:
    </div>
    <div id="messages" class="messages">

<?php

    $months = [" январь ", " февраль ", " март ", " апрель ", " май ", " июнь ", " июль ", " август ", " сентябрь ", " октябрь ", " ноябрь ", " декабрь "];

    while($row = $data->fetch()){                 
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
        <input type="text" name="user_name" required maxlength="50" id="name" class="form-input" placeholder="Введите Ваше имя..."/>
        <input type="email" name="email" required maxlength="50" id="email" class="form-input" placeholder="Введите Ваш email..."/>                
        <textarea type="text" name="message" required maxlength="1000" id="new_message" class="form-input" placeholder="Введите Ваше сообщение (не более 1000 символов)..."></textarea>
        <input type="submit" id="submit_button" class="submit-button"/>            
    </form>
</div>












