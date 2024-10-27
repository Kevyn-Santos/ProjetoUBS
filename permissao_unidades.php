<?php include_once('functions/conn.php');?>

<?php 
    
    session_start();

    $login = $_SESSION['loginCadastro'];

    $sqlEnfermeiros = "SELECT * FROM enfermeiro WHERE login = '$login';";

    $stmt = $pdo-> query($sqlEnfermeiros) or die("Falha na execção!"); 
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);;

    foreach($resultado as $dados) {

        $_SESSION['id'] = $dados['idenfermeiro'];
        $_SESSION['nomeEnfermeiro'] = $dados['nome'];

    }     

    $sqlUnidades = "SELECT idunidade, nome FROM unidadedesaude;";

    $stmt = $pdo-> query($sqlUnidades) or die("Falha na execção!"); 
    $resultadosUnidades = $stmt->fetchAll(PDO::FETCH_ASSOC);;

    if (!isset($_SESSION['unidades'])) {

        $_SESSION['unidades'] = [];
    }    

        if (isset($_POST['adicionarUnidade'])) {

            
            $codUnidade = $_POST['unidadedeSaude'];

            if (empty($codUnidade)) {

                echo "
                           
                           <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
                           <script type=\"text/javascript\">
                               alert(\"Selecione pelo menos uma Unidade!\");
                             </script>                           
                        ";                 

            } else {           

            //echo $codUnidade;

            if (!in_array($codUnidade, $_SESSION['unidades'])) {

            $_SESSION['unidades'][] = $codUnidade;
        }

        }
     }  

    if (isset($_GET['removerUnidade'])) {

        $codUnidade = $_GET['removerUnidade'];

        if (($key = array_search($codUnidade, $_SESSION['unidades'])) !== false) {

            unset($_SESSION['unidades'][$key]);
        }
    } 

 ?>
 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permissão de Unidades</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
</head>
<body>

    <form method="POST">

        <p> <b> Locais de Trabalho </b> </p>

        <select name="unidadedeSaude" >
            
            <option disabled selected hidden> </option>
            
            <?php foreach ($resultadosUnidades as $resultado): ?>

                <option value="<?= $resultado['idunidade'] ?>"> <?= $resultado['nome'] ?></option>

            <?php endforeach; ?>

        </select>


        <button  name="adicionarUnidade"> Adicionar Unidade </button>


         <p> <b> Unidades selecionadas: </b> </p>
        <table align="center">            

                <?php foreach ($_SESSION['unidades'] as $codUnidade): ?>
                    <?php
                    
                        $stmt = $pdo->prepare("SELECT nome FROM unidadedesaude WHERE idunidade = :codUnidade");
                        $stmt->execute([':codUnidade' => $codUnidade]);
                        $unidade = $stmt->fetch();
                    ?>
                    <tr>
                        <td><?= $unidade['nome'] ?></td>

                        <td><a href="permissao_unidades.php?removerUnidade=<?= $codUnidade?>">Remover</a></td>
                    </tr>
                <?php endforeach; ?>
            
        </table> <br> <br>


        <button  name="atribuirUnidades"> Atribuir Unidades ao Usuário <?php echo $_SESSION['nomeEnfermeiro'];?>  </button> <br> <br>

        <button name="telaAdministrador"> Voltar a tela de Administrador </button>

    </form>

</body>
</html>



<?php      

    if (isset($_POST['atribuirUnidades'])) {
        
        try {
            
            foreach ($_SESSION['unidades'] as $idUnidade) {
                
                $stmt = $pdo->prepare("INSERT INTO acesso (idunidade, idenfermeiro)

                 VALUES (:idunidade, :idenfermeiro)");

                $stmt->execute([ ':idunidade' => $idUnidade,':idenfermeiro' => $_SESSION['id']]);            

            }

            echo "
                           
                           <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
                           <script type=\"text/javascript\">
                               alert(\"Unidades Atribuidas com Sucesso!\");
                             </script>                           
                        "; 
            $_SESSION['unidades'] = [];
            
                       
        } catch (Exception $e) {
            echo $e;
        }
    }

    if (isset($_POST['telaAdministrador'])) {
        
        header('location:tela_administrador.php');

        $_SESSION['loginCadastro'] = [];
        $_SESSION['id'] = [];
        $_SESSION['nomeEnfermeiro'] = [];

    }

?>


    

    

    

 <!--     if (isset($_POST['atribuirUnidades'])) {

        try {
            
            $unidadesSelecionadas = $_SESSION['unidades'];
        
            foreach ($unidadesSelecionadas as $unidade) {

            $stmt = $pdo->prepare("INSERT INTO acesso (idunidade, idenfermeiro) 
                                    VALUES (:idunidade, :idenfermeiro)");

            $stmt->execute([ ':idunidade' => $unidade,':idenfermeiro' => $idEnfermeiro]);
        }
            $_SESSION['unidades'] = [];

            echo "Unidades Atribuidas com sucesso!";
        
        } catch (Exception $e) {
            echo $e;
            echo "Selecione ao menos uma Unidade.";
        }

    } -->