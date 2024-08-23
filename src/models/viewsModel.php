<?php

    namespace src\models;

    class viewsModel {
        protected $folderList = ["conductor", "viaje", "general", "ruta", "usuario", "vehiculo", "home", "auth", "errors", "nomina"];

        protected $viewList = ["dashboard", "form", "index", "edit", 'login', "logout"];

        protected $ajaxList = [
            'usuarios' => 'usuarioAjax',
            'vehiculo' => 'vehiculoAjax',
            'conductor' => 'conductorAjax',
            'viaje' => 'viajeAjax',
            'general' => 'generalAjax',
            'ruta' => 'rutaAjax'
        ];

        protected function getViewsModel($folder, string $view) {
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

        protected function loadAjax(string $view){
            if(isset($this->ajaxList[$view])){
                $file = $this->ajaxList[$view];
                $base = "./src/helpers/ajax/{$file}.php";
                require_once $this->checkFile($base);
                exit;
            }
        }
    }