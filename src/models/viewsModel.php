<?php
    namespace src\models;

    class viewsModel{

        protected $whiteList = [];

        public function __construct(){
            $this->generateWhiteList("./src/views/");
        }

        protected function generateWhiteList($directory, $prefix = ""){
            $files = scandir($directory);
            foreach ($files as $file){
                if ($file != "." && $file != ".."){
                    $path = $directory . $file;
                    if (is_dir($path)){
                        $this->generateWhiteList($path . "/", $prefix . $file . "/");
                    } else if (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) == "php"){
                        $this->whiteList[] = $prefix . pathinfo($file, PATHINFO_FILENAME);
                    }
                }
            }
        }

        public function getViewsModel($view){

            if ($view == "login" || $view == "index"){
                return "./src/views/login/login.php";
            }
            
            if (in_array($view, $this->whiteList)){
                $viewPath = "./src/views/" . $view . ".php";
                if (is_file($viewPath)){
                    $content = $viewPath;
                } else {
                    $content = "./src/views/errors/404.php";
                }
            } else if ($view == "login" || $view == "index"){
                $content = "./src/views/login.php";
            } else {
                $content = "./src/views/errors/404.php";
            }

            return $content;
        }
    }