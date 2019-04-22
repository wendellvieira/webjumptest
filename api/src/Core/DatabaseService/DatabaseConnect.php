<?php
    namespace Core\DatabaseService;

    use \Core\DatabaseService\Interfaces\Connect;
    use \App\Settings;

    class DatabaseConnect extends Settings {
        protected function create(){
            $mysqli = new \mysqli($this->host, $this->user, $this->pass, $this->db);

            if ($mysqli->connect_error) {
                throw new Exception("ERR {$mysqli->connect_errno}: {$mysqli->connect_error}");
            }

            return $mysqli;
        }
    }