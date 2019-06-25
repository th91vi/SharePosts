<?php
    // PDO DATABASE CLASS
    // Conecta ap banco de dados
    // Cria PREPRED STATEMENTS
    // Associa valore (bind)
    // Retorna linhas e resultados

    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        // HANDLER do banco de dados
        private $dbh;
        private $stmt;
        private $error;

        public function __construct(){
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

        // Cria instância do PDO HANDLER
            try{
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Prepara declaração com QUERY
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        // Vincula VALUES
        public function bind($param,$value,$type = null){
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;                    
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }

        // Execute os PREPARED STATEMENT
        public function execute(){
            return $this->stmt->execute();
        }

        // Pega os resutados, definidos como array de objetos
        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Pega os resultados de uma única linha como objeto
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Pega contagem de linhas
        public function rowCount(){
            return $this->stmt->rowCount();
        }
    }
?>