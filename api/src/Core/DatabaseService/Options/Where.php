<?php
    namespace Core\DatabaseService\Options;

    use \Core\DatabaseService\DatabaseFill;

    class Where extends DatabaseFill {
        protected $OptionsWhere = [];
        
        public function where($id, $value, $type = "="){
            $this->OptionsWhere[] = [
                "type" => "and",
                "sql" => "`{$id}` {$type} '{$value}'"
            ];
            return $this;
        }

        public function whereOr($id, $value, $type = "="){
            $this->OptionsWhere[] = [
                "type" => "or",
                "sql" => "`{$id}` {$type} '{$value}'"
            ];
            return $this;
        }

        protected function whereBuild(){
            $preSql = " WHERE ";
            foreach ($this->OptionsWhere as $key => $value) {
                $preSql .= $value['sql'] . " ";
                if( isset($this->OptionsWhere[$key+1]) ) $preSql .= $value['type'];
            }
            return $preSql;
        }

    }