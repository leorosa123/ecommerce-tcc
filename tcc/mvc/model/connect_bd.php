<?php

class BD_connect{
    
        private $host = "localhost";
        private $user = "root";
        private $senha = "";
    
        public function connect_BD($bd){
            $connect = new mysqli($this->host, $this->user, $this->senha, $bd);
    
            return $connect;
        }
}

?>