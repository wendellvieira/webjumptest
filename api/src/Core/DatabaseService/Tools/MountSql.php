<?php
    namespace Core\DatabaseService\Tools;

    use \Core\DatabaseService\DatabaseInit;

    class MountSql {
        protected $type;
        protected $sql;
        private $types = [
            "varchar" => \Core\DatabaseService\Tools\Types\VarcharType::class,
            "int" => \Core\DatabaseService\Tools\Types\IntType::class,
            "timestamp" => \Core\DatabaseService\Tools\Types\TimeStampType::class,
            "date" => \Core\DatabaseService\Tools\Types\DateType::class,
            "text" => \Core\DatabaseService\Tools\Types\TextType::class,
            "float" => \Core\DatabaseService\Tools\Types\FloatType::class,
        ];

        public function getSql() {
            return $this->sql;
        }

        public function prepare($id, $value, $sent = 'in'){
            $type = preg_replace('/\(([0-9]+)\)/', '', DatabaseInit::$collsDesc[$id]->Type);
            if($sent == 'out') return $this->types[$type]::get($value);
            else return $this->types[$type]::set($value);
        }


    }