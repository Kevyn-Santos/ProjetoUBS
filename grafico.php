<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Pacientes</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Certifique-se de que o arquivo CSS está no mesmo diretório -->
</head>
<body class="power-bi">
    <div class="back-arrow" onclick="voltarPagina()">
        &#x2190;
    </div>
    <img src="./img/img_power.png" alt="">
    <!-- <div class="container">
        <h2>Gráfico</h2>
        <div class="icon">
            <img src="./imagens/grafico.png" alt="Ícone Gráfico" class="icon">
        </div>
        <div class="form-group">
            <label for="municipio">Município</label>
            <input type="text" id="municipio" placeholder="Digite o município">
        </div>
        <div class="form-group">
            <input type="text" placeholder="Campo 1">
        </div>
        <div class="form-group">
            <input type="text" placeholder="Campo 2">
        </div>
        <div class="form-group">
            <input type="text" placeholder="Campo 3">
        </div>
        <div class="botao">
            <a href="#">Gerar Gráfico</a>
            <a href="#">Alterar Filtro</a>
        </div>
    </div>
    -->
    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>
</html>