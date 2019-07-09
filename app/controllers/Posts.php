<?php
    class Posts extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }

        public function index(){
            //Carrega post
            $posts = $this->postModel->getPosts();

            $data = [
                'posts' => $posts
            ];

            $this->view('posts/index', $data);
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Proteção contra injeção no POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];

                // Valida título
                if(empty($data['title'])){
                    $data['title_error'] = 'Por favor escreva o título';
                }
                // Valida text/body
                if(empty($data['body'])){
                    $data['body_error'] = 'Por favor escreva o corpo do texto';
                }

                // Verifica que não existem erros
                if (empty($data['title_error']) && empty($data['body_error'])) {
                    // Valida que não existem erros
                    if($this->postModel->addPost($data)){
                        flash('post_message', 'Post adicionado');
                        redirect('posts');
                    } else {
                        die('Erro desconhecido. Contate o suporte');
                    }
                } else {
                    // Carrega view com erros
                    $this->view('posts/add', $data);
                }

            } else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];
    
                $this->view('posts/add', $data);
            }
        }
        
        public function edit($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Proteção contra injeção no POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];

                // Valida título
                if(empty($data['title'])){
                    $data['title_error'] = 'Por favor escreva o título';
                }
                // Valida text/body
                if(empty($data['body'])){
                    $data['body_error'] = 'Por favor escreva o corpo do texto';
                }

                // Verifica que não existem erros
                if (empty($data['title_error']) && empty($data['body_error'])) {
                    // Valida que não existem erros
                    if($this->postModel->updatePost($data)){
                        flash('post_message', 'Post atualizado');
                        redirect('posts');
                    } else {
                        die('Erro desconhecido. Contate o suporte');
                    }
                } else {
                    // Carrega view com erros
                    $this->view('posts/edit', $data);
                }

            } else {
                //Pega post existente do model
                $post = $this->postModel->getPostById($id);

                // Verifica se o usuário é o criador do post
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }
                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body
                ];
    
                $this->view('posts/edit', $data);
            }
        }

        //Modelo de construção da URL: posts/show/param
        public function show($id){
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);

            $data = [
                'post' => $post,
                'user' => $user
            ];

            $this->view('posts/show', $data);
        }

        public function delete($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Pega post existente do model
                $post = $this->postModel->getPostById($id);
                // Verifica se o usuário é o criador do post
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }

                
                if($this->postModel->deletePost($id)){
                    flash('post_message','Post deletado');
                    redirect('posts');
                } else {
                    die('Erro inesperado. Entre em contato com o suporte.');
                }
            } else {
                redirect('posts');
            }
        }
    }
?>