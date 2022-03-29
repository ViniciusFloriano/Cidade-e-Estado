<?php
    class Cidade{
        private $cidid;
        private $cidnome;
        private $estid;
        
        public function __construct($id, $cid, $est){ 
            $this->cidid = $id;
            $this->cidnome = $cid;
            $this->estid = $est;
        }

        public function __toString(){
            $str = "Id: ".$this->cidid."<br>Cidade: ".$this->cidnome."<br>Estado: ".$this->estid;
            
            return $str;
        }

        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO cidade (CID_NOME, EST_ID) VALUES(:CID_NOME, :EST_ID)');
            $stmt->bindParam(':CID_NOME', $this->cidnome, PDO::PARAM_STR);
            $stmt->bindParam(':EST_ID', $this->estid, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }

        function excluir($cidid){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM cidade WHERE CID_ID = :CID_ID');
            $stmt->bindParam(':CID_ID', $cidid);
            
            return $stmt->execute();
        }
       
}

?>