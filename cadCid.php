<!DOCTYPE html>

<?php
    include_once "acaoCid.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $cidid = isset($_GET['CID_ID']) ? $_GET['CID_ID'] : "";
    if ($cidid > 0)
        $dados = buscarDados($cidid);
}
    $title = "Cadastro de cidades";
    $cidnome = isset($_POST['CID_NOME']) ? $_POST['CID_NOME'] : "";
    
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/estilo.css">

</head>


<body>

    <div class="container-fluid">
<br>

<h3>Insira a cidade</h3><hr>

        <form method="post" action="acaoCid.php">
        <div class="form-group col-lg-3">
        <label>ID</label>
                    <input readonly  type="text" name="CID_ID" id="CID_ID" class="form-control" value="<?php if ($acao == "editar") echo $dados['CID_ID']; else echo 0; ?>"><br>

        <label>Nome da Cidade </label>
                    <input name="CID_NOME" id="CID_NOME" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['CID_NOME']; ?>" placeholder="Digite a cidade"><br>
                

        <label> Escolha o Estado </label><br>
                    <select name="EST_ID" id="EST_ID" class="form-select"> 
                        <?php
                            $pdo = Conexao::getInstance(); 
                
                            $consulta = $pdo->query("SELECT * FROM estado");

                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   

                                if ($acao == "editar") echo $dados['EST_ID']; 
                                                                    
                                ?>

                
              <option value="<?php echo $linha['EST_ID'];?>"> <?php if ($acao == "editar") $dados['EST_ID']; ?>  <?php echo $linha['EST_NOME'];?></option> 
               <?php }
               ?>
    </select>

<br><br>


    <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-outline-secondary">
                     Adicionar 
                </button>

                            </div>
                </div>
           
    </form>
    

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>