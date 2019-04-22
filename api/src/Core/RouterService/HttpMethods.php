<?php
    namespace Core\RouterService;
    // use Url2Regexp;

    abstract class HttpMethods {
        public static function get($url, $fx){
            HttpService::register('get', $url, $fx); 
        }
        public static function post($url, $fx){
            HttpService::register('post', $url, $fx);             
        }
        public static function delete($url, $fx){
            HttpService::register('delete', $url, $fx);             
        }
    }