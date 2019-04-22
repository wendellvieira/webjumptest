<?php
    namespace Core\RouterService;

    class Url2Regexp {
        public static function encode($url){
            preg_match_all("/\{([a-z0-9_]+)\}/i", $url, $output);
            $urlTerm = str_replace("/", "\/", $url);
            return [
                "term" => $url,
                "vars" => $output[1],
                "replaced_url" => str_replace($output[0], '([a-z0-9_]+)',  $urlTerm)
            ];
        }
    }