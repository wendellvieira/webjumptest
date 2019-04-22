<?php   
    namespace Core\DatabaseService;

    class DatabaseFill extends DatabaseInit {   
        
        protected function getColls(){
            return !empty($this->fillable) ? $this->fillable : $this->colls;
        }

        public function fill($arr){
            foreach($this->getColls() as $item){
                if( isset( $arr[$item] ) ){
                    $this->{$item} = $arr[$item];
                }
            }
        }

        protected function fillArray($arr){
            foreach($arr as $coll => $item){
                if( isset( $this->{$coll} ) ){
                    $this->{$coll} = $item;
                }
            }
        }
    }