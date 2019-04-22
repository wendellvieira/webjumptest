<?php
    namespace Core\DatabaseService\Tools\Types;

    class VarcharType implements TypesInterface {

        public static function set($val){
            return "'{$val}'";
        }

        public static function get($val){
            return $val;
        }
    }