<?php
    namespace Core\BuilderService;

    class ServerData {
        public $mtd;
        public $uri;

        public function __construct(){
            $this->mtd = strtolower( $_SERVER['REQUEST_METHOD'] );

            if( $_SERVER['REQUEST_URI'] == "" || $_SERVER['REQUEST_URI'] == "/" ) $this->uri = '/';
            else $this->uri = preg_replace('/\/$/', '', $_SERVER['REQUEST_URI']) ;
        }
    }