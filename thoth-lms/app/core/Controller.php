<?php
class controller {
    public function model ($model){
        $file = __DIR__.'../models/'. $model . '.php';
        if( file_exists($file)){
            require_once $file ;
            return new $model();
        }else{
            die("model $model not found");
        }
    }

    public function view($view,$data = []){
        $file = __DIR__.'/../views/'.$view . '.php';
        if (file_exists($file)){
            extract($data);
            require_once $file;
        }else{
            die("View $view not found ");
        }
    }
}