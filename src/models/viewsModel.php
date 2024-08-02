<?php

    namespace src\models;

    class viewsModel{

        protected function getViewsModel($folder,$view){

            $folderList = ["conductor","viaje","general","ruta","usuario","vehiculo"];
            $viewList = ["dashboard","form"];
            $authList = ["login"];

            $filePath = null;

            if (in_array($folder, $folderList) && in_array($view, $viewList)) {
                $filePath = "./src/views/{$folder}/{$view}.php";

                if(!is_file($filePath)){
                    $filePath = "./src/views/errors/404.php";
                } 

            } elseif($folder === "auth"){
                $filePath = "./src/views/auth/login.php";
            } else {
                $filePath = "./src/views/errors/404.php";
            }
            return $filePath;

        }
    }