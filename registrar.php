<?php
	include("./class/db_connect.php");

$msg = "";

if(isset($_POST['user_email']) && strlen($_POST['user_email']) > 0){


	if(!isset($_SESSION))
		session_start();


	$_SESSION['us_email'] = $_POST['user_email'];
	$_SESSION['us_senha'] = $_POST['user_senha'];
	$_SESSION['us_tipo']  = $_POST['user_tipo'];

	$sql_code = "SELECT * FROM tb_login WHERE user_email = '$_SESSION[us_email]'";
	$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
	$dado = $sql_query->fetch_assoc();
	$total = $sql_query->num_rows;

	@$email = $mysqli->escape_string($_POST['user_email']);

	count($_SESSION['us_email']);

	if($total>0){
		$erro[] = "Endereço de e-mail já cadastrado, tente novamente.";
	} 
	else if (isset($_POST['user_email']) && strlen($_POST['user_email']) == 0){
		$erro[] = "Nenhum usuário ou senha foram digitados, tente novamente.";
	}

	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){     // função do PHP para validar o email: filter_var(variavel, FILTER_VALIDATE_EMAIL)
    	$erro[] = "Endereço de e-mail inválido, tente novamente.";
	}
	
	if (count($erro) == 0 || !isset($erro)){
		echo "<script>location.href='confirmar.php';</script>";
	}
}

?>



<html>
	<head>

    <meta charset="utf-8">
    <!-- If IE use the latest rendering engine -->
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <!-- Set the page to the width of the device and set the zoom level -->
    <meta name="viewport" content="width = device-width, initial-scale = 1">

    <title>Sociversidade - TCC UNIVEM</title>

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">



<! Inicio teste do StartBootstrap!>
    <!-- Custom CSS -->
    <link href="./css/tcc1.css" rel="stylesheet">
        <!-- Custom CSS -->
    <link href="./css/tcc3.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<!// Fim teste do StartBootstrap !>


	</head>
	<body>

<?php
    include("header.php");		
?>

    <section id="login" class="services">
        <div class="container">
            <div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<p class="lead"><strong class="text-primary">Registrar-se</strong></p>
					<hr>
					<p class="lead">Note que seu e-mail será seu <strong><i>login de acesso</i></strong>.</p>
				</div>
				<div class="col-lg-3"></div>
			</div>

            <div class="row">

                <div class="text-center">

						<form>

                        <?php  
                            if(count(@$erro) > 0){
                                foreach ($erro as $msg) {
                                    echo "<p class='text-danger'>$msg</p>";
                                }
                                echo "
                                <div class='has-error'>
                                    <div class='form-group col-lg-3 text-center'></div>

                                    <div class='form-group col-lg-6 text-center'>
                                        <input class='form-control' type='text' name='user_email' placeholder='E-mail' value='".@$_SESSION['us_email']."'>
                                        <br><input class='form-control' type='password' name='user_senha' placeholder='Digite sua senha'>";
                                    
                                }else{
                                echo "
                                <div class=''>
                                    <div class='form-group col-lg-3 text-center'></div>

                                    <div class='form-group col-lg-6 text-center'>
                                        <input class='form-control' type='text' name='user_email'  placeholder='E-mail' value='".@$_SESSION['us_email']."'>
                                        <br><input class='form-control' required type='password' name='user_senha' placeholder='Senha'>";


                                }
                        ?>


																
								<br>
								<select class="form-control" required name="user_tipo">
								  <option value="Aluno">Sou um Aluno</option>
								  <option value="Professor">Sou um Professor</option>
								  <option value="Entidade">Sou representante de uma Entidade</option>
								</select>

								<br><br><button type="submit" formmethod="post" class="btn btn-success btn-md" name="registrar">Registrar-se</button>
							</div>
							<div class="form-group col-lg-3 text-center"></div>
							
							<div class="form-group col-lg-12">
                             	<p><br><h4><a href="login.php">Já é cadastrado? Clique aqui para <strong>ENTRAR</strong>!</a></h4></p>
							</div>
										
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
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/docs.min.js"></script>

<?php 

    include("footer.php");

 ?>
    
</body>
</html>