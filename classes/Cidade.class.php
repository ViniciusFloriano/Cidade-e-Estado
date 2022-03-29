<?php
    class Cidade{
        private $cidid;
        private $cidnome;
        private $estid;
        
        public function __construct($ncid, $nn, $neid){ 
            $this->cidid($ncid);
            $this->cidnome($nn);
            $this->estid($neid);
        }
        public function __toString(){
            $str = "Id: ".$this->cidid."<br>Cidade: ".$this->cidnome."<br>Estado: ".$this->estid;
            return $str;
        }
        public function inserir(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO cidade (CID_NOME, EST_ID) VALUES(:CID_NOME, :EST_ID)');
            $stmt->bindParam(':CID_NOME', $this->getNome());
            $stmt->bindParam(':EST_ID', $this->getSigla());
            return $stmt->execute();
        }
        public function editar($cidid){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE cidade SET CID_NOME = :CID_NOME, EST_ID = :EST_ID WHERE CID_ID = :CID_ID');
            $stmt->bindParam(':CID_ID', $this->setId($this->cidid));
            $stmt->bindParam(':CID_NOME', $this->setNome($this->cidnome));
            $stmt->bindParam(':EST_ID', $this->setSigla($this->estid));
            return $stmt->execute();
        }
        public function excluir($cidid){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM cidade WHERE CID_ID = :CID_ID');
            $stmt->bindParam(':CID_ID', $cidid);
            return $stmt->execute();
        }
        public function getNome(){
            if($this->cidnome != "")
                return $this->cidnome;
            else 
                return "Não informado";
        }
        public function getEstid(){
            if($this->estid != "")
                return $this->estid;
            else 
                return "Não informado";
        }
        public function getId(){
            if($this->cidid != "")
                return $this->cidid;
            else 
                return "Não informado";
        }
        public function setId($novoId){
            return $this->cidid = $novoId;
        }
        public function setNome($novoNome){
            return $this->cidnome = $novoNome;
        }
        public function setSigla($novoSigla){
            return $this->estid = $novoSigla;
        }
       
}

?>