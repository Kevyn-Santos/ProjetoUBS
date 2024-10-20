<?php include_once('functions/conn.php');

$sqlTipoUnid = "SELECT * FROM tipounidade;";

        $stmt = $pdo-> query($sqlTipoUnid) or die("Falha na execção!"); 
        $resultadosTipo = $stmt->fetchAll(PDO::FETCH_ASSOC);; 

$sqlLocalidade = "SELECT * FROM uf;";

        $stmt = $pdo-> query($sqlLocalidade) or die("Falha na execção!"); 
        $resultadosLocal = $stmt->fetchAll(PDO::FETCH_ASSOC);;

$sqlMunicipio = "SELECT * FROM municipio;";

        $stmt = $pdo-> query($sqlMunicipio) or die("Falha na execção!"); 
        $resultadosMuni = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
?>

<?php 
require_once ('./vendor/autoload.php');
session_start();

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


$log = new Logger('name');
$log-> pushHandler(new StreamHandler('./logs/log.txt', level::Debug));

if(isset($_POST['nome'])){
$log->debug("Foi cadastrada uma nova unidade: ", 
["username" => $_SESSION['nome'], "tipoUnidade" =>$_REQUEST['tipoUnidade'], "logradouro" => $_REQUEST['endereco'], "telefone" => $_REQUEST["telefone"],
"NomeUnidade" => $_REQUEST['nome'], "Estado" =>$_REQUEST['uf'], "Cidade" => $_REQUEST['cidade']]);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Unidade</title>
    <script src="./JS/mascara.js"></script>
    <link rel="stylesheet" href="./css/style.css"> <!-- Link para o arquivo de estilo externo -->
</head>
<body id="body-telas">

    <!-- Seta de voltar no canto superior direito -->
    <div class="back-arrow" onclick="voltarPagina()">
        &#x2190;
    </div>

    <div class="container">

        <h2>Cadastro de Unidade</h2>

        <div class="icon">
            <img src="./img/ubs.jpeg" alt="Ícone Hospital" class="icon">
        </div>

        <form method="POST">

        <h4> Tipo da unidade </h4>
        <select name="tipoUnidade" required>

        <?php foreach ($resultadosTipo as $resultado): ?>
            <option value="<?= $resultado['idTipoUnidade'] ?>"> <?= $resultado['tipoUnidade'] ?></option>
         <?php endforeach; ?>           

        </select>

        <input type="text" placeholder="Nome" name="nome" required>
        <input type="text" placeholder="Logradouro" name="endereco" required>
        <input type="text" placeholder="Telefone" name="telefone" maxlength="15" oninput="mascaraTelefone(this)" required>
       

        <p> <b> Localidade </b> </p>

         <table align="center">
            <tr>
                <td>
                   <p> UF </p> 
                </td>
                <td>
                    <p> Cidade </p>
                </td>
            </tr>
            <tr>
                <td>                    

                    <select name="uf" required>

                        <option disabled selected hidden>  </option>

                        <?php foreach ($resultadosLocal as $resultado): ?>
                            <option value="<?= $resultado['codUf'] ?>"> <?= $resultado['sigla'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                     <select name="cidade" required>

                        <option disabled selected hidden > </option>

                        <?php foreach ($resultadosMuni as $resultado): ?>
                            <option value="<?= $resultado['codMunicipio'] ?>"> <?= $resultado['nomeCidade'] ?></option>
                        <?php endforeach; ?>
                     </select>
                </td>
            </tr>
        </table>     

        <div class="botao">
            <button type="submit" name="cadastrar"> Cadastrar Unidade </button>
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

<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $tipoUnidade = $_POST['tipoUnidade'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $cidade = $_POST['cidade'];

        try {

           $stmt = $pdo->prepare('INSERT INTO unidadedesaude (nome, endereco, telefone, idTipoUnidade, codMunicipio) values (:nome, :endereco, :telefone,:idTipoUnidade, :codMunicipio)');
    
             $stmt->execute(['nome' => $nome, 'endereco' => $endereco, 'telefone' => $telefone, 'idTipoUnidade' => $tipoUnidade, 'codMunicipio' => $cidade]);

             echo "
                           
                           <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
                           <script type=\"text/javascript\">
                               alert(\"Unidade Cadastrada com Sucesso!\");
                             </script>                           
                        ";

         ;
            
        } catch ( error) {
            echo "Algo deu errado!";
        }


    }

    

?>
