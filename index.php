<?php
    header("Content-Security-Policy: default-src 'self' *googleapis.com");
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
        
        <?php 
            require_once "app/main.php"; 
        ?>                              
            
    </body>
</html>