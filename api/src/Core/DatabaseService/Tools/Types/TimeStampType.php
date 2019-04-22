<?php
    namespace Core\DatabaseService\Tools\Types;

    class TimeStampType implements TypesInterface {

        public static function get($val){
            return $val;
        }

        public static function set($val){
            if($val == "now()") return $val;
            return "'{$val}'";
        }
    }