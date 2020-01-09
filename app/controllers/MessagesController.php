<?php

namespace App\Controllers;
use App\Core\Controller as BaseController;
use App\Models\MessagesModel;
use App\Core\View;

/** 
 * Класс, отвечающий за взаимодействие с моделью и 
 * отрисовывающий вьюшку с данными, полученными из модели.
 * Наследуется от базового класса Controller.
 */
class MessagesController extends BaseController
{
    /**
     * Метод, который при создании нового объекта класса создает новую базовую вьюшку
     * и новый объект модели MessagesModel.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->model = new MessagesModel();
    }
    
    /**
     * Метод, отвечающий за получение данных из модели и генерацию страницы с 
     * этими данными.
     * 
     * @return void
     */
    public function getMessagesListAction()
    {        
        $data = $this->model->getData();
        $this->view = new View();
        $this->view->generate('../views/MessagesView.php', '../../index.php', $data);
    }

    /**
     * Метод, отвечающий за вставку данных в модели и отправку вовне результата 
     * о успешности их вставки.
     * 
     * @return void
     */
    public function insertMessageAction()
    {
        $result = $this->model->insertData();
        echo $result;
    }
}
