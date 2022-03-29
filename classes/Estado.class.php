<?php
    class Estado{
        private $estid;
        private $estnome;
        private $estsigla;
        
        public function __construct($id, $est, $sig){
            
            $this->estid = $id;
            $this->estnome = $est;
            $this->estsigla = $sig;
        }

        public function __toString(){
            $str = "Id: ".$this->estid."<br>Estado: ".$this->estnome."<br>Sigla: ".$this->estsigla;
            
            return $str;
        }
        
        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO estado (EST_NOME, EST_SIGLA) VALUES(:EST_NOME, :EST_SIGLA)');
            $stmt->bindParam(':EST_NOME', $this->estnome, PDO::PARAM_STR);
            $stmt->bindParam(':EST_SIGLA', $this->estsigla, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }
        

        function excluir($estid){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM estado WHERE EST_ID = :EST_ID');
            $stmt->bindParam(':EST_ID', $estid);
            
            return $stmt->execute();
        }
      
    }



?>