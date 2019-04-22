<?php
    namespace Core\DatabaseService\Tools;    

    class Insert extends MountSql {
        public function __construct($arr, $table){
            $colls=$vals=[];
            foreach ($arr as $key => $value) {
                $colls[]= "`{$key}`";
                $vals[]= $this->prepare($key, $value);
            }

            $colls = implode(", ", $colls);
            $vals = implode(", ", $vals);
            $this->sql = "INSERT INTO `$table` ( $colls ) VALUES ( $vals )";
        }
    }