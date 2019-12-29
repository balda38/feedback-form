<?php

    
            $model = new MessagesModel();
            $result = $model->insert_data();
            echo json_encode($result);
        

?>