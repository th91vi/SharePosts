<?php
    // App Core Class
    // Cria URLs e carrega corecontroller
    // Formato da URL: /controller/method/params

    class Core {

        // Define controllers, métodos e parâmetro padrão
        protected $currentController = 'Pages'; //controller
        protected $currentMethod = 'index'; //method
        protected $params = []; //param

        public function __construct() {
            //print_r($this->getUrl());
            $url = $this->getUrl();

            // Procura nos controller pelo primeiro valor da URL
            if(file_exists('../app/controllers/'. ucwords($url[0]) .'.php')){
                // Se o controller existir, defina-o como controller
                $this->currentController = ucwords($url[0]);
                // Unset indice 0
                unset($url[0]);
            }

            // Requisita controller
            require_once '../app/controllers/'.$this->currentController.'.php';

            // Instancia classe controller
            $this->currentController = new $this->currentController;

            // Verifica a segunda parte da URL
            if(isset($url[1])){
                // Verifica se o método existe no controller
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset indice 1
                    unset($url[1]);
                }
            }

            // Define params
            $this->params = $url ? array_values($url) : [];

            // Chama um callback com um array de params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>