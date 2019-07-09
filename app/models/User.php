<?php
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        // Registra usuário
        public function register($data){
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            // Vincula valores
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Executa registro
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Loga usuário
        public function login($email, $password){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        //Encontra usuário por e-mail
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            // Vincula valores
            $this->db->bind(':email', $email);

            //Retorna linha única
            $row = $this->db->single();

            //Verifica linha
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }


        //Encontra usuário por id
        public function getUserById($id){
            $this->db->query('SELECT * FROM users WHERE id = :id');
            // Vincula valores
            $this->db->bind(':id', $id);

            //Retorna linha única
            $row = $this->db->single();

            return $row;
        }
    }
?>