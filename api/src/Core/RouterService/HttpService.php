<?php
    namespace Core\RouterService;

    class HttpService {
        public static $routes = [
            "get" => [], 
            "post" => [], 
            "delete" => []
        ];

        public static function register($mtd, $url, $fx){
            $base = Url2Regexp::encode($url);
            $base['fx'] = $fx;
            self::$routes[$mtd][] = $base;
        }
    }