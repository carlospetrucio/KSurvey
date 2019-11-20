<?php
include_once "gerenciamento/inc/functions.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>CRUD - Pesquisar</title>		
	</head>
	<body>
		<a href="cad_usuario.php">Cadastrar</a><br>
		<a href="index.php">Listar</a><br>
		
		<h1>Pesquisar Usuário</h1>
		
		<form method="POST" action="">
			<label>Mátricula: </label>
			<input type="text" name="usuariopesquisa" id="usuariopesquisa" placeholder="Digite o nome"><br><br>
			
			<input name="SendPesqUser" type="submit" value="Pesquisar">
		</form><br><br>
		
		<?php

		$usuariopesquisa = e($_POST['usuariopesquisa']);
		$SendPesqUser = filter_input(INPUT_POST, 'SendPesqUser', FILTER_SANITIZE_STRING);
		if($SendPesqUser){
			$nome = filter_input(INPUT_POST, 'usuariopesquisa', FILTER_SANITIZE_STRING);
			$result_usuario = "SELECT * FROM pesquisa WHERE usuariopesquisa LIKE '%$usuariopesquisa%'";
			$resultado_usuario = mysqli_query($db, $result_usuario);
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				echo "idpesquisa: " . $row_usuario['idpesquisa'] . "<br>";
				echo "matricula: " . $row_usuario['usuariopesquisa'] . "<br>";
				echo "titulo: " . $row_usuario['titulo'] . "<br><br><br>";

			}
		}
		?>
	</body>
</html>