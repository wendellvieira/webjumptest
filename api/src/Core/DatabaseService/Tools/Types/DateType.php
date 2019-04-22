<?php
    namespace Core\DatabaseService\Tools\Types;

    class DateType implements TypesInterface {

        public static function get($val){
            return $val;
        }

        public static function set($val){
            return $val;
        }
    }