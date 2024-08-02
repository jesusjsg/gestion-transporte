<?php

    namespace src\controllers;
    use src\models\viewsModel;

    class viewsController extends viewsModel{
        
        public function getViewsController($folder,$view){
            if(!empty($folder) && !empty($view)){
                return $this->getViewsModel($folder, $view);
            } else {
                return "./src/views/auth/login.php";
            }
        }
    }