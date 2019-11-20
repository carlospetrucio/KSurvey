<?php

error_reporting(0);
ini_set(“display_errors”, 0 );


  $licensekey = 'adc285704d36eea9d4a23748ac0ff936';
	function curl_info($url){
    $timeout = 5000;
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_HEADER, 1);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );

		$content = curl_exec( $ch );
		$info = curl_getinfo( $ch );

		return $info;
	}

	$site = 'http://www.validation.kcoder.com.br/'.$licensekey.'.php?id=validation-mrs-license-lkey';
	$info = curl_info( $site );
	if( $info['http_code']==200 )
  {
  ini_set('default_charset', 'UTF-8'); //esta linha antes de criar a variavel conexao

	date_default_timezone_set('America/Sao_Paulo');
	session_start();

	// inicia a conexão com mysql
	$db = mysqli_connect('localhost', 'root', 'usbw', 'ksurvey');


	// declarando as variaveis
	$nome = "";
	$email    = "";
	$errors   = array();

	//ação para registro de usuário.
	if (isset($_POST['filtro_pesquisa_btn'])) {
		filtrapesquisa();
	}

	//ação para registro de usuário.
	if (isset($_POST['register_btn'])) {
		register();
	}

	// ação para login.
	if (isset($_POST['login_btn'])) {
		login();
	}

	//ação para enviar a pesquisa
	if (isset($_POST['pesquisa_btn'])) {
		inserirpesquisa();
	}


	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['usuarios']);
		header("location: gerenciamento/login.php");
	}

   function filtrapesquisa(){
		 global $db, $errors;
		 $datainicio = e($_POST['datainicio']);
		 $datafim =  e($_POST['datafim']);
		 $query = "SELECT * FROM pesquisa Where datapesquisa BETWEEN '$datainicio' AND '$datafim'";
	 }

	 //verifica se o chamado ja foi respondido
	function VerificaChamado(){
		global $db, $errors;
		$chamado = e($_GET['id']);
		$query = "SELECT * FROM pesquisa WHERE chamado = '$chamado'";
		mysqli_query($db, $query);

		}

	//INSERE MÁTRICULA NAS MINHAS PESQUISAS
	function inserirmatricula(){
		global $db, $errors;

		// Recebe todos os valores do formulário por meio de POST
		$matricula = e($_POST['matricula']);
		$query = "SELECT * FROM pesquisa  INNER JOIN resposta ON pesquisa.P1 = resposta.idresposta WHERE usuariopesquisa = '$validausuario'";
		mysqli_query($db, $query);

		}

	//INSERE A PESQUISA NO BANCO
	function inserirpesquisa(){
		global $db, $errors;

		// Recebe todos os valores do formulário por meio de POST
		//$usuariopesquisa = e($_POST['usuariopesquisa']);
		//$chamado = e($_POST['chamado']);
		$titulo = e($_POST['titulo']);
		$usuariopesquisa = e($_POST['usuariopesquisa']);
		$chamado = e($_POST['chamado']);
		$P1    =  e($_POST['P1']);
		$P2    =  e($_POST['P2']);
		$P3    =  e($_POST['P3']);
		$P4    =  e($_POST['P4']);
		$P5    =  e($_POST['P5']);
		$P6    =  e($_POST['P6']);
		$P7    =  e($_POST['P7']);
		$observacoes  =  e($_POST['observacoes']);

		// registrar usuário se não houver erros no formulário
				$query = "INSERT INTO pesquisa (usuariopesquisa,titulo,chamado,P1,P2,P3,P4,P5,P6,observacoes,datapesquisa)
						  VALUES('$usuariopesquisa','$titulo','$chamado','$P1','$P2','$P3','$P4','$P5','$P6','$observacoes',now())";
				mysqli_query($db, $query);


				header('location: index.php');


		}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// Recebe todos os valores do formulário por meio de POST
		$nome    =  e($_POST['nome']);
		$email       =  e($_POST['email']);
		$senhadousuario_1  =  e($_POST['senhadousuario_1']);
		$senhadousuario_2  =  e($_POST['senhadousuario_2']);

		// Validação de formulário: verifica se os dados estão ok
		if (empty($nome)) {
			array_push($errors, "Você precisa informar o nome do usuário");
		}
		if (empty($email)) {
			array_push($errors, "Você precisa informar o email do usuário");
		}
		if (empty($senhadousuario_1)) {
			array_push($errors, "Você precisa informar a senha do usuário");
		}
		if ($senhadousuario_1 != $senhadousuario_2) {
			array_push($errors, "A senha e confirmação não são iguais");
		}

		// registrar usuário se não houver erros no formulário
		if (count($errors) == 0) {
			$senha = md5($senhadousuario_1);
			//criptografar a senha antes de salvar no banco de dados

			if (isset($_POST['perfildousuario'])) {
				$perfildousuario = e($_POST['perfildousuario']);
				$query = "INSERT INTO usuarios (nome,email,senhadousuario,perfildousuario)
						  VALUES('$nome', '$email', '$senhadousuario', '$perfildousuario')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "Novo usuário criado!!";
				header('location: home.php');
			}else{
				$query = "INSERT INTO usuarios (nome,email,senhadousuario,perfildousuario)
						  VALUES('$nome','$email','$senha','2')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['usuarios'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "Você está logado";
				header('location: index.php');
			}

		}

	}

	// Retornar usuário pelo ID
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM usuarios WHERE idusuarios=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$email = e($_POST['email']);
		$senha = e($_POST['senha']);

		// make sure form is filled properly
		if (empty($email)) {
			array_push($errors, "Informe o e-mail");
		}
		if (empty($senha)) {
			array_push($errors, "Informe a senha");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$senha = md5($senha);

			$query = "SELECT * FROM usuarios WHERE email='$email' AND senhadousuario='$senha' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['perfildousuario'] == '1') {

					$_SESSION['usuarios'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: index.php');
				}else{
					$_SESSION['usuarios'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";

					header('location: index.php');
				}
			}else {
				array_push($errors, "Combinação de nome de usuário / senha incorreta");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['usuarios'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['usuarios']) && $_SESSION['usuarios']['perfildousuario'] == '1' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}


	//INICIANDO CONTADORES
	} else {
		echo '<body class="bg-warning text-dark">';
		echo '<center>';
		echo '<h4>USO N&Atilde;O AUTORIZADO - ENTRAR EM CONTATO COM DESENVOLVEDORES.<h4>';
		echo '</center>';
	}



  ?>
