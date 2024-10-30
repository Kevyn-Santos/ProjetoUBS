<?php 
require_once ('defcon.php');
require_once ('../vendor/autoload.php');
session_start();

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


/* $logForm = new Logger('name');
$logForm-> pushHandler(new StreamHandler('../logs/logForm.txt', level::Notice));

$logForm->notice('foi preenchido um formulario: ', ['username' => $_SESSION['nome'], 'Level' => $_SESSION['nivelAcesso']]); */

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
    $DataprimeiroSintomas = $_POST['data-primeiro-sintomas']; 
    $datainvestigacao = $_POST['data-investigacao'];*/
    

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

    //echo "$nomePaciente,  $date, $Idade, $Sexo, $Gestante, $Raca, $Escolaridade, $numeroCartaoSUS, $CPF, $nomeMae, $Ocupacao". '<br>';

    //dados de residencia
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
       



    
    //crie um array com as doenças, insira elas no array, crie uma tabela internediaria que armazenará o id do paciente, as doenças que ele tem e o id de cada uma delas, adicione as doenças ao banco de dados a partir do array. Sendo assim, pode ser utilizado um select para as inserçoes(como no cadastro de usuarios), ou eu posso verificar cada doença no array, comparar com o banco, e se estiverem no bancom adicionar nesta tabela internediaria.


    /* Estruturas de consulta e inserção */

    //Consulta de municipio
   if (isset($municipio) && !empty($municipio)) { //verifica se municipio esta preenchido
        // Consulta SQL com depuração
        $sqlMunicipio = "SELECT municipio.IdMunicipio, municipio.cidade, municipio.codigoIBGE FROM municipio LEFT JOIN endereco ON endereco.IdMunicipio = municipio.IdMunicipio WHERE municipio.cidade LIKE :MunicipioResidencia"; //seleciona o municipio a partir dos dados de endereço utilizando o left join
                         
        $stmtM = $pdo->prepare($sqlMunicipio); 
    
        // Adiciona curingas para busca parcial
        $Municipio_Param = '%' . $municipio . '%'; // verifica uma aproximação do que esta digitado no campo municipio
        $stmtM->bindParam(':MunicipioResidencia', $Municipio_Param, PDO::PARAM_STR); //passa todos os parametros anteriores
    
        // Exibe a consulta SQL e o parâmetro para depuração
        //echo "Consulta SQL: $sqlMunicipio". "<br>";
       //echo "Parâmetro de busca: $Municipio_Param". "<br>";

    
        // Executa a consulta
        $stmtM->execute();
    
        // Verifica os resultados
        if ($stmtM->rowCount() > 0) { //verifica se esta cidade passada no stmtM existe no banco de dados, e se existir, coloca ela na variavel IdMunicipio
            while ($Cidades = $stmtM->fetch(PDO::FETCH_ASSOC)) {

                    //echo "cidade encontrada: " . $Cidades['IdMunicipio']. " - " .$Cidades['cidade']. "<br>";

                    $IdMunicipio = $Cidades['IdMunicipio'];


            }
        } else {
            echo "Nenhum nome correspondente encontrado.";
        }
    } else {
        echo "O campo de município está vazio.";
    }


    //preparação para a inserção de endereço
    $sqlEndereco = "SELECT IdEndereco FROM endereco";
        $stmtEndereco = $pdo->prepare($sqlEndereco);
        $stmtEndereco->execute();
        if ($stmtEndereco->rowCount() > 0) {
            // Captura o primeiro IdEndereco
            $row = $stmtEndereco->fetch(PDO::FETCH_ASSOC);
            $IdEndereco = $row['IdEndereco'];
            
            // Exibe o ID encontrado
            //echo "IdEndereco encontrado: " . $IdEndereco;
        } else {
           // echo "Nenhum IdEndereco encontrado.";
        }


        //Captura de Doenças pre-Existentes     
        if(isset($_POST ['DoencasPreExistentes'])){
            $DoencasPE = $_POST ['DoencasPreExistentes'];
            
        }

        /* foreach($DoencasPE as $key){
            echo $key.'<br>';
        } */

        //Try, inserção efetiva no banco

    try {
        
        /* Inserção de endereço */
        $stmtE = $pdo->prepare('INSERT INTO endereco(rua, bairro, num_Res, cep, ponto_Ref, comple, geo_camp_um, geo_camp_dois, IdMunicipio) 
        VALUES (:rua, :bairro, :num_Res, :cep, :ponto_Ref, :comple, :geo_camp_um, :geo_camp_dois, :IdMunicipio)');

        $stmtE->execute(['rua' =>$logradouro, 
        'bairro' =>$bairro, 
        'num_Res' =>$numero, 
        'cep' =>$CEP, 
        'ponto_Ref' =>$referencia, 
        'comple' =>$complemento, 'geo_camp_um' =>$geo1, 'geo_camp_dois' =>$geo2, 
        'IdMunicipio' =>$IdMunicipio]); // por fim, passa a variavel IdMunicipio como parametro para a inserção no banco

        $IdEndereco = $pdo->lastInsertId(); 
        //echo "Novo IdEndereco inserido: " . $IdEndereco;

        /* Inserção do paciente */
        $stmt = $pdo->prepare('INSERT INTO paciente(nome, cartao_SUS, cpf, nome_Mae, data_nasc, idade, ocupacao, IdGenero, IdRaca, IdGestante, IdEscolaridade, IdEndereco) 
        VALUES (:nome, :cartao_SUS, :cpf, :nome_Mae, :data_nasc, :idade, :ocupacao, :IdGenero, :IdRaca, :IdGestante, :IdEscolaridade, :IdEndereco)');
        $stmt->execute(['nome' => $nomePaciente, 'cartao_SUS' => $numeroCartaoSUS, 'cpf' => $CPF, 'nome_Mae' => $nomeMae, 'data_nasc' => $date, 'idade' => $Idade, 'ocupacao' => $Ocupacao, 'IdGenero' => $Sexo, 'IdRaca' => $Raca, 'IdGestante' => $Gestante, 'IdEscolaridade' => $Escolaridade, 'IdEndereco' => $IdEndereco]);
        
        $IdPaciente = $pdo->lastInsertId();

        /* inserção das doenças pre existentes do paciente */
        $sqlDPE = "INSERT INTO DPEPac (IdPaciente, IdDoencaPE) VALUES (:IdPaciente, :IdDoencaPE)";
            $stmtDPE = $pdo->prepare($sqlDPE);
    
            foreach($DoencasPE as $doencas){
                $stmtDPE->execute([
                    'IdDoencaPE' => $doencas,
                    'IdPaciente' => $IdPaciente
                ]);
            }

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
    
    

    /*




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




