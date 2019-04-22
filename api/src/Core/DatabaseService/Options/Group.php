<?php
    namespace Core\DatabaseService\Options;

    class Group extends Where {
        protected $OptionsGroup = [];

        public function group($id){
            $this->OptionsGroup[] = " `{$id}` ";
            return $this;
        }

        protected function groupBuild(){
            $cmps = implode(", ", $this->OptionsGroup);
            return " GROUP BY {$cmps}";
        }

    }