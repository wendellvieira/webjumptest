<?php
    namespace Core\BuilderService;

    class Build extends CallController {
        
        public function build(){
            $this->call();
            $type = gettype( $this->response );
            if( $type == "string" || $type == "boolean" || $type == "integer" || $type == "double" ){
                echo $this->response;
            }else if( $type == "array" ) {
                echo json_encode($type);
            }else if( $type == "object" ){
                echo $this->response->toHtml();
            }
        }
    }