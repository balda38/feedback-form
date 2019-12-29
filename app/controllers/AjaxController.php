<?php

    class AjaxController
    {
        function __construct()
        {
            $this->model = new AjaxModel();
        }

        function getAjaxAction()
        {
            $result = $this->model->insert_data();
            echo json_encode($result);
        }
    }

?>