<?php 
//require_once ('./functions/log.php');
require_once("./functions/defcon.php");


$sqlGenero = "SELECT * FROM genero;";
$stmtG = $pdo->query($sqlGenero) or die("Falha na busca");
$generos = $stmtG->fetchAll(PDO::FETCH_ASSOC);

$sqlRaca = "SELECT * FROM raca;";
$stmtR = $pdo->query($sqlRaca) or die("Falha na busca");
$Racas = $stmtR->fetchAll(PDO::FETCH_ASSOC);

$sqlEscolaridade = "SELECT * FROM escolaridade;";
$stmtE = $pdo->query($sqlEscolaridade) or die("Falha na busca");
$Escolaridade = $stmtE->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <script src="./JS/CEPRequest.js"></script>
    <title>Formulário Completo</title>
</head>
<body>
    <div class="back-arrow" onclick="voltarPagina()">
        &#x2190;
    </div>
    <div class="form-container">
        
        <form method="POST" action="./functions/processaFormulario.php">
            <fieldset>
                <legend>Dados Gerais</legend>
                <div class="row">
                    <div class="column">
                        <label for="tipo-notificacao">1 - Tipo de Notificação:</label>
                        <select id="tipo-notificacao" name="tipo-notificacao">
                            <option value="1">Individual</option>
                        </select>
                    </div>
                    <div class="column">
                        <label for="agravo">2 - Agravo/Doença:</label>
                        <select id="agravo" name="agravo">
                            <option value="1">Dengue</option>
                            <option value="2">Chikungunya</option>
                        </select>
                        <label for="codigo-cid10">Código (CID10):</label>
                        <input type="text" id="codigo-cid10" name="codigo-cid10">
                    </div>
                    
                </div>

                <div class="row">
                    <div class="column">
                        <label for="data-notificacao">3 - Data da Notificação:</label>
                        <input type="date" id="data-notificacao" name="data-notificacao">
                    </div>
                    <div class="column">
                        <label for="uf-estado">4 - UF:</label>
                        <input type="text" id="uf-estado" name="uf-estado">
                    </div>
                    <div class="column">
                        <label for="municipio-notificacao">5 - Município de Notificação:</label>
                        <input type="text" id="municipio-notificacao" name="municipio-notificacao">
                        <label for="codigo-ibge-MunicipioNotificacao">Codigo IBGE:</label>
                        <input type="text" id="codigo-ibge-MunicipioNotificacao" name="codigo-ibge-MunicipioNotificacao">
                    </div>
                    <div class="column">
                        <label for="unidade-saude">6 - Unidade de Saúde (ou outra fonte notificadora):</label>
                        <input type="text" id="unidade-saude" name="unidade-saude">
                        <label for="codigo-unidade">Codigo:</label>
                        <input type="text" id="codigo-unidade" name="codigo-unidade">
                    </div>
                    <div class="column">
                        <label for="data-primeiro-sintomas">7 - Data dos Primeiros Sintomas:</label>
                        <input type="date" id="data-primeiro-sintomas" name="data-primeiro-sintomas">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Notificação Individual</legend>
                <div class="row">
                    <div class="column">
                        <label for="nome-paciente">8 - Nome do Paciente:</label>
                        <input type="text" id="nome-paciente" name="nome-paciente">
                    </div>
                    <div class="column">
                        <label for="data-nascimento">9 - Data de Nascimento:</label>
                        <input type="date" id="data-nascimento" name="data-nascimento">
                    </div>
                    <div class="column">
                        <label for="idade">10 - Idade:</label>
                        <input type="number" id="idade" name="idade">
                    </div>
                    <div class="column">
                        <label for="sexo">11 - Sexo:</label>
                        <select id="sexo" name="sexo">

                            <?php foreach($generos as $genero): ?>
                                    <option value="<?= $genero['IdGenero']?>"> <?= $genero['sexo']?> </option>
                            <?php endforeach;?>

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label for="gestante">12 - Gestante:</label>
                        <select id="gestante" name="gestante">
                            <option value="1">1 - 1º Trimestre</option>
                            <option value="2">2 - 2º Trimestre</option>
                            <option value="3">3 - 3º Trimestre</option>
                            <option value="4">4 - Idade gestacional Ignorada</option>
                            <option value="5">5 - Não</option>
                            <option value="6">6 - Não se aplica</option>
                            <option value="9">9 - Ignorado</option>
                        </select>
                    </div>
                    <div class="column">
                        <label for="raca-cor">13 - Raça/Cor:</label>
                        <select id="raca-cor" name="raca-cor">
                            
                            <?php foreach($Racas as $raca): ?>
                                        <option value="<?= $raca['IdRaca']?>"> <?= $raca['raca']?> </option>
                            <?php endforeach;?>

                        </select>
                    </div>
                    <div class="column">
                        <label for="raca-cor">14 - Escolaridade:</label>
                        <select id="escolaridade" name="escolaridade">

                        <?php foreach($Escolaridade as $formacao): ?>
                                        <option value="<?= $formacao['idEscolaridade']?>"> <?= $formacao['formacao']?> </option>
                            <?php endforeach;?>

                        </select>
                    </div>
                    <div class="column">
                        <label for="cartao-sus">15 - Número do Cartão SUS:</label>
                        <input type="text" id="cartao-sus" name="cartao-sus">
                    </div>
                    <div class="column">
                        <label for="CPF">15 - CPF:</label>
                        <input type="text" id="CPF" name="CPF">
                    </div>
                    <div class="column">
                        <label for="nome-mae">16 - Nome da mãe:</label>
                        <input type="text" id="nome-mae" name="nome-mae">
                    </div>
                </div>
            </fieldset>
                
            <fieldset>
                <legend>Dados de Residência</legend>

                <div class="column">
                        <label for="cep">27 - CEP:</label>
                        <input type="text" id="cep" name="cep" onchange = "buscarEndereco()">
                    </div>
                    
                <div class="row">
                    <div class="column">
                        <label for="uf-residencia">17 - UF:</label>
                        <input type="text" id="uf-residencia" name="uf-residencia">
                    </div>
                    <div class="column">
                        <label for="municipio-residencia">18 - Município de Residência:</label>
                        <input type="text" id="municipio-residencia" name="municipio-residencia">
                        
                        <label for="codigo-ibge-residencia">Codigo IBGE:</label>
                        <input type="text" id="codigo-ibge-residencia" name="codigo-ibge-residencia">
                    </div>
                    <div class="column">
                        <label for="destrito">19 - Destrito:</label>
                        <input type="text" id="destrito" name="destrito">
                    </div>
                    <div class="column">
                        <label for="bairro">20 - Bairro:</label>
                        <input type="text" id="bairro" name="bairro">
                    </div>
                    <div class="column">
                        <label for="logradouro">21 - Logradouro (rua, avenida,...):</label>
                        <input type="text" id="logradouro" name="logradouro">
                        <label for="codigo-residencia">Codigo:</label>
                        <input type="text" id="codigo-residencia" name="codigo-residencia">
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label for="numero">22 - Número:</label>
                        <input type="text" id="numero" name="numero">
                    </div>
                    <div class="column">
                        <label for="complemento">23 - Complemento (apto., casa, ...):</label>
                        <input type="text" id="complemento" name="complemento">
                    </div>
                    <div class="column">
                        <label for="geo1">24 - Geo campo 1:</label>
                        <input type="text" id="geo1" name="geo1">
                    </div>
                    <div class="column">
                        <label for="geo2">25 - Geo campo 2:</label>
                        <input type="text" id="geo2" name="geo2">
                    </div>
                    <div class="column">
                        <label for="ponto-referencia">26 - Ponto de Referência:</label>
                        <input type="text" id="ponto-referencia" name="ponto-referencia">
                    </div>
                    <div class="column">
                        <label for="telefone">28 - (DDD) Telefone:</label>
                        <input type="text" id="telefone" name="telefone">
                    </div>
                    <div class="column">
                        <label for="zona">29 - Zona:</label>
                        <select id="zona" name="zona">
                            <option value="1">Urbana</option>
                            <option value="2">Rural</option> 
                            <option value="3">Periurbana</option>
                            <option value="4">Ignorado</option>
                        </select>
                    </div>
                    <div class="column">
                        <label for="pais-fora">30 - País (se residente fora do Brasil):</label>
                        <input type="text" id="pais-fora" name="pais-fora">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Dados Clínicos e Laboratoriais</legend>
                <fieldset>
                    <legend>Investigador</legend>
                    <div class="column">
                        <label for="data-investigacao">31 - Data da investigação:</label>
                        <input type="date" id="data-investigacao" name="data-investigacao">
                    </div>
                    <div class="column">
                        <label for="ocupacao">32 - Ocupação:</label>
                        <input type="text" id="ocupacao" name="ocupacao">
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Dados Clinicos</legend>
                <div class="row">
                    <div class="column">
                        <label for="sintomas">33 - Sinais clínicos:</label><br>
                        <input type="checkbox" id="febre" name="Sinais-Clinicos[]" value="Febre">Febre
                        <input type="checkbox" id="cefaleia" name="Sinais-Clinicos[]" value="Cefaleia">Cefaleia
                        <input type="checkbox" id="vomito" name="Sinais-Clinicos[]" value="Vômito">Vômito
                        <input type="checkbox" id="dor-nas-costas" name="Sinais-Clinicos[]" value="">Dor nas costas
                        <input type="checkbox" id="artrite" name="Sinais-Clinicos[]" value="Dor nas costas">Artrite
                        <input type="checkbox" id="petequias" name="Sinais-Clinicos[]" value="Petéquias">Petéquias
                        <input type="checkbox" id="prova-do-laco-positiva" name="Sinais-Clinicos[]" value="Prova do laço positiva">Prova do laço positiva
                        <input type="checkbox" id="mialgia" name="Sinais-Clinicos[]" value="Mialgia">Mialgia  <br>
                        <input type="checkbox" id="exantema" name="Sinais-Clinicos[]" value="Exantema">Exantema
                        <input type="checkbox" id="nauseas" name="Sinais-Clinicos[]" value="Náuseas">Náuseas
                        <input type="checkbox" id="conjutivite" name="Sinais-Clinicos[]" value="Conjutivite">Conjutivite
                        <input type="checkbox" id="artralgia-intensa" name="Sinais-Clinicos[]" value="Artralgia intensa">Artralgia intensa
                        <input type="checkbox" id="leucopenia" name="Sinais-Clinicos[]" value="Leucopenia">Leucopenia
                        <input type="checkbox" id="dor-retroorbital" name="Sinais-Clinicos[]" value="Dor retroorbital" >Dor retroorbital
                    </div>
                    <div class="column">
                        <label for="doencas">34 - Doenças pré-existentes:</label>   <br>
                        <input type="checkbox" id="diabete" name="DoencasPreExistentes[]" value="Diabetes">Diabetes
                        <input type="checkbox" id="hepatopatias" name="DoencasPreExistentes[]" value="Hepatopatias">Hepatopatias
                        <input type="checkbox" id="hipertensao-arterial" name="DoencasPreExistentes[]" value="Hipertensão arterial">Hipertensão arterial
                        <input type="checkbox" id="doenças-auto-imunes" name="DoencasPreExistentes[]" value="Doenças auto-imunes">Doenças auto-imunes  <br>
                        <input type="checkbox" id="doencas-hematologicas" name="DoencasPreExistentes[]" value="Doenças hematológicas">Doenças hematológicas
                        <input type="checkbox" id="doenca-renal-cronica" name="DoencasPreExistentes[]" value="Doença renal crônica">Doença renal crônica
                        <input type="checkbox" id="doenca-acido-peptica" name="DoencasPreExistentes[]" value="Doença ácido-péptica">Doença ácido-péptica
                    </div>
                </fieldset> 
                <fieldset>   
                    <legend>Dados laboratoriais</legend>
                    <h4>Sorologia (IgM) Chikungunya</h4>
                    <div class="column">
                        <label for="data-coleta">35 - Data da Coleta da 1ª Amostra(S1):</label>
                        <input type="date" id="data-coleta-s1" name="data-coleta-s1">
                    </div>
                    <div class="column">
                        <label for="data-coleta">36 - Data da Coleta da 2ª Amostra(S2):</label>
                        <input type="date" id="data-coleta-s2" name="data-coleta-s2">
                    </div>
                    <h4>Exame PRNT</h4>
                    <div class="column">
                        <label for="data-coleta-PRNT">37 - Data da Coleta:</label>
                        <input type="date" id="data-coleta-PRNT" name="data-coleta-PRNT">
                    </div>
                    <div>
                    <label for="resultado">38 - Resultado:</label>   <br>
                        <input type="radio" id="febre" name="ops" value = "S1">S1
                        <input type="radio" id="febre" name="ops" value = "S2">S2
                        <input type="radio" id="febre" name="ops" value = "PRNT">PRNT
                    </div>

                    <h4>Sorologia (IgM) Dengue</h4>
                    <div class="column">
                        <label for="data-coleta-dengue">39 - Data da Coleta:</label>
                        <input type="date" id="data-coleta-dengue" name="data-coleta-dengue">
                    </div>
                    <div class="column">
                        <label for="resultadoDengue">40 - Resultado</label>
                        <select id="resultadoDengue" name="resultadoDengue">
                            <option value="1">Positivo</option>
                            <option value="2">Negativo</option> 
                            <option value="3">Inconclusivo</option>
                            <option value="4">Não realizado</option>
                        </select>
                    </div>
                    <h4>Exame NS1</h4>
                    <div class="column">
                        <label for="data-coleta-NS1">41 - Data da Coleta:</label>
                        <input type="date" id="data-coleta-NS1" name="data-coleta-NS1">
                    </div>
                    <div class="column">
                        <label for="resultadoNS1">42 - Resultado</label>
                        <select id="resultadoNS1" name="resultadoNS1">
                            <option value="1">Positivo</option>
                            <option value="2">Negativo</option> 
                            <option value="3">Inconclusivo</option>
                            <option value="4">Não realizado</option>
                        </select>
                    </div>
                    <h4>Isolamento</h4>
                    <div class="column">
                        <label for="data-isolamento">43 - Data da Coleta:</label>
                        <input type="date" id="data-isolamento" name="data-isolamento">
                    </div>
                    <div class="column">
                        <label for="resultadoIsolamento">44 - Resultado</label>
                        <select id="resultadoIsolamento" name="resultadoIsolamento">
                            <option value="1">Positivo</option>
                            <option value="2">Negativo</option> 
                            <option value="3">Inconclusivo</option>
                            <option value="4">Não realizado</option>
                        </select>
                    </div>
                    <h4>RT-PCR</h4>
                    <div class="column">
                        <label for="data-coleta-RTPCR">45 - Data da Coleta:</label>
                        <input type="date" id="data-coleta-RTPCR" name="data-coleta-RTPCR">
                    </div>
                    <div class="column">
                        <label for="resultadoRTPCR">46 - Resultado</label>
                        <select id="resultadoRTPCR" name="resultadoRTPCR">
                            <option value="1">Positivo</option>
                            <option value="2">Negativo</option> 
                            <option value="3">Inconclusivo</option>
                            <option value="4">Não realizado</option>
                        </select>
                    </div>
                    <div class="column">
                        <br>
                        <label for="sorotipo">47 - Sorotipo</label>
                        <select id="sorotipo" name="sorotipo">
                            <option value="1">DENV1</option>
                            <option value="2">DENV2</option> 
                            <option value="3">DENV3</option>
                            <option value="4">DENV4</option>
                        </select>
                    </div>
                    <div class="column">
                        <br>
                        <label for="histopatologia">48 - Histopatologia</label>
                        <select id="histopatologia" name="histopatologia">
                            <option value="1">Compativel</option>
                            <option value="2">Incompativel</option> 
                            <option value="3">Inconclusivo</option>
                            <option value="4">Não realizado</option>
                        </select>
                    </div>
                    <div class="column">
                        <br>
                        <label for="imunohistoquimica">49 - Imunohistoquímica</label>
                        <select id="imunohistoquimica" name="imunohistoquimica">
                            <option value="1">Positivo</option>
                            <option value="2">Negativo</option> 
                            <option value="3">Inconclusivo</option>
                            <option value="4">Não realizado</option>
                        </select>
                    </div>
                
                </fieldset>
            </fieldset>

            <fieldset>
                <legend>Hospitalização</legend>
                <div class="row">
                    <div class="column">
                        <label for="hospitalizacao">50 - Ocorreu Hospitalização?</label> <br>
                        <input type="radio" id="sim" name="hosp" value="Sim">Sim
                        <input type="radio" id="nao" name="hosp" value="Não">Não
                        <input type="radio" id="ignorado" name="hosp" value="Ignorado">Ignorado
                    </div>
                    <div class="column">
                        <label for="data-internacao">51 - Data da Internação:</label>
                        <input type="date" id="data-internacao" name="data-internacao">
                    </div>
                    <div class="column">
                        <label for="uf-hospitalizacao">52 - UF:</label>
                        <input type="text" id="uf-hospitalizacao" name="uf-hospitalizacao">
                    </div>
                    <div class="column">
                        <label for="municipio-hospital">53 - Município do Hospital:</label>
                        <input type="text" id="municipio-hospital" name="municipio-hospital">
                        <label for="codigo-ibge">Codigo IBGE:</label>
                        <input type="text" id="codigo-ibge" name="codigo-ibge-hospitalizacao">
                    </div>
                    <div class="column">
                        <label for="nome-hospital">54 - Nome do Hospital:</label>
                        <input type="text" id="nome-hospital" name="nome-hospital">
                        <label for="codigo">Codigo:</label>
                        <input type="text" id="codigo" name="codigo-Hospital">
                    </div>
                    <div class="column">
                        <label for="tel-hospital">55 - (DDD) Telefone:</label>
                        <input type="text" id="tel-hospital" name="tel-hospital">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Conclusão</legend>  
                <h4>Local Provável de Infecção (no período de 15 dias)</h4>
                <div class="column">
                    <label for="Local-infeccao">56 - O caso é autóctone do município de residência?</label> <br>
                    <input type="radio" id="sim" name="loc" value="Sim">Sim
                    <input type="radio" id="nao" name="loc" value="Não">Não
                    <input type="radio" id="ignorado" name="loc" value="Ignorado">Ignorado
                </div>
                <div class="column">
                    <label for="uf">57 - UF:</label>
                    <input type="text" id="uf" name="uf-Infeccao">
                </div>
                <div class="column">
                    <label for="pais">58 - País:</label>
                    <input type="text" id="pais" name="pais-infeccao">
                </div>
                <div class="column">
                    <label for="municipio-local">59 - Município:</label>
                    <input type="text" id="municipio-local" name="municipio-Infeccao">
                    <label for="codigo-ibge">Codigo IBGE:</label>
                    <input type="text" id="codigo-ibge" name="codigo-ibge-Infeccao">
                </div>
                <div class="column">
                    <label for="distrito">60 - Distrito:</label>
                    <input type="text" id="distrito" name="distrito-infeccao">
                </div>
                <div class="column">
                    <label for="bairro-conclusao">61 - Bairro:</label>
                    <input type="text" id="bairro-conclusao" name="bairro-Infeccao">
                </div>
                <div class="column">
                    <label for="classificacao">62 - Classificação:</label> <br>
                    <input type="radio" id="descartado" name="class" value="Descartado">Descartado
                    <input type="radio" id="dengue" name="class" value="Dengue">Dengue
                    <input type="radio" id="dengue-sinais" name="class" value="Dengue com Sinais de Alarme">Dengue com Sinais de Alarme
                    <input type="radio" id="dengue-grave" name="class" value="Dengue Grave">Dengue Grave
                    <input type="radio" id="chikungunya" name="class" value="Chikungunya">Chikungunya
                </div>
                <div class="column">
                    <label for="classificacao">63 - Critério de Confirmação/Descarte:</label> <br>
                    <input type="radio" id="laboratorio" name="conf" value="Laboratório">Laboratório
                    <input type="radio" id="clinico" name="conf" value="Clínico Epidemiológico">Clínico Epidemiológico
                    <input type="radio" id="investigacao" name="conf" value="Em investigação">Em investigação
                </div>
                <div class="column">
                    <label for="apres-clinica">64 - Apresentação clínica:</label> <br>
                    <input type="radio" id="aguda" name="apr" value="Aguda">Aguda
                    <input type="radio" id="cronica" name="apr" value="Crônica">Crônica
                </div>
                <div class="column">
                    <label for="classificacao">65 - Evolução do Caso:</label> <br>
                    <input type="radio" id="cura" name="evo" value="Cura">Cura
                    <input type="radio" id="obito-agravo" name="evo" value="Óbito pelo agravo">Óbito pelo agravo
                    <input type="radio" id="obito-causas" name="evo" value="Óbito por outras causas">Óbito por outras causas
                    <input type="radio" id="obito-inv" name="evo" value="Óbito em investigação">Óbito em investigação
                    <input type="radio" id="ignorado" name="evo" value="Ignorado">Ignorado
                </div>
                <div class="column">
                    <label for="data-obito">66 - Data do Óbito:</label>
                    <input type="date" id="data-obito" name="data-obito">
                </div>
                <div class="column">
                    <label for="data-encerramento">67 - Data do Encerramento:</label>
                    <input type="date" id="data-encerramento" name="data-encerramento">
                </div>
            </fieldset>

            <fieldset>
                <legend>Preencher os sinais clínicos para Dengue com Sinais de Alarme e Dengue Grave</legend>
                <fieldset>
                    <legend>Dados Clínicos - Dengue com Sinais de Alarme e Dengue Grave</legend>
                    <div class="column">
                        <label for="sinais">68 - Dengue com sinais de alarme:</label>   <br>
                        <input type="checkbox" id="hipotencao" name="dengueAlarme[]" value="Hipotensão postural e/ou lipotímia">Hipotensão postural e/ou lipotímia
                        <input type="checkbox" id="queda-abrupta" name="dengueAlarme[]" value="Queda abrupta de plaquetas">Queda abrupta de plaquetas
                        <input type="checkbox" id="vomitos" name="dengueAlarme[]" value="Vômitos persistentes">Vômitos persistentes  
                        <input type="checkbox" id="dor-abdominal" name="dengueAlarme[]" value="Dor abdominal intensa e contínua">Dor abdominal intensa e contínua
                        <input type="checkbox" id="letargia" name="dengueAlarme[]" value="Letargia ou irritabilidade">Letargia ou irritabilidade <br>
                        <input type="checkbox" id="sangramento" name="dengueAlarme[]" value="Sangramento de mucosa/outras hemorragias">Sangramento de mucosa/outras hemorragias
                        <input type="checkbox" id="aum-progressivo" name="dengueAlarme[]" value="Aumento progressivo do hematócrito">Aumento progressivo do hematócrito
                        <input type="checkbox" id="hepatomegalia" name="dengueAlarme[]" value="Hepatomegalia >= 2cm">Hepatomegalia >= 2cm
                        <input type="checkbox" id="acumulo-liq" name="dengueAlarme[]" value="Acúmulo de líquidos">Acúmulo de líquidos
                    </div>
                    <div class="column">
                        <label for="data-inicio-sinais">69 - Data de início dos sinais de alarme:</label>
                        <input type="date" id="data-inicio-sinais" name="data-inicio-sinais">
                    </div>
                    <div class="column">
                        <br>
                        <label for="dengue-grave">70 - Dengue com sinais de alarme:</label>   <br>
                        <h4>extravasamento grave de plasma</h4>
                        <input type="checkbox" id="pulso" name="dengueGrave[]" value="Pulso débil ou indetectável">Pulso débil ou indetectável
                        <input type="checkbox" id="convergente" name="dengueGrave[]" value="PA convergente <= 20 mmHg">PA convergente <= 20 mmHg
                        <input type="checkbox" id="capilar" name="dengueGrave[]" value="Tempo de enchimento capilar">Tempo de enchimento capilar 
                        <input type="checkbox" id="insuficiencia" name="dengueGrave[]" value="Acúmulo de líquidos com insuficiência respiratória">Acúmulo de líquidos com insuficiência respiratória
                        <input type="checkbox" id="tarquicardia" name="dengueGrave[]" value="Taquicardia">Taquicardia <br>
                        <input type="checkbox" id="extremidades" name="dengueGrave[]" value="Extremidades frias">Extremidades frias
                        <input type="checkbox" id="hipotencao" name="dengueGrave[]" value="Hipotensão arterial em fase tardia">Hipotensão arterial em fase tardia
                    </div>
                    <div class="column">
                        <br>
                        <h4>sangramento grave</h4>
                        <input type="checkbox" id="hematemese" name="sangramento[]" value="Hematêmese">Hematêmese
                        <input type="checkbox" id="melena" name="sangramento[]" value="Melena">Melena
                        <input type="checkbox" id="volumosa" name="sangramento[]" value="Metrorragia volumosa">Metrorragia volumosa
                        <input type="checkbox" id="sangramento" name="sangramento[]" value="Sangramento do SNC">Sangramento do SNC
                    </div>
                    <div class="column">
                        <br>
                        <h4>compromentimento grave de órgãos</h4>
                        <input type="checkbox" id="ast" name="compOrgaos[]" value="AST/ALT > 1.000">AST/ALT > 1.000
                        <input type="checkbox" id="miocardite" name="compOrgaos[]" value="Miocardite">Miocardite
                        <input type="checkbox" id="conciencia" name="compOrgaos[]" value="Alteração da consciência">Alteração da consciência
                        <input type="checkbox" id="especificar" name="compOrgaos[]" value="Outros órgãos:">Outros órgãos, especificar
                        <input type="text" id="especificacao" name="compOrgaos[]">
                    </div>
                    <div class="column">
                        <br>
                        <label for="data-inicio-gravdade">71 - Data de início dos sinais de gravidade:</label>
                        <input type="date" id="data-inicio-gravdade" name="data-inicio-gravdade">
                    </div>
                </fieldset>
            </fieldset>

            <fieldset>
                <legend>Informações complementares e observações</legend>
                <div class="row">
                    <div class="column">
                        <label for="observacoes">Observações Adicionais:</label>
                        <textarea id="observacoes" name="observacoes"></textarea>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Investigador</legend>
                <div class="column">
                    <label for="unidade">Município/Unidade de Saúde:</label>
                    <input type="text" id="unidade" name="unidadeInvestigador">
                </div>
                <div class="column">
                    <label for="cod-unidade">Cód. da Unid. de Saúde:</label>
                    <input type="text" id="cod-unidade" name="cod-unidade-Investigador">
                </div>
                <div class="column">
                    <label for="nome-inv">Nome:</label>
                    <input type="text" id="nome-inv" name="nome-inv">
                </div>
                <div class="column">
                    <label for="funcao">Função:</label>
                    <input type="text" id="funcao" name="funcao">
                </div>
            </fieldset>

            <button type="submit">Enviar</button>
          </div>
        </form>
    </div>
    <script>
        function voltarPagina() {
            window.history.back();
        }
    </script>
</body>
</html>
