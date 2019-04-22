<?php
    namespace App\Models;

    use \Core\DatabaseService\Database;

    class Product extends Database {
        protected $table = "products";
    }