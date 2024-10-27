<?php 
require_once ('defcon.php');
require_once ('../vendor/autoload.php');
session_start();

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


$logForm = new Logger('name');
$logForm-> pushHandler(new StreamHandler('../logs/logForm.txt', level::Notice));

$logForm->notice('foi preenchido um formulario: ', ['username' => $_SESSION['nome'], 'Level' => $_SESSION['nivelAcesso']]);

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //dados gerais

/*     $TipoNotificacao = $_POST['tipo-notificacao'];
    $Agravo = $_POST['agravo'];
    $Cid10 = $_POST['codigo-cid10'];
    $DataNotificacao = $_POST['data-notificacao'];
    $UF_Notificacao = $_POST['uf-estado'];
    $MunicipioNotficacao = $_POST['municipio-notificacao'];
    $codIbgeMunicipio = $_POST['codigo-ibge-MunicipioNotificacao'];
    $UnidadeSaude = $_POST['unidade-saude'];
    $CodUnidadeSaude = $_POST['codigo-unidade'];
    $DataprimeiroSintomas = $_POST['data-primeiro-sintomas']; */
    

    //Notificação individual
    $nomePaciente = $_POST['nome-paciente'];
    $dataNascimento = trim($_POST['data-nascimento']);
    if(!empty($dataNascimento)){
        $timestamp = strtotime($dataNascimento);
        $date = date('Y/m/d', $timestamp);
        $anoNascimento = (int) date('Y', $timestamp);
    }
    
    $Anoatual = (int) date('Y');
   (int) $Idade = $Anoatual - $anoNascimento;

    $Sexo= $_POST['sexo'];
    $Gestante= $_POST['gestante'];
    $Raca= $_POST['raca-cor'];
    $Escolaridade= $_POST['escolaridade'];

    $numeroCartaoSUS = $_POST['cartao-sus'];
    $CPF = $_POST['CPF'];
    $nomeMae = $_POST['nome-mae'];
    $Ocupacao = $_POST['ocupacao']; 

    try {
        $stmt = $pdo->prepare('INSERT INTO paciente(nome, cartao_SUS, cpf, nome_Mae, data_nasc, idade, ocupacao, IdGenero, IdRaca) 
        VALUES (:nome, :cartao_SUS, :cpf, :nome_Mae, :data_nasc, :idade, :ocupacao, :IdGenero, :IdRaca)');
        $stmt->execute(['nome' => $nomePaciente, 'cartao_SUS' => $numeroCartaoSUS, 'cpf' => $CPF, 'nome_Mae' => $nomeMae, 'data_nasc' => $date, 'idade' => $Idade, 'ocupacao' => $Ocupacao, 'IdGenero' => $Sexo, 'IdRaca' => $Raca]);
    
        echo "
                           
                           <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
                           <script type=\"text/javascript\">
                               alert(\"Formulario cadastrado com sucesso!\");
                             </script>                           
                        ";

        header('location: ../formulario.php');

    } catch (Exception $e) {
        echo $e;
    }
    
/*     //dados de residencia
    $CEP = $_POST['cep'];
    $UF = $_POST['uf-residencia'];
    $municipio = $_POST['municipio-residencia'];
    $codigoIBGE = $_POST['codigo-ibge-residencia'];
    $bairro = $_POST['bairro'];
    $logradouro = $_POST['logradouro'];
    $CodigoResidencia = $_POST['codigo-residencia'];
    $numero = $_POST['numero'];
    $referencia = $_POST['ponto-referencia'];
    $distrito = $_POST['destrito'];
    $complemento = $_POST['complemento'];
    $DDD = $_POST['telefone'];
    $geo1 = $_POST['geo1'];
    $geo2 = $_POST['geo2'];
    
    //dados investigador

    $datainvestigacao = $_POST['data-investigacao'];



    //Dados clinicos
    
    if(isset($_POST ['Sinais-Clinicos'])){
        $SinaisClinicos = $_POST ['Sinais-Clinicos'];
            echo '<br>'."Sinais Clinicos: ". '<br>';
        foreach($SinaisClinicos as $key){
            print $key. '<br>';
        }
    }else{
        echo '<br>'."não houveram sinais clinicos";
    }
    
    
    if(isset($_POST ['DoencasPreExistentes'])){
        $DoençasPreExitentes = $_POST ['DoencasPreExistentes'];
            echo '<br>'."Doenças pre existentes: ". '<br>';
        foreach($DoençasPreExitentes as $key){
            print $key. '<br>';
        }
    }else{
        echo '<br>'."não houveram Doencas Pre Existentes";
    }

    //Atribuir values as checkbox, verificar se este valor esta setado, e se estiver, colocar no array respecitivo

    //Dados Laboratoriais
    
    $DataColetaAmostra1 = $_POST['data-coleta-s1'];
    $DataColetaAmostra2 = $_POST['data-coleta-s2'];
    $DataColetaPRNT = $_POST['data-coleta-PRNT'];
    $DataColetaDengue = $_POST['data-coleta-dengue'];
    $DataColetaNS1 = $_POST['data-coleta-NS1'];
    $DataIsolamento = $_POST['data-isolamento'];
    $DataColetaRTPCR = $_POST['data-coleta-RTPCR'];


    $resultadoSorotipo = $_POST['ops'];
    $ResultadoDengue = $_POST['resultadoDengue'];
    $ResultadoNS1 = $_POST['resultadoNS1'];
    $ResultadoIsolamento = $_POST['resultadoIsolamento'];
    $ResultadoRTPCR = $_POST['resultadoRTPCR'];

    $Sorotipo = $_POST['sorotipo'];
    $histopatologia = $_POST['histopatologia'];
    $imunohistoquimica = $_POST['imunohistoquimica'];

    
    
    //Hospitalização

    
    $hospitalizacao = $_POST['hosp'];
    $DataInternacao = $_POST['data-internacao'];
    $UfHospitalizacao = $_POST['uf-hospitalizacao'];
    $municipioHospitalizacao = $_POST['municipio-hospital'];
    $codigoIbgeHospitalizacao = $_POST['codigo-ibge-hospitalizacao'];
    $NomeHospitalizacao = $_POST['nome-hospital'];
    $CodigoHospitalizacao = $_POST['codigo-Hospital'];
    $TelefoneHospital = $_POST['tel-hospital'];


    //conclusão
    
    $LocalInfeccao = $_POST['loc'];
    $Classificacao = $_POST['class'];
    $confirmacaoDeCaso = $_POST['conf'];
    $ApresentacaoClinica = $_POST['apr'];
    $EvolucaoCaso = $_POST['evo'];
    $UFinfeccao = $_POST['uf-Infeccao'];
    $PaisInfeccao = $_POST['pais-infeccao'];
    $MunicipioInfeccao = $_POST['municipio-Infeccao'];
    $CodigomunicipioDeinfeccao = $_POST['codigo-ibge-Infeccao'];
    $DistritoDeinfeccao = $_POST['distrito-infeccao'];
    $bairroDeinfeccao = $_POST['bairro-Infeccao'];
    $DataObito = $_POST['data-obito'];
    $DataEncerramento = $_POST['data-encerramento'];

    //Dengue grave
    
    //sinais de alarme
    if(isset($_POST ['dengueAlarme'])){
        $SinaisDeAlarme = $_POST ['dengueAlarme'];
            echo '<br>'."Dengue alarme: ". '<br>';
        foreach($SinaisDeAlarme as $key){
            print $key. '<br>';
        }
    }else{
        echo '<br>'."não houve sinais de dengue alarmante";
    }

    //sinais de dengue grave
    if(isset($_POST ['dengueGrave'])){
        $SinaisGraves =$_POST ['dengueGrave'];
            echo '<br>'."Dengue Grave: ". '<br>';
        foreach($SinaisGrave as $key){
            print $key. '<br>';
        }
    }else{
        echo '<br>'."não houve sinais de dengue grave";
    }
    
    //sinais de sangramento
    if(isset($_POST['sangramento'])){
        $SangramentoGrave = $_POST['sangramento'];
            echo '<br>'."Sangramento: ". '<br>';
        foreach($SangramentoGrave as $key){
            print $key. '<br>';
        }
    }else{
        echo '<br>'."não houve sinais de Sangramento";
    }

    //sinais de orgãos comprometidos
    if(isset($_POST['compOrgaos'])){
        $CompOrgaos = $_POST['compOrgaos'];
            echo '<br>'."Orgãos comprometidos: ". '<br>';
        foreach($CompOrgaos as $key){
            print $key. '<br>';
        }
    }else{
        echo '<br>'."não houveram sinais de orgãos comprometidos";
    }
   

        
    $DataInicioSinais = $_POST['data-inicio-sinais'];
    $DataInicioGravidade = $_POST['data-inicio-gravdade']; 
   

    //observaçoes

    $Observacoes = $_POST['observacoes']; */

    //dados investigador - pegar do banco

    

   /*  try{
    $stmt = $pdo->prepare('INSERT INTO paciente(nome_paciente, data_nascimento, numero_cartao_sus, cpf, nome_mae, cep, logradouro, numero, complemento, bairro, ponto_referencia, municipio_residencia, uf, distrito, telefone, geo_campo_1, geo_campo_2) 
    VALUES (:nome_Paciente, :data_nascimento, :numero_cartao_sus, :cpf, :nome_mae, :cep, :logradouro, :numero, :complemento, :bairro, :ponto_referencia, :municipio_residencia, :uf, :distrito, :telefone, :geo_campo_1, :geo_campo_2)');
    $stmt->execute(['nome_Paciente' => $nomePaciente, 'data_nascimento' => $date, 'numero_cartao_sus' => $numeroCartaoSUS, 'cpf' => $CPF, 'nome_mae' => $nomeMae, 'cep' => $CEP, 'logradouro' => $logradouro, 'numero' => $numero, 'complemento' => $complemento, 'bairro' => $bairro, 'ponto_referencia' => $referencia, 'municipio_residencia' => $municipio, 'uf' => $UF, 'distrito' => $distrito, 'telefone' => $DDD, 'geo_campo_1' => $geo1, 'geo_campo_2' => $geo2 ]);



    echo "
                           
                           <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
                           <script type=\"text/javascript\">
                               alert(\"Foumario cadastrado com sucesso!\");
                             </script>                           
                        ";
        
    } catch(Exception $e){
        echo $e;
    }



    header('location:../formulario.php'); */

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

    
    //$timestamp = strtotime($dataNascimento);
    //$date = new DateTime($data_banco);
   

    /* echo $TipoNotificacao . '<br>';
    echo $Agravo . '<br>';
    echo $Cid10 . '<br>';
    echo $DataNotificacao . '<br>';
    echo $UF_Notificacao . '<br>';
    echo $MunicipioNotficacao . '<br>';
    echo $codIbgeMunicipio . '<br>';
    echo $UnidadeSaude . '<br>';
    echo $CodUnidadeSaude . '<br>';
    echo $DataprimeiroSintomas . '<br>';

    echo $nomePaciente. '<br>'; 
    echo $dataNascimento. '<br>'; 
    echo $Sexo. '<br>'; 
    echo $Gestante. '<br>'; 
    echo $Raca. '<br>'; 
    echo $Escolaridade. '<br>'; 
    echo $numeroCartaoSUS. '<br>'; 
    echo $nomeMae. '<br>';
    
    //echo $referencia. '<br>';
    //echo $complemento. '<br>';
    //echo $distrito. '<br>'; 
    echo $date. '<br>'; 
    echo $Anoatual. '<br>';
    echo $anoNascimento. '<br>';
    echo $Idade. '<br>';

    echo $datainvestigacao. '<br>';
    echo $Ocupação. '<br>';
   

     echo $DataColetaAmostra1.'<br>';
    echo $DataColetaAmostra2.'<br>';
    echo $DataColetaPRNT.'<br>';
    echo $DataColetaDengue.'<br>';
    echo $DataColetaNS1.'<br>';
    echo $DataIsolamento.'<br>';
    echo $DataColetaRTPCR.'<br>';
    echo $resultadoSorotipo;
    echo $ResultadoDengue.'<br>';
    echo $ResultadoNS1.'<br>';
    echo $ResultadoIsolamento.'<br>';
    echo $ResultadoRTPCR.'<br>';
    echo $Sorotipo.'<br>';
    echo $histopatologia.'<br>';
    echo $imunohistoquimica.'<br>'; */

    /* 
    echo $hospitalizacao. '<br>';
    echo $DataInternacao.'<br>';
    echo $UfHospitalizacao.'<br>';
    echo $municipioHospitalizacao.'<br>';
    echo $codigoIbgeHospitalizacao.'<br>';
    echo $NomeHospitalizacao.'<br>';
    echo $CodigoHospitalizacao.'<br>';
    echo $TelefoneHospital.'<br>'; */

    /* 
    echo $LocalInfeccao. '<br>';
    echo $Classificacao. '<br>';
    echo $confirmacaoDeCaso. '<br>';
    echo $ApresentacaoClinica. '<br>';
    echo $EvolucaoCaso. '<br>';
    echo $UFinfeccao. '<br>';
    echo $PaisInfeccao. '<br>';
    echo $MunicipioInfeccao. '<br>';
    echo $CodigomunicipioDeinfeccao. '<br>';
    echo $DistritoDeinfeccao. '<br>';
    echo $bairroDeinfeccao. '<br>';
    echo $DataObito. '<br>';
    echo $DataEncerramento. '<br>';*/

    /* e
    
    cho $DataInicioSinais. '<br>';
    echo $DataInicioGravidade. '<br>'; */

    /* echo $Observacoes; */
}




