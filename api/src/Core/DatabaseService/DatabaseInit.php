<?php
    namespace Core\DatabaseService;

    class DatabaseInit extends DatabaseConnect {   
        
        static public $collsDesc = [];

        public function __construct(){
            $this->link = $this->create();

            $info_table = $this->link->query("DESC {$this->table}");
            if($info_table){
                while($iTab =  $info_table->fetch_object()){
                    self::$collsDesc[$iTab->Field] = $iTab;
                    $this->colls[] = $iTab->Field;
                    $this->{$iTab->Field} = "";

                    if($iTab->Key == "PRI") $this->pk = $iTab->Field;
                }
            }

        }        
    }