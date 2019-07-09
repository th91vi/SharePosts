<?php
    class Users extends Controller {
        public function __construct(){
            $this->userModel = $this->model('User');
        }
        
        public function register(){
            //Verifica por POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Processa o form

                // Proteção do formulário
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Inicia $data
                $data =[
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => '',
                ];

                // Validação de nome
                if(empty($data['name'])){
                    $data['name_error'] = 'Por favor preencha o campo de nome';
                }
                // Validação de email
                if(empty($data['email'])){
                    $data['email_error'] = 'Por favor preencha o campo de e-mail';
                } else {
                    //Verifica existência do e-mail
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_error'] = 'E-mail já cadastrado. Esqueceu sua senha?';
                    }
                }
                // Validação de senha
                if(empty($data['password'])){
                    $data['password_error'] = 'Por favor preenche o campo de e-mail';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_error'] = 'Senha precisa ter pelo menos 6 caractéres';
                }
                // Validação de confirmação de senha
                if(empty($data['confirm_password'])){
                    $data['confirm_password_error'] = 'Por favor preenche o campo de confirmação de senha';
                } else {
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_error'] = 'Confirmação de senha não é igual à senha';
                    }
                }

                // Certifica que erros estão vazios
                if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){
                    // Validado
                    
                    // Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Registra  usuário
                    if ($this->userModel->register($data)){
                        flash('register_success', 'Você está registrado e pode fazer login');
                        redirect('users/login');
                    } else {
                        die('Erro desconhecido. Contate o suporte.');
                    };
                } else {
                    //Carrega view com erros
                    $this->view('users/register', $data);
                }

            } else {
                //Inicia $data
                $data =[
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => '',
                ];

                //Carrega view
                $this->view('users/register', $data);
            }
        }
        
        public function login(){
            //Verifica por POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Processa o form

                // Proteção do formulário
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Inicia $data
                $data =[
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_error' => '',
                    'password_error' => '',
                ];

                // Validação de email
                if(empty($data['email'])){
                    $data['email_error'] = 'Por favor preenche o campo de e-mail';
                }
                // Validação de senha
                if(empty($data['password'])){
                    $data['password_error'] = 'Por favor preenche o campo de senha';
                }

                // Verifica user/email
                if($this->userModel->findUserByEmail($data['email'])){
                    //Usuário encontrado
                } else {
                    //Usuário não encontrado
                    $data['email_error'] = 'Usuário não encontrado';
                }

                // Certifica que erros estão vazios
                if(empty($data['email_error']) && empty($data['password_error'])){
                    // Validado
                    // Verifica e define usário logado
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if($loggedInUser){
                        // Cria sessão
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_error'] = 'Senha incorreta';

                        $this->view('users/login', $data);
                    }
                } else {
                    //Carrega view com erros
                    $this->view('users/login', $data);
                }

            } else {
                //Inicia $data
                $data =[
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => '',
                ];

                //Carrega view
                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('posts');
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }
    }
?>