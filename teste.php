<?php 
require_once('./functions/defcon.php');

$escolaridade = 'SELECT escolaridade FROM escolaridade;';
$stmt = $pdo-> query($escolaridade) or die("Falha na execção!");
$resultado = $stmt->fetchAll(PDO::FETCH_COLUMN);;

echo $stmt;


?>