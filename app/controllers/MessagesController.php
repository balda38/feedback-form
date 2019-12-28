<?php
    /*
     * Класс MessagesController отвечающий за взаимодействие с моделью и 
     *      отрисовывающий вьюшку с данными, полученными из модели.
     * Наследуется от базового класса Controller.
     *      Метод messagesListAction() отвечает за получение данных от модели и отрисовывает вьюшку с этими данными.
     *      Метод insertMessageAction() отвечает за получение данных от модели и отправку этих данных далее.
    **/

    class MessagesController extends Controller
    {
        function __construct()
        {
            $this->model = new MessagesModel();
            $this->view = new View();
        }
        
        function messagesListAction()
        {
            $data = $this->model->getData();
            $this->view->generate('../views/MessagesView.php', '../../index.php', $data);
        }

        function insertMessageAction()
        {
            $result = $this->model->insertData();
            echo json_encode($result);
        }
    }

?>