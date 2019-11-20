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