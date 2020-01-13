'use strict';
  /* Скрипт для динамического обновления списка сообщений посредством AJAX.    
	При получении данных, если параметр correctData равен true, 
	значит данные введены правильно и список будет обновлен.
	При получении данных, если параметр correctData равен false,
	значит данные введены неправильно и об этом будет выведено сообщение.
  */

var user_name;
var user_email;
var user_message;
var date;

$( document ).ready(function () {
  $('#submit_button').click(
    function(){
      user_name = document.getElementById('name').value;
	    user_email = document.getElementById('email').value;
      user_message = document.getElementById('new_message').value;				
      date = new Date();
	
	    var dateOptions = {
	      year: 'numeric',
		    month: 'long',
		    day: 'numeric'
	    };
	
      date = date.toLocaleString('ru', dateOptions);

	    sendAjaxForm('send_message_form', 'app/Messages/insertMessage');
	    return false; 
	  }
  );
});

function sendAjaxForm(send_message_form, url) {
  $.ajax({
    url: url, 
	  type: 'POST', 
	  dataType: 'text', 
	  data: $('#'+send_message_form).serialize(),  
	
	  success: function (response) {       
      let result = $.parseJSON(response);

	    if (result.correctClientName) {		
        if (result.correctClientEmail) {
          updateMessagesList();
          zeroingFields();
        } else {
          window.alert('E-mail введен некорректно. Введите e-mail по типу: "example@mail.ru".\n'
                      + 'Так же в поле не должно содержаться специальных символов, кроме дефиса и нижнего подчеркивания');
        }
	    } else {
        window.alert('Имя введено некорректно. Введите имя по типу: "Сергеев Сергей Сергеевич".\n'
                    + 'Так же в поле не должно содержаться каких-либо специальных символов, кроме дефиса.');
	    }        	
	  },
	  error: function (response) { 
	    window.alert('Ошибка. Данные не отправлены.');
	  }
  });
};

function updateMessagesList() {
  let msg_block_container = document.createElement('div');
  msg_block_container.className = 'message-block-container';

  let msg_block = document.createElement('div');
  msg_block.className = 'message-block';

  let msg_author = document.createElement('div');
  msg_author.className = 'message-author';
  msg_author.innerHTML = user_name + ' ';

  let msg_author_email = document.createElement('div');
  msg_author_email.className = 'message-author-email';
  msg_author_email.innerHTML = user_email;

  let msg_date = document.createElement('div');
  msg_date.className = 'message-date';
  msg_date.innerHTML = date;

  let msg_text = document.createElement('div');
  msg_text.className = 'message';
  msg_text.innerHTML = user_message;

  msg_author.append(msg_author_email);
  msg_block.append(msg_author);
  msg_block.append(msg_date);
  msg_block.append(msg_text);
  msg_block_container.append(msg_block);
  $('#messages').prepend(msg_block_container);

  msg_block_container.style.maxHeight = '0px';
  msg_block_container.style.opacity = 0;
  msg_block_container.style.transition = '5s';

  setTimeout(function () {
	msg_block_container.style.maxHeight = '500px';
	msg_block_container.style.opacity = 1;
  }, 100);
};

function zeroingFields() {
  document.getElementById('name').value = '';
  document.getElementById('email').value = '';
  document.getElementById('new_message').value = '';

  user_name = null;
  user_email = null;
  user_message = null;
  date = null;
};
