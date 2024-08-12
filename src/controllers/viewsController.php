<?php

    namespace src\controllers;
    use src\models\viewsModel;

    class viewsController extends viewsModel {
        
        public function getViewsController($folder, $view) {
            error_log('Carpeta: ' . $folder. ', Vista: ' . $view);
            $viewPath = "./src/views/$folder/$view.php";
            if (is_file($viewPath)) {
                return $viewPath;
            } else {
                return "./src/views/errors/404.php";
            }
        }
    }
