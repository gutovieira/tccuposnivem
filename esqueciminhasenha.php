<?php
ob_start();
	include("./class/db_connect.php");
ob_end_clean();


if(isset($_POST[@ok])){

	$email = $mysqli->escape_string($_POST['us_email']);

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){		// função do PHP para validar o email: filter_var(variavel, FILTER_VALIDATE_EMAIL)
		$erro[] = "Digite um endereço válido de e-mail";

	}


	$sql_code = "SELECT * FROM tb_login WHERE user_email = '$email'";	//codigo sql
	$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);	// executa o codigo
	$dado = $sql_query->fetch_assoc();
	$total = $sql_query->num_rows;


	if($total == 0)
		$erro[] = "O email informado não existe no banco de dados.";



	if(count(@$erro) == 0 && $total > 0){		// se o email for válido e que existe no banco de dados, então o processo de criar nova senha e enviar email é executado)

		$novasenha = substr(md5(time()), 0, 4); 
		//time() é uma função que retorna a hora atual em segundos
		//substr
		// substr(string, start, end) ou substr(md5(time()), 0, 6)  é uma função para cortar um pedaço de uma string do caracter 0 até o 6
		$nscriptografada = (md5($novasenha));

//			if (mail($email, "Sua nova senha", "Sua nova senha: ".$novasenha)){
		if (1 == 1){
		$sql_code = "UPDATE tb_login SET user_senha = '$nscriptografada' WHERE user_email = '$email'";	//codigo sql
		$sql_query = $mysqli->query($sql_code) or die($mysqli->error);	// executa o codigo

		if($sql_query)	// se a senha for alterada com sucesso, criamos uma mensagem usando a própria variável $erro[] informando que foi alterada.
			$erro[] = "Senha alterada com sucesso!";

		}

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



	</head>
	<body>

<?php
    include("header.php");		
?>



<section id="esqueciminhasenha" class="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
	
            	<div class="col-lg-3"></div>
				<div class="col-lg-6 text-center">
					<p class="lead">Não se lembra da <strong class="text-primary">senha de acesso</strong>? <br>Digite seu <strong class="text-primary">email</strong> de cadastro e enviaremos imediatamente uma nova senha para seu e-mail.</p>
				</div>
			</div>
            <div class="col-lg-12 text-center">

				<form>
				

					
				<?php  
					if(count(@$erro) > 0){
						foreach ($erro as $msg) {
							echo "<p class='lead text-warning'><strong>$msg</strong></p>";

							if ($msg == "Senha alterada com sucesso!"){
								echo "<p class='lead'>Sua nova senha é: <strong>".$novasenha."</strong></p>";
							} 
						}
					
					echo "

					<div class='form-group col-lg-3 text-center'></div>

					<div class='form-group col-lg-6 text-center has-error'>
					<input class='form-control' type='text' name='us_email' placeholder='E-mail' value='".$_POST['us_email']."' >";
				
					}else{
					echo "

					<div class='form-group col-lg-3 text-center'></div>

					<div class='form-group col-lg-6 text-center'>
					<input class='form-control' type='text' name='us_email' placeholder='E-mail' value='".@$_POST['us_email']."' >";
					}

				?>

					<!--

					<input class="form-control" type="text" name="us_email" value="<?php echo (@$_POST['us_email']); ?>" placeholder="E-mail">  ====> codigo removido para tratar com has-error quando usuario ou senha estao incorretos

					-->
					

					<br><button type="submit" formmethod="post" class="btn btn-success btn-md" name="ok">Gerar nova senha</button>
					<p><br><a href="login.php">Voltar para a página de login</a></p>
					
				</div>
				<div class="form-group col-lg-3 text-center"></div>			
				
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
</body>
</html>

<?php 

    include("footer.php");

 ?>