<?php
    namespace Core\DatabaseService;

    use \Core\DatabaseService\Options\Order;

    class DatabaseOptions extends Order {

        private $options = [
            "OptionsWhere" => "whereBuild", 
            "OptionsGroup" => "groupBuild", 
            "OptionsOrder" => "orderBuild",
            "OptionsLimit" => "limitBuild" 
        ];
   

        protected function buildOptions(){
            $sql = "";
            foreach($this->options as $var => $build){
                if( !empty($this->{ $var }) ) $sql .=  $this->{ $build }();
            }            
            return $sql;
        }

    }