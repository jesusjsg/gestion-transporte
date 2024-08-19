<?php

    namespace src\controllers;

    use src\models\viewsModel;

    class viewsController extends viewsModel {
        
        public function getViewsController($folder, $view) {
            error_log('Carpeta: ' . $folder . ', Vista: ' . $view);
            return $this->getViewsModel($folder, $view);
        }
    }
