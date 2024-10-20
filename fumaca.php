<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.O.S Fumaça</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body id="body-telas">
    <!-- Seta de voltar no canto superior direito -->
    <div class="back-arrow" onclick="voltarPagina()">
        &#x2190;
    </div>
    
    <div class="container">
        <h2>S.O.S Fumaça</h2>
        <div class="icon">
            <img src="./img/fumaça.jpeg" alt="Carro Fumaça" class="icon">
        </div>
        <div class="inputs">
            <input type="text" placeholder="Bairro Inicial">
            <br>
            <input type="text" placeholder="Bairro Final">
        </div>
        <div class="botao">
            <a href="#">Encaminhar carro</a>
        </div>
    </div>
    
    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>
</html>
