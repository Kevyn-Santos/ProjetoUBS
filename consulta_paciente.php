<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Pacientes</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Certifique-se de que o arquivo CSS está no mesmo diretório -->
</head>
<body id="body-telas">
    <!-- Seta de voltar no canto superior direito -->
    <div class="back-arrow" onclick="voltarPagina()">
        &#x2190;
    </div>
    
    <div class="container">
        <h2>Consulta Formulário</h2>
        <div class="icon">
            <img src="./img/formulario.jpeg" alt="Ícone Consulta" class="icon">
        </div>
        <div class="form-group">
            <input type="text" id="nome" name="nome" placeholder="Nome">
        </div>
      
        <div class="botao">
            <a href="#">Consultar</a>
            <a href="Ficha.php">Imprimir</a>
            <a href="#">Alterar</a>
            <a href="#">Enviar</a>
        </div>
    </div>
    
    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>
</html>
