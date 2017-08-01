<?php
	include("./class/db_connect.php");

 if (isset($_POST['finalizar'])){

        // Registro dos dados

            # Verificar se a sessão foi aberta, se não (!isset), então iniciar a sessão:

 	if(!isset($_SESSION))
		session_start();


    foreach ($_POST as $chave => $valor)       
        $_SESSION[$chave] =  mysqli_real_escape_string($mysqli,$valor);         
        # Linha acima se aplica o tratamento da variável para prevenção contra SQL injection - usar a função real_escape_string();
                

        // Inserção no Banco e Redirecionamento

    if ((@$_SESSION['us_tipo'])=="Entidade"){
            		
    	$nome = $_SESSION['nome'];
		$endereco = $_SESSION['endereco'];
		$responsavel = $_SESSION['responsavel'];
		$email = $_SESSION['us_email'];
		$senha = md5($_SESSION['us_senha']);
		$tipo = $_SESSION['us_tipo'];

		// Cria um registro de login na tabela tb_login

		$sql_code = "INSERT INTO tb_login (
        user_email,
        user_senha,
        user_tipo,
        user_datacadastro)
        VALUES (
        '$email',
        '$senha',
        '$tipo',
        NOW()
        )";

		$insere = $mysqli->query($sql_code) or die($mysqli->error);

		// Consulta o registro de login que acabou de ser criado e obtém o user_id

		$sql_code2 = "SELECT user_id FROM tb_login WHERE user_email = '$email'";
		$sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
		$saida = $sql_query2->fetch_assoc();
		$userID2 = $saida['user_id'];

		// Cria o registro da entidade na tabela tb_entidade e adiciona o login user_id como referência de foreign key

		$sql_code3 = "INSERT INTO tb_entidade (
        entidade_nome,
        entidade_endereco,
        entidade_responsavel,
        entidade_userID)
        VALUES (
        '$nome',
        '$endereco',
        '$responsavel',
        '$userID2')";

        $insere3 = $mysqli->query($sql_code3) or die($mysqli->error);
        
		if ($insere && $insere3){
			unset($_SESSION['nome'],
	            $_SESSION['endereco'],
	            $_SESSION['responsavel'],
	            $_SESSION['us_email'],
	            $_SESSION['us_senha'],
	            $_SESSION['us_tipo']);

	        // redireciona para a página de confirmação ou erro	    	
	        
	        echo "<script> location.href='resultadocriausuario.php?r=pass'; </script>";

		} else {

			echo "<script> location.href='resultadocriausuario.php?r=error'; </script>";
		}
            	
	}

    else if ((@$_SESSION['us_tipo'])=="Aluno"){
            		
    	$nome = $_SESSION['nome'];
		$endereco = $_SESSION['endereco'];
		$curso = $_SESSION['curso'];
		$email = $_SESSION['us_email'];
		$senha = md5($_SESSION['us_senha']);
		$tipo = $_SESSION['us_tipo'];

		// Cria um registro de login na tabela tb_login

		$sql_code = "INSERT INTO tb_login (
        user_email,
        user_senha,
        user_tipo,
        user_datacadastro)
        VALUES (
        '$email',
        '$senha',
        '$tipo',
        NOW()
        )";

		$insere = $mysqli->query($sql_code) or die($mysqli->error);

		// Consulta o registro de login que acabou de ser criado e obtém o user_id

		$sql_code2 = "SELECT user_id FROM tb_login WHERE user_email = '$email'";
		$sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
		$saida = $sql_query2->fetch_assoc();
		$userID2 = $saida['user_id'];

		// Cria o registro da entidade na tabela tb_entidade e adiciona o login user_id como referência de foreign key

		$sql_code3 = "INSERT INTO tb_aluno (
        aluno_nome,
        aluno_endereco,
        aluno_curso,
        aluno_userID)
        VALUES (
        '$nome',
        '$endereco',
        '$curso',
        '$userID2')";

        $insere3 = $mysqli->query($sql_code3) or die($mysqli->error);
        
		if ($insere && $insere3){
			unset($_SESSION[nome],
	            $_SESSION[endereco],
	            $_SESSION[curso],
	            $_SESSION[us_email],
	            $_SESSION[us_senha],
	            $_SESSION[us_tipo]);

	        // redireciona para a página de confirmação ou erro
	    	echo "<script> location.href='resultadocriausuario.php?r=pass'; </script>";

		} else {

			echo "<script> location.href='resultadocriausuario.php?r=error'; </script>";
		}
            	
	}


    else if ((@$_SESSION['us_tipo'])=="Professor"){
            		
    	$nome = $_SESSION['nome'];
		$endereco = $_SESSION['endereco'];
		$curso = $_SESSION['curso'];
		$email = $_SESSION['us_email'];
		$senha = md5($_SESSION['us_senha']);
		$tipo = $_SESSION['us_tipo'];

		// Cria um registro de login na tabela tb_login

		$sql_code = "INSERT INTO tb_login (
        user_email,
        user_senha,
        user_tipo,
        user_datacadastro)
        VALUES (
        '$email',
        '$senha',
        '$tipo',
        NOW()
        )";

		$insere = $mysqli->query($sql_code) or die($mysqli->error);

		// Consulta o registro de login que acabou de ser criado e obtém o user_id

		$sql_code2 = "SELECT user_id FROM tb_login WHERE user_email = '$email'";
		$sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
		$saida = $sql_query2->fetch_assoc();
		$userID2 = $saida['user_id'];

		// Cria o registro da entidade na tabela tb_entidade e adiciona o login user_id como referência de foreign key

		$sql_code3 = "INSERT INTO tb_professor (
        professor_nome,
        professor_endereco,
        professor_curso,
        professor_userID)
        VALUES (
        '$nome',
        '$endereco',
        '$curso',
        '$userID2')";

        $insere3 = $mysqli->query($sql_code3) or die($mysqli->error);
        
		if ($insere && $insere3){
			unset($_SESSION[nome],
	            $_SESSION[endereco],
	            $_SESSION[curso],
	            $_SESSION[us_email],
	            $_SESSION[us_senha],
	            $_SESSION[us_tipo]);

	        // redireciona para a página de confirmação ou erro
	    	echo "<script> location.href='resultadocriausuario.php?r=pass'; </script>";

		} else {

			echo "<script> location.href='resultadocriausuario.php?r=error'; </script>";
		}
            	
	}

}

