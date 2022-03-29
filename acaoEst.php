<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $estid = isset($_GET['EST_ID']) ? $_GET['EST_ID'] : 0;
        require_once ("classes/Estado.class.php");
        $estado = new Estado("", "", "");
        $resultado = $estado->excluir($estid);
            header("location:Estado.php");
    }
    

   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $estid = isset($_POST['EST_ID']) ? $_POST['EST_ID'] : "";
        if ($estid == 0){
            require_once ("classes/Estado.class.php");

            $estado = new Estado("", $_POST['EST_NOME'], $_POST['EST_SIGLA']);
            
            $resultado = $estado->inserir();
            header("location:Estado.php");
        }
        else
            editar($estid);
    }

//Editar dados
    function editar($estid){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE estado SET EST_NOME = :EST_NOME, EST_SIGLA = :EST_SIGLA WHERE EST_ID = :EST_ID');

        $stmt->bindParam(':EST_ID', $estid, PDO::PARAM_INT);
        $estid = $_POST['EST_ID'];

        $stmt->bindParam(':EST_NOME', $estnome, PDO::PARAM_STR);
        $estnome = $_POST['EST_NOME'];

        $stmt->bindParam(':EST_SIGLA', $estsigla, PDO::PARAM_STR);
        $estsigla = $_POST['EST_SIGLA'];

        $stmt->execute();
        header("location:Estado.php");
    }
    

//Consultar dados
    function buscarDados($estid){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM estado WHERE EST_ID = $estid");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['EST_ID'] = $linha['EST_ID'];
            $dados['EST_NOME'] = $linha['EST_NOME'];
            $dados['EST_SIGLA'] = $linha['EST_SIGLA'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['EST_ID'] = $linha['EST_ID'];
        $dados['EST_NOME'] = $linha['EST_NOME'];
        $dados['EST_SIGLA'] = $linha['EST_SIGLA'];

            return $dados;
    }

?>