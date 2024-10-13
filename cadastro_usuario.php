
<?php include_once('functions/conn.php')?>

<?php
    
    session_start();

    $sqlFuncoes = "SELECT * FROM funcoes;";

    $stmt = $pdo-> query($sqlFuncoes) or die("Falha na execção!"); 
    $resultadosFuncoes = $stmt->fetchAll(PDO::FETCH_ASSOC);;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $nome = $_POST['nome'];
        $funcao = $_POST['funcao'];
        $coren = $_POST['coren'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $nivelAcesso = $_POST['nivelAcesso'];

        try {
            
             $stmt = $pdo->prepare('INSERT INTO enfermeiro (nome, idFuncao, coren, login, senha, nivelAcesso) VALUES (:nome, :idFuncao, :coren, :login, :senha, :nivelAcesso )');
    
             $stmt->execute(['nome' => $nome, 'idFuncao' => $funcao, 'coren' => $coren, 'login' => $login, 'senha' => $senha, 'nivelAcesso' => $nivelAcesso,]);

             echo "
                           
                           <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
                           <script type=\"text/javascript\">
                               alert(\"Usuário Cadastrado com sucesso!\");
                             </script>                           
                        ";


            $_SESSION['loginCadastro'] = $login;

            header('location:permissao_unidades.php');            


        } catch (Exception $e) {
            echo $e;
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
</head>
<body id="body-telas">

    <!-- Seta de voltar no canto superior direito -->

    <div class="back-arrow" onclick="voltarPagina()">
        &#x2190;
    </div>

    <div class="container cadastro-usuario">
        <h2>Cadastro de Usuário</h2>
        <img src="./img/cad_enferm.jpeg" alt="Ícone de Usuário" class="icon">

        <form method="POST"> 
          
        <input type="text" placeholder="Nome" name="nome" required>

        <p> <b> Selecione a Função </b> </p>

        <select name="funcao" title="Função" required>
            
            <option disabled selected hidden> </option>
            
            <?php foreach ($resultadosFuncoes as $resultado): ?>
                <option value="<?= $resultado['idFuncao'] ?>"> <?= $resultado['funcao'] ?></option>
            <?php endforeach; ?> 

        </select>

        <input type="text" placeholder="CRM/COREN" name="coren" required>
        
        <input type="text" placeholder="Login" name="login" required>

        <input type="password" placeholder="Senha Provisória" name="senha" required>

        <p> <b> Nível de Acesso </b> </p>

        <select name="nivelAcesso" title="Nível de Acesso" >
            
            <option disabled selected hidden> </option>
            <option value="1"> Administrador </option>
            <option value="2"> Usuário </option>

        </select>

        <div class="buttons">

            <button type="submit" name="cadastrar"> Cadastrar Usuário </button><br>  

        </div>
    </div>
    </form>

    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>
</html>
