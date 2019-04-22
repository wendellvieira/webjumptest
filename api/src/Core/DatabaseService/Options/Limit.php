<?php
    namespace Core\DatabaseService\Options;

    class Limit extends Group {
        protected $OptionsLimit = [];
        
        public function limit($int, $length = 10){
            $this->OptionsLimit = [
                "init" => $int,
                "length" => $length
            ];
            return $this;
        }

        protected function limitBuild(){
            return " LIMIT {$this->OptionsLimit['init']}, {$this->OptionsLimit['length']} ";
        }
    }