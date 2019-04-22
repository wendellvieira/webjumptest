<?php
    namespace Core\DatabaseService;

    use \Core\DatabaseService\Tools\MountSql;
    use \Core\DatabaseService\Tools\Select;    

    class OutService extends DatabaseSave {
        
        public function toHtml(){
            return json_encode($this->toArray());
        }
        public function toArray(){
            $resp = [];
            $encode = new MountSql;  
            
            if( $this->preMountSql != "" ){
                $list = $this->exec( $this->preMountSql . $this->buildOptions() );
                $this->preMountSql = "";
            }else if( empty($this->{ $this->pk }) && !empty($this->OptionsWhere) ){
                $mount = new Select("*", $this->table);
                $this->selectColls = "*";
                $list = $this->exec( $mount->getSql() . $this->buildOptions() );
            }

            // print_r( count($list->list);
            foreach($this->colls as $coll){
                if(!in_array($coll, $this->hidden)){
                    if( $this->selectColls == "*" || strstr($this->selectColls, $coll) !== false){
                        $resp[$coll] = $encode->prepare($coll, $this->{$coll}, "out");
                    }
                }
            }
            return $resp;
        }
        protected function exec($sql){
            $query = $this->link->query($sql);        
            if(!$query) return null;
            if($query->num_rows == 0){
                return null;
            }else{
                $list = new ListTable;
                while( $item = (array)$query->fetch_object() ) { 
                    $clone = clone $this;                   
                    $clone->fillArray($item);
                    $list->list[] = $clone;
                }
            }
            return $list;
        }
    }