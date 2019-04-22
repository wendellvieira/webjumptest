<?php
    namespace Core\DatabaseService;

    class DatabaseSave extends DatabaseOptions {
        protected $type;
        private $mode = [
            "UPDATE" => \Core\DatabaseService\Tools\Update::class,
            "INSERT" => \Core\DatabaseService\Tools\Insert::class,
        ];

        protected function getData(){
            $data = [];
            foreach($this->getColls() as $item){
                if( !empty($this->{$item}) ) 
                    $data[ $item ] = $this->{$item};
            } 
            // Verificação de status do registro ...
            if( !isset( $data[$this->pk] ) && !empty( $this->{$this->pk} ) )
                $data[$this->pk] = $this->{$this->pk};
            if( isset( $data[$this->pk] ) && empty( $data[$this->pk] ) )
                unset($data[$this->pk]);
            
            // setando a data de criação do regsitro...
            if( !isset( $data[$this->pk] ) ) $data["created_at"] = "now()";
            else $data["updated_at"] = "now()";                
            
            return $data;
        }

        public function save(){
            if( empty($this->{ $this->pk }) ) $this->type = "INSERT";
            else $this->type = "UPDATE";
            
            // Montando o sql ...
            $mount = new $this->mode[$this->type]($this->getData(), $this->table);
            $sql = $mount->getSql();
            if($this->type == "UPDATE" && empty($this->OptionsWhere) && !empty($this->{ $this->pk }) ){
                $this->where($this->pk, $this->{ $this->pk });
                $sql .= $this->buildOptions();
            }

            // echo $sql;

            // Salvando ...
            $query = $this->link->query( $sql );
            $this->{$this->pk} = $this->link->insert_id;
        }
    }