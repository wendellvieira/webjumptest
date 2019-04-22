<?php
    namespace Core\BuilderService;

    use \Core\RouterService\HttpService;

    class RouteAvailable {
        protected $sData;
        protected $currentRoute=null;
        protected $uriData;

        public function __construct(){
            $this->sData = new ServerData;
        }

        protected function available(){
            $sMtd = &HttpService::$routes[ $this->sData->mtd ];
            if($sMtd != null){
                foreach ($sMtd as $route) {
                    preg_match("/^{$route['replaced_url']}$/i", $this->sData->uri, $output);
                    if( !empty($output) ){
                        unset($output[0]);
                        $this->uriData = $output;
                        $this->currentRoute = $route;
                        return true;
                    }                
                }
            }
            return false;
        }
    }