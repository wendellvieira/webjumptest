<?php
    namespace Core\ProviderService;

    class Provider {
        protected static $items = [
             RouterProvider::class
        ];

        public static function provide(){
            foreach(self::$items as $item){
                call_user_func([new $item, "exec"], []);
            }
        }
    }