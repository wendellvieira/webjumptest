<?php

    namespace Core\RouterService;

    class RouterPrefix extends HttpMethods {
        public static function prefix($prefix, $fx){
            $prefix = str_replace("/", "\/", $prefix);
            if( is_callable($fx) ){
                $starts = ["get" => 0, "post" => 0, "delete" => 0 ];
                foreach( HttpService::$routes as $key => $mtd)
                    $starts[$key] = count( HttpService::$routes[$key] );
                $fx();
                foreach( $starts as $mtd => $qnt) {
                    for( $x = $qnt; $x < count( HttpService::$routes[$mtd]); $x++ ){ 
                        $nUri = &HttpService::$routes[$mtd][$x]['replaced_url'];
                        if( $nUri == "") $nUri = $prefix;
                        else $nUri = $prefix . "\/" . $nUri;             
                    }
                }
            }else{
                throw new Exception("Segundo parametro tem que ser uma função!");
            }
        }
    }