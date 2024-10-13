<?php include_once('functions/fnLogin.php'); include_once('functions/conn.php');?>

<?php

    $sqlUnidades = "SELECT idunidade, nome FROM unidadedesaude;";

    $stmt = $pdo-> query($sqlUnidades) or die("Falha na execção!"); 
    $resultadosUnidades = $stmt->fetchAll(PDO::FETCH_ASSOC);;


?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
</head>
<body id="body-telas">
    <div class="container login">        
        
        <h2>Login</h2>

        <img src="./img/enfermeiro.jpeg" alt="Login" class="icon">

        <form method="POST">

            <p> <b> Selecione a Unidade para logar </b> </p>

            <select name="unidade">
                <option disabled selected hidden>  </option>
            
                    <?php foreach ($resultadosUnidades as $resultado): ?>

                <option value="<?= $resultado['idunidade'] ?>"> <?= $resultado['nome'] ?></option>

            <?php endforeach; ?>
            </select>           

            <input type="text" placeholder="Usuário" name="login" required>

            <input type="password" placeholder="Senha" name="senha" required>

            <div class="buttons">
                <button name="entrar"> ENTRAR </button> <!-- Botão "Entrar" -->
            </div>
            <div>
            <a href="#" class="forgot-password">Esqueci a senha</a> <!-- Link simples -->
            </div>

        </form>
    </div>
</body>
</html>
