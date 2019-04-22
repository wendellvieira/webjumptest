<?php
    namespace Core\DatabaseService\Options;

    class Order extends Limit {
        protected $OptionsOrder = [];

        public function order($id, $type = "ASC"){
            $this->OptionsOrder[] = " `{$id}` {$type} ";
            return $this;
        }

        protected function orderBuild(){
            $cmps = implode(", ", $this->OptionsOrder);
            return " ORDER BY " . $cmps;
        }
    }