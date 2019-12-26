'use strict';

	/*
     * Скрипт для динамического обновления списка сообщений посредством AJAX.
    **/

$( document ).ready(function() {
    $("#submit_button").click(
		function(){
			sendAjaxForm('messages', 'send_message_form', 'php/send_message.php');
			return false; 
		}
	);
});

function sendAjaxForm(messages, send_message_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
		data: $("#"+send_message_form).serialize(),  // Сеарилизуем объект
		
        success: function(response) { //Данные отправлены успешно
			let result = $.parseJSON(response);

			let months = [" январь ", " февраль ", " март ", " апрель ", " май ", " июнь ", " июль ", " август ", " сентябрь ", " октябрь ", " ноябрь ", " декабрь "];			
			let dateComponents = result.messageParams['date'].split("-");
			let buff = dateComponents[0];
			dateComponents[0] = dateComponents[2];
			dateComponents[2] = buff;   
			let numericDate = "";
			dateComponents.forEach(
				element => numericDate += element
			);				                   
			let rusDate = numericDate.replace(dateComponents[1], months[parseInt(dateComponents[1]) - 1]);
			
			if(result.wrongData != 1){
				let msg_block_container = document.createElement('div');
				msg_block_container.className = "message-block-container";

				let msg_block = document.createElement('div');
				msg_block.className = "message-block";

				let msg_author = document.createElement('div');
				msg_author.className = "message-author";
				msg_author.innerHTML = result.messageParams['name'] + " ";

				let msg_author_email = document.createElement('div');
				msg_author_email.className = "message-author-email";
				msg_author_email.innerHTML = result.messageParams['email'];

				let msg_date = document.createElement('div');
				msg_date.className = "message-date";
				msg_date.innerHTML = rusDate + " г.";

				let msg_text = document.createElement('div');
				msg_text.className = "message";
				msg_text.innerHTML = result.messageParams['message'];

				msg_author.append(msg_author_email);
				msg_block.append(msg_author);
				msg_block.append(msg_date);
				msg_block.append(msg_text);
				msg_block_container.append(msg_block);
				$('#messages').prepend(msg_block_container);
				
				msg_block_container.style.maxHeight = "0px";
				msg_block_container.style.opacity = 0;
				msg_block_container.style.transition = "5s";
				setTimeout(function(){
					msg_block_container.style.maxHeight = "500px";
					msg_block_container.style.opacity = 1;
				}, 100);				
				
				document.getElementById('name').value = "";
				document.getElementById('email').value = "";
				document.getElementById('new_message').value = "";
			}
			else{
				window.alert("Данные введены некорректно.");
			}        	
    	},
    	error: function(response) { // Данные не отправлены
            $('#messages').html('Ошибка. Данные не отправлены.');
    	}
 	});
}