<?php

/** 
 * Класс, отвечающий за взаимодействие с моделью и 
 * отрисовывающий вьюшку с данными, полученными из модели.
 * Наследуется от базового класса Controller.
 */
class MessagesController extends Controller
{
    /**
     * Метод, который при создании нового объекта класса создает новую базовую вьюшку
     * и новый объект модели MessagesModel.
     * 
     * @return void
     */
    function __construct()
    {
        $this->__model = new MessagesModel();
    }
    
    /**
     * Метод, отвечающий за получение данных из модели и генерацию страницы с 
     * этими данными.
     * 
     * @return void
     */
    function getMessagesListAction()
    {        
        $data = $this->__model->getData();
        $this->__view = new View();
        $this->__view->generate('../views/MessagesView.php', '../../index.php', $data);
    }

    /**
     * Метод, отвечающий за вставку данных в модели и отправку вовне результата 
     * о успешности их вставки.
     * 
     * @return void
     */
    function insertMessageAction()
    {
        $result = $this->__model->insertData();
        echo $result;
    }
}
