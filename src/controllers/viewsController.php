<?php

    namespace src\controllers;

    use src\models\viewsModel;

    class viewsController extends viewsModel {
        
        public function getViewsController($folder, $view) {
            if($folder == 'ajax'){
                $this->ajax($view);
            }

            error_log('Carpeta: ' . $folder . ', Vista: ' . $view);
            return $this->getViewsModel($folder, $view);
        }

        public function ajax($view){
            return $this->loadAjax($view);
        }
    }
