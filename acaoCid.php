<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $cidid = isset($_GET['CID_ID']) ? $_GET['CID_ID'] : 0;
        require_once ("classes/Cidade.class.php");
        $cidade = new Cidade("", "", "");
        $resultado = $cidade->excluir($cidid);
        header("location:Cidade.php");
    }

  
    
    
    

   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $cidid = isset($_POST['CID_ID']) ? $_POST['CID_ID'] : "";
        if ($cidid == 0){
            require_once ("classes/Cidade.class.php");

            $cidade = new Cidade("", $_POST['CID_NOME'], $_POST['EST_ID']);
            
            $resultado = $cidade->inserir();
            header("location:Cidade.php");
        }
        else
            editar($cidid);
    }

//Editar dados
    function editar($cidid){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE cidade SET CID_NOME = :CID_NOME, EST_ID = :EST_ID WHERE CID_ID = :CID_ID');

        $stmt->bindParam(':CID_ID', $cidid, PDO::PARAM_INT);
        $cidid = $_POST['CID_ID'];

        $stmt->bindParam(':CID_NOME', $cidnome, PDO::PARAM_STR);
        $cidnome = $_POST['CID_NOME'];

        $stmt->bindParam(':EST_ID', $estid, PDO::PARAM_STR);
        $estid = $_POST['EST_ID'];

        $stmt->execute();
        header("location:Cidade.php");
    }


//Consultar dados
    function buscarDados($cidid){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM cidade WHERE CID_ID = $cidid");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['CID_ID'] = $linha['CID_ID'];
            $dados['CID_NOME'] = $linha['CID_NOME'];
            $dados['EST_ID'] = $linha['EST_ID'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['CID_ID'] = $linha['CID_ID'];
        $dados['CID_NOME'] = $linha['CID_NOME'];
        $dados['EST_ID'] = $linha['EST_ID'];

            return $dados;
    }

?>