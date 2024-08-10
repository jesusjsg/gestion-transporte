<?php

namespace src\models;

class viewsModel {

    protected function getViewsModel($folder, $view) {

        $folderList = ["conductor", "viaje", "general", "ruta", "usuario", "vehiculo", "home", "auth", "errors"];
        $viewList = ["dashboard", "form", "index", "edit", "closeSesion"]; // Se agrega el index para el inicio de las vistas
        
        if (in_array($folder, $folderList) && in_array($view, $viewList)) {
            $filePath = "./src/views/{$folder}/{$view}.php";
            if (is_file($filePath)) {
                return $filePath;
            } else {
                return "./src/views/errors/404.php";
            }
        } elseif ($folder == "auth" && $view == "login") {
            return "./src/views/{$folder}/{$view}.php";
        } else {
            return "./src/views/errors/404.php";
        }

    }
}
