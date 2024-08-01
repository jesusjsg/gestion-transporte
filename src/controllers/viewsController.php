<?php
    namespace src\controllers;

    use src\models\viewsModel;

    class viewsController extends viewsModel {
        
        public function getViewsController($view){
            if($view != ""){
                $response = $this->getViewsModel($view);
            } else {
                $response = $this->getViewsModel("login");
            }
            return $response;
        }
    }