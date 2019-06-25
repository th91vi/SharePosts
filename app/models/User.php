<?php
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Encontra usuário por e-mail
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
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