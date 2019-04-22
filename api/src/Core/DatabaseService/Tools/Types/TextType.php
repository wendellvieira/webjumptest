<?php
    namespace Core\DatabaseService\Tools\Types;

    class TextType implements TypesInterface {

        public static function get($val){   
            if( is_array($val) || is_object($val)) return $val;
            $output_array = [];
            preg_match('/^jsonBase64\:(.*)/', $val, $output_array);
            if( !empty($output_array) ){
                $val = str_replace("jsonBase64:", "", $val);
                $val = base64_decode($val);
                $val = json_decode($val);
                return $val;
            }else{
                return $val;
            }
        }

        public static function set($val){
            if( is_array($val) || is_object($val)) {
                $val = json_encode($val);
                $val = base64_encode($val);
                return "'jsonBase64:{$val}'";
            }else{
                return "'{$val}'";
            }
        }
    }