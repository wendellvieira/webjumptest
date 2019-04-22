<?php
    namespace Core\RouterService;

    class Router extends RouterPrefix {
        public static function build(){
            return HttpService::$routes;
        }
    }