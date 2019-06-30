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
    }
?>