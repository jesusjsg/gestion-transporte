<?php

    namespace src\models;

    class viewsModel {
        protected $folderList = ["conductor", "viaje", "general", "ruta", "usuario", "vehiculo", "home", "auth", "errors", "nomina"];
        protected $viewList = ["dashboard", "form", "index", "edit", 'login', "closeSesion"];

        protected function getViewsModel($folder, $view) {
            if (in_array($folder, $this->folderList)) {
                
                if (empty($view) || !in_array($view, $this->viewList)) {
                    $view = 'index';
                }
                return $this->checkFile("./src/views/{$folder}/{$view}.php");
            } elseif ($folder == "auth" && $view == "login") {
                return "./src/views/{$folder}/{$view}.php";
            } else {
                return "./src/views/errors/404.php";
            }
        }

        protected function checkFile($filePath) {
            return is_file($filePath) ? $filePath : "./src/views/errors/404.php";
        }
    }