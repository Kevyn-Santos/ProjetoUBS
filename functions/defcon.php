<?php
$dsn = 'mysql:host=localhost;projecttcc'; //endereco e  nome do banco de dados
$username = 'root'; //usuario root por padrao
$password = ''; // senha do banco

// Verifica se foi realizada a conexao com o banco de dados corretamente
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo 'Conexão falhou: ' . $e->getMessage();
}
?>