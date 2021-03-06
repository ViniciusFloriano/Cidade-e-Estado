<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de cidades";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $busca = isset($_POST['busca']) ? $_POST['busca'] : 1;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Cidades</a>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="cadCid.php">Cadastrar cidade</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Estado.php">Estados</a>
            </li>
            <ul>
        </div>
    </div>
    </nav>
    <div class="container-fluid">
    <br><br><br>
    <form method="post">
        <div class="form-group col-lg-3">
        <h3>Procurar Cidade</h3>
        <input type="text" name="procurar" id="procurar" size="50" class="form-control" placeholder="Insira o que deseja consultar" value="<?php echo $procurar;?>"><br>
        <button name="acao" id="acao" type="submit"  class="btn btn-outline-info">Procurar</button>
        <br><br>
        <p> Ordernar e pesquisar por:</p><br>
        <form method="post" action="">
            <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
            <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> Cidade<br>
            <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> Estado<br>
    </div>
    <br><br>
    </form>
    <table class="table table-hover">
        <tr><td><b>ID</b></td>
            <td><b>Cidade</b></td>
            <td><b>Estado</b></td>
            <td><b>Editar</b></td>
            <td><b>Excluir</b></td>
        </tr>
    <?php
        $pdo = Conexao::getInstance(); 
        if($busca == 1){
            $consulta = $pdo->query("SELECT * FROM estado, cidade 
                                WHERE cidade.CID_ID LIKE '$procurar%' 
                                AND estado.EST_ID = cidade.EST_ID
                                ORDER BY cidade.CID_ID");}
        else if($busca == 2){
            $consulta = $pdo->query("SELECT * FROM estado, cidade 
                                WHERE cidade.cidNome LIKE '$procurar%' 
                                AND estado.EST_ID = cidade.EST_ID
                                ORDER BY cidade.cidNome");}
        else if($busca == 3){
            $consulta = $pdo->query("SELECT * FROM estado, cidade 
                                WHERE estado.EST_ID LIKE '$procurar%'
                                AND estado.EST_ID = cidade.EST_ID
                                ORDER BY estado.EST_ID");}
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        ?>
        <tr><td><?php echo $linha['CID_ID'];?></td>
            <td><?php echo $linha['CID_NOME'];?></td>
            <td><?php echo $linha['EST_NOME'];?></td>
            <td><a href='cadCid.php?acao=editar&CID_ID=<?php echo $linha['CID_ID'];?>'> <img class="center" src="img/edit.png" alt=""></a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoCid.php?acao=excluir&CID_ID={$linha['CID_ID']}')>Excluir cidade</a><br>"; ?></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>