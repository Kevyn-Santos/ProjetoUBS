<?php session_start(); ?>
<?php
    
    //$nome $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
</head>
<body id="body-telas">
    <div class="back-arrow" onclick="voltarPagina()">
        &#x2190;
    </div>
    <div class="container">

        <h2> Bem-Vindo <?php echo $_SESSION['nome']; ?> </h2>

        <div class="icon-grid">
            <a href="./cadastro_usuario.php">
                <img src="./img/cad_enferm.jpeg" alt="Cadastro de Usuário" class="icon">
                Cad. Usuário
            </a>
            <a href="./cadastro_unidade.php">
                <img src="./img/ubs.jpeg" alt="Cadastro de Unidade" class="icon">
                Cad. Unidade Município
            </a>
            <a href="./formulario.php">
                <img src="./img/formulario.jpeg" alt="Formulário" class="icon">
                Formulário
            </a>
            <a href="./grafico.php">
                <img src="./img/grafico_pizza.jpeg" alt="Gráfico" class="icon">
                Gráfico
            </a>
            <a href="./fumaca.php">
                <img src="./img/fumaça.jpeg" alt="S.O.S Fumaça" class="icon">
                S.O.S Fumaça
            </a>
            <a href="./consulta_paciente.php">
                <img src="./img/consultar_form.jpeg" alt="Consultar/Imprimir Forms" class="icon">
                Consultar/Imprimir Formulários
            </a>
        </div>
    </div>
    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>
</html>
