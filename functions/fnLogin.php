<?php include_once('conn.php');?>
<?php session_start(); ?>
<?php 

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$unidade = $_POST['unidade'];
		$usuario = $_POST['login'];
		$senha = $_POST['senha'];	
			
		$sql = "SELECT idenfermeiro, nome, login, senha, nivelAcesso FROM enfermeiro WHERE login = '$usuario'"; 

		$stmt = $pdo-> query($sql) or die("Falha na execção!"); 
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);; 	

			
			if (!empty($result)) {					

					foreach ($result as $dados) { 				

						$idEnfermeiro = $dados['idenfermeiro'];
						$nome = $dados['nome'];
		 				$userAcesso = $dados ['login'];
		 				$senhaAcesso = $dados['senha'];
		 				$nivelAcesso = $dados['nivelAcesso'];

	 				}

	 				//echo $userAcesso;

	 				$sqlAcesso = "SELECT idunidade, idenfermeiro FROM acesso WHERE idenfermeiro = '$idEnfermeiro'"; 

					$stmt = $pdo-> query($sqlAcesso) or die("Falha na execção!"); 
					$resultadoAcesso = $stmt->fetchAll(PDO::FETCH_ASSOC);;

					
						if (!empty($resultadoAcesso)) {

							foreach($resultadoAcesso as $resultado) {

								$acessoUnidade = $resultado['idunidade'];
								$acessoEnfermeiro = $resultado['idenfermeiro'];
								
								if ($acessoUnidade == $unidade && $acessoEnfermeiro == $idEnfermeiro) {

									$_SESSION['nivelAcesso'] = $nivelAcesso;

									
									if ($usuario == $userAcesso && $senha == $senhaAcesso) {
										
										if ($_SESSION['nivelAcesso'] == 1) {
											
											$_SESSION['unidade'] = $acessoUnidade; 
											$_SESSION['nome'] = $nome;

											header('location:tela_administrador.php');

										} else {

											$_SESSION['unidade'] = $acessoUnidade; 
											$_SESSION['nome'] = $nome;

											header('location:usuario.php');
										}
									}
								}
							}
						}

					if (!isset($_SESSION['nome'])) {
									
									if ($usuario != $userAcesso || $senha != $senhaAcesso) {
										
										echo "
				       	   
								       	   <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
								           <script type=\"text/javascript\">
								               alert(\"Nome de usuário ou senha incorretos!\");
								             </script>				             
				            		 	"; 
									}									
								}

					if (!isset($_SESSION['nivelAcesso'])) {
									
									echo "
							       	   
							       	   <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='index.php'>
							           <script type=\"text/javascript\">
							               alert(\"Você não tem permissão para acessar essa unidade!\");
							             </script>				             
			            		 	";
								}			
		}						
				
	};			
?>


 						