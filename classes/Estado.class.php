<?php
    class Estado{
        private $estid;
        private $estnome;
        private $estsigla;
        
        public function __construct($nid, $nn, $ns){
            $this->setId($nid);
            $this->setNome($nn);
            $this->setSigla($ns);
        }

        public function __toString(){
            $str = "Id: ".$this->estid."<br>Estado: ".$this->estnome."<br>Sigla: ".$this->estsigla;
            return $str;
        }
        public function inserir(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO estado (EST_NOME, EST_SIGLA) VALUES(:EST_NOME, :EST_SIGLA)');
            $stmt->bindParam(':EST_NOME', $this->getNome());
            $stmt->bindParam(':EST_SIGLA', $this->getSigla());
            return $stmt->execute();
        }
        public function editar($estid){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE estado SET EST_NOME = :EST_NOME, EST_SIGLA = :EST_SIGLA WHERE EST_ID = :EST_ID');
            $stmt->bindParam(':EST_ID', $this->setId($this->estid));
            $stmt->bindParam(':EST_NOME', $this->setNome($this->estnome));
            $stmt->bindParam(':EST_SIGLA', $this->setSigla($this->estsigla));
            return $stmt->execute();
        }
        public function excluir($estid){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM estado WHERE EST_ID = :EST_ID');
            $stmt->bindParam(':EST_ID', $estid);
            return $stmt->execute();
        }
        public function getNome(){
            if($this->estnome != "")
                return $this->estnome;

            else 
                return "Não informado";
        }
        public function getSigla(){
            if($this->estsigla != "")
                return $this->estsigla;

            else 
                return "Não informado";
        }
        public function getId(){
            if($this->estid != "")
                return $this->estid;

            else 
                return "Não informado";
        }
        public function setId($novoId){
            return $this->estid = $novoId;
        }
        public function setNome($novoNome){
            return $this->estnome = $novoNome;
        }
        public function setSigla($novoSigla){
            return $this->estsigla = $novoSigla;
        } 
      
    }



?>