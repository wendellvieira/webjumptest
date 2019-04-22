<?php
    namespace App\Controllers;

    class BaseCtrl {
        protected $model;

        public function read($id = null){            
            if( $id != null ) return $this->model->find($id);
            else return $this->model->get();            
        }
        public function save(){
            $this->model->fill($_POST);
            $this->model->save();
            return $this->model;
        }
        public function delete($id){           
            return $this->model->delete($id);
        }
    }