else{
	echo "<script> location.href='registrar.php'; </script>";
}

?> 


<html>
	<head>

	    <meta charset="utf-8">
	    <!-- If IE use the latest rendering engine -->
	    <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    <!-- Set the page to the width of the device and set the zoom level -->
	    <meta name="viewport" content="width = device-width, initial-scale = 1">

	    <title>Meu TCC</title>

	    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">



	<! Inicio teste do StartBootstrap!>
	    <!-- Custom CSS -->
	    <link href="css/tcc1.css" rel="stylesheet">
	        <!-- Custom CSS -->
	    <link href="css/tcc3.css" rel="stylesheet">
	    <!-- Custom Fonts -->
	    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<!// Fim teste do StartBootstrap !>



		<title></title>
	</head>
	<body>

<?php
    include("header.php");		
?>


    <section id="login" class="about">
        <div class="container">
            <div class="row">
				<div class="col-lg-12 text-center">
					 <p class="lead">Estamos quase terminando seu <strong class="text-primary">cadastro</strong>, agora falta pouco!
					 <br>Para finalizar seu <strong class="text-primary">registro</strong>, complete os campos abaixo com seus dados pessoais:</p>
				</div>

                <div class="text-center">

						<form>

							<div class='text-center'>

								<div class='form-group col-lg-12 text-center'>
                                    <p class='form-control-static'><h4 class='lead'>Seu e-mail: <strong><?php echo @$_SESSION[us_email]; ?></strong></h4</p>
                                </div>

                                <div class='form-group col-lg-3 text-center'></div>
                                <div class='form-group col-lg-6 text-center'>
                                    <input class='form-control' type='text' name='nome'  placeholder='Nome completo'>
                                    <br>
                                    <input class='form-control' type='text' name='endereco' placeholder='Endereço completo (Logradouro, número, complemento, Cidade/UF, CEP)'>								
									<br>
                                    <input class='form-control' type='text' name='responsavel' placeholder='Nome do Responsável'>								
									<br>                                	
									<br><button type="submit" formmethod="post" formaction="finalizar.php" class="btn btn-success btn-md" name="confirmar">Confirmo que os dados estão corretos e aceito criar meu registro</button>
									<p><br><a href="login.php">Já é cadastrado? Clique aqui para <strong>ENTRAR</strong>!</a></p>
								</div>
								<div class="form-group col-lg-3 text-center"></div>			
							</div>
						</form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
</body>
</html>

<?php 

    include("footer.php");

 ?>