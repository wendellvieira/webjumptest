<?php
    namespace Core\BuilderService;

    class CallController extends RouteAvailable {
        protected $ctrlNamespace = '\\App\\Controllers\\';
        protected $response;

        protected function call(){
            if( $this->available() ){
                if($this->currentRoute != null){
                    if( is_callable($this->currentRoute['fx']) ){
                        // $this->response = call_user_func_array($this->currentRoute['fx'], $this->uriData) ;
                    }else{
                        $class = explode("@", $this->currentRoute['fx']);
                        $nameClass = $this->ctrlNamespace.$class[0];
                        $nameClass = new $nameClass;
                        $this->response = call_user_func_array([$nameClass, $class[1]], $this->uriData);                       
                    }
                } 
            }else {
                $this->response = "404 Not found";
            }
        }
    }