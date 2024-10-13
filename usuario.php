<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Usuário </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
</head>
<body id="body-telas">
    <div class="back-arrow" onclick="voltarPagina()">
        &#x2190;
    </div>
    <div class="container usuario">

        <h2> Bem-Vindo <?php echo $_SESSION['nome']; ?> </h2>

        <div class="icon-grid">
            <a href="./formulario.html"><img src="./img/formulario.jpeg" alt="Formulário">Formulário</a>
            <a href="./grafico.html"><img src="./img/grafico_pizza.jpeg" alt="Gráfico">Gráfico</a>
            <a href="./consulta_paciente.html"><img src="./img/consultar_form.jpeg" alt="Consultar/Imprimir">Consultar/Imprimir</a>
        </div>
    </div>
    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>
</html>