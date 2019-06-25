<?php
    // Controller Base
    // Carrega Models e Views

    class Controller {
        // Carrega model
        public function model($model){
            // Carrega arquivo do model
            require_once '../app/models/'. $model .'.php';

            // Instancia o model
            return new $model();
        }

        // Carrega view
        public function view($view, $data = []){
            // Verifica arquivo do view
            if(file_exists('../app/views/'. $view .'.php')){
                require_once '../app/views/'. $view .'.php';
            } else {
                // View não existe
                die('View não existe');
            }
        }
    }
?>