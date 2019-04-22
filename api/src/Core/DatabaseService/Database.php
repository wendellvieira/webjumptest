<?php   
    namespace Core\DatabaseService;

    use \Core\DatabaseService\Tools\Select;

    class Database extends OutService {

        protected $link;
        protected $pk;        
        protected $colls = [];    
        protected $preMountSql = "";    

        protected $fillable = [];
        protected $hidden = [];

        protected $selectColls;


        public function find($id){
            if( empty($this->preMountSql) ) $items = $this->select()->where($this->pk, $id)->get();
            else $items = $this->where($this->pk, $id)->get();

            if( $items == null ) return null;
            else if( count($items->list) == 0 ) return null;
            else return $items->list[0];
        }

        public function select( $colls = "*"){
            $mount = new Select($colls, $this->table);
            $this->selectColls = $colls;
            $this->preMountSql = $mount->getSql();
            return $this;
        }

        public function get(){
            if( empty($this->preMountSql) ) $this->select();
            return $this->exec( $this->preMountSql . $this->buildOptions() );
        } 
        
        public function delete($id = null){
            if($id == null) $id = $this->{ $this->pk };
            $sql = "DELETE FROM `{$this->table}` WHERE `{$this->table}`.`{$this->pk}` = {$id}";
            return $this->link->query($sql);
        }

    }