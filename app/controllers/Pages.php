<?php
    class Pages extends Controller {
        public function __construct(){

        }

        public function index(){

            $data = [
                'title' => 'SharePosts',
                'description' => 'Uma rede social simples para compartilhar links'
            ];

            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About Us',
                'description' => 'Aplicativo para compartilhar posts com outros usuários'
            ];

            $this->view('pages/about', $data);
        }
    }
?>