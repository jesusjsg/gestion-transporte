<?php
    namespace src\models;

    class viewsModel {

        protected function getViewsModel($view){
            $whiteList = ["dashboard"];

            if(in_array($view, $whiteList)){
                if(is_file("./src/views/" . $view . ".php")){
                    $content = "./src/views/" . $view . ".php";
                } else {
                    $content = "404";
                }
            } elseif($view == "login" || $view == "index"){
                $content = "login";
            } else {
                $content = "404";
            }
            return $content;
        }
    }