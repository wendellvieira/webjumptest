<?php
    namespace Core\DatabaseService\Tools\Types;

    class IntType implements TypesInterface {

        public static function set($val){
            return $val;
        }

        public static function get($val){
            return $val;
        }
    }