<?php
    namespace Core\ProviderService;

    class ProviderBase {
        public $items = [];

        public function exec(){
            foreach($this->items as $item){
                call_user_func([$this, $item], []);
            }
        }
    }