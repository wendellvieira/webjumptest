<?php
    namespace App\Controllers;

    use App\Models\Product;

    class ProductsCtrl extends BaseCtrl {        
        public function __construct(){
            $this->model = new Product;
        }
    }