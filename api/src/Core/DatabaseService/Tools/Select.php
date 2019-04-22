<?php
    namespace Core\DatabaseService\Tools;    

    class Select extends MountSql {
        public function __construct($colls, $table){
            if( $colls != "*" ){
                $colls = str_replace(" ", "", $colls);
                $colls = explode(",", $colls);
                foreach($colls as &$coll) $coll = "`{$table}`.`{$coll}`";
                $colls = implode(", ", $colls);
            }
            $this->sql = "SELECT {$colls} FROM `{$table}` ";
        }
    }