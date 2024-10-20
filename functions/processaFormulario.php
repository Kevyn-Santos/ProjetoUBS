<?php 

require_once ('./conn.php');
require_once ('../vendor/autoload.php');
session_start();

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


$logForm = new Logger('name');
$logForm-> pushHandler(new StreamHandler('../logs/logForm.txt', level::Notice));

$logForm->notice('foi preenchido um formulario: ', ['username' => $_SESSION['nome'], 'Level' => $_SESSION['nivelAcesso']]);

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nomePaciente = $_POST['nome-paciente'];
    $dataNascimento = trim($_POST['data-nascimento']);
    if(!empty($dataNascimento)){
        $timestamp = strtotime($dataNascimento);
        $date = date('Y/m/d', $timestamp);
        //echo $date; 
    } else{
        //echo 'nenhuma data atribuida';
    };
    $numeroCartaoSUS = $_POST['cartao-sus'];
    $CPF = $_POST['cpf'];
    $nomeMae = $_POST['nome-mae'];

    $CEP = $_POST['cep'];
    $UF = $_POST['uf-residencia'];
    $municipio = $_POST['municipio-residencia'];
    $codigoIBGE = $_POST['codigo-ibge-residencia'];
    $bairro = $_POST['bairro'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $referencia = $_POST['ponto-referencia'];
    $distrito = $_POST['destrito'];
    $complemento = $_POST['complemento'];
    $DDD = $_POST['telefone'];
    $geo1 = $_POST['geo1'];
    $geo2 = $_POST['geo2'];

    try{
    $stmt = $pdo->prepare('INSERT INTO paciente(nome_paciente, data_nascimento, numero_cartao_sus, cpf, nome_mae, cep, logradouro, numero, complemento, bairro, ponto_referencia, municipio_residencia, uf, distrito, telefone, geo_campo_1, geo_campo_2) 
    VALUES (:nome_Paciente, :data_nascimento, :numero_cartao_sus, :cpf, :nome_mae, :cep, :logradouro, :numero, :complemento, :bairro, :ponto_referencia, :municipio_residencia, :uf, :distrito, :telefone, :geo_campo_1, :geo_campo_2)');
    $stmt->execute(['nome_Paciente' => $nomePaciente, 'data_nascimento' => $date, 'numero_cartao_sus' => $numeroCartaoSUS, 'cpf' => $CPF, 'nome_mae' => $nomeMae, 'cep' => $CEP, 'logradouro' => $logradouro, 'numero' => $numero, 'complemento' => $complemento, 'bairro' => $bairro, 'ponto_referencia' => $referencia, 'municipio_residencia' => $municipio, 'uf' => $UF, 'distrito' => $distrito, 'telefone' => $DDD, 'geo_campo_1' => $geo1, 'geo_campo_2' => $geo2]);



    echo "
                           
                           <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
                           <script type=\"text/javascript\">
                               alert(\"Foumario cadastrado com sucesso!\");
                             </script>                           
                        ";
        
    } catch(Exception $e){
        echo $e;
    }



    header('location:../formulario.php');

    /* echo $nomePaciente . '<br>';
    
    echo $numeroCartaoSUS . '<br>';
    echo $nomeMae . '<br>';
    echo $CEP . '<br>';
    echo $UF . '<br>';
    echo var_dump($municipio) . '<br>';
    echo var_dump($bairro) . '<br>';
    echo var_dump($logradouro) . '<br>';
    echo $DDD . '<br>';
    echo $codigoIBGE . '<br>'; */
    //echo var_dump($CEP, $logradouro, $numero, $complemento, $bairro, $referencia, $municipio, $UF, $distrito, $DDD);

    /* echo var_dump($referencia). '<br>';
    echo var_dump($complemento). '<br>';
    echo var_dump($distrito). '<br>'; */
    //$timestamp = strtotime($dataNascimento);
    //$date = new DateTime($data_banco);
   

}




