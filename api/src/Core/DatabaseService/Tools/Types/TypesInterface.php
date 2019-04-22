<?php   
    namespace Core\DatabaseService\Tools\Types;

    interface TypesInterface {
        public static function get($val);

        public static function set($val);
    }