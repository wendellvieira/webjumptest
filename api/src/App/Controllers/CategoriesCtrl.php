<?php
    namespace App\Controllers;

    use App\Models\Categorie;

    class CategoriesCtrl extends BaseCtrl {        
        public function __construct(){
            $this->model = new Categorie;
        }        
    }