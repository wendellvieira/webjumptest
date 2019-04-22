<?php
    namespace App\Controllers;

    class WebCtrl {
        static public $uploadPath = __DIR__ . "/../../../../images";

        public function dashboard(){
            return '...';
        }

        public function fileUpload($path){
            $realPath = WebCtrl::$uploadPath . "/{$path}/";
            if( !is_dir($realPath) ) mkdir($realPath);

            // verifica tipo...
            preg_match('/image\/([a-z]+)/', $_FILES['file']['type'], $is_image);
            if( empty($is_image) ) return false; 

            // tratamento de nome...
            preg_match('/\.([a-z]{3,4})$/', $_FILES['file']['name'], $type);
            $name = str_replace($type[0], "", $_FILES['file']['name']) . "-" . rand() . $type[0];

            // upload ...
            if(move_uploaded_file($_FILES['file']['tmp_name'], $realPath.$name)){
                return "{$path}/{$name}";
            }else{
                return false;
            }
        }
    }