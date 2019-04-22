<?php
    namespace Core\DatabaseService\Tools;    

    class Update extends MountSql {
        public function __construct($arr, $table){
            $colls = [];
            foreach ($arr as $key => $value) {
                $value = $this->prepare($key, $value);
                $colls[] = "`{$table}`.`{$key}` = {$value}";              
            }
            $colls = implode(", ", $colls);
            $this->sql = "UPDATE `{$table}` SET {$colls}";
        }
    }