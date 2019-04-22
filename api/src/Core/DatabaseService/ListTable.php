<?php   
    namespace Core\DatabaseService;

    class ListTable {
        public $list = [];

        public function toHtml(){
            return json_encode($this->toArray());
        }
        public function toArray(){
            $arrayList = [];
            foreach( $this->list as $item ) $arrayList[] = $item->toArray();
            return $arrayList;
        }
    }