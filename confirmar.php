<?php
	include("./class/db_connect.php");

$msg = "";

	if(!isset($_SESSION))
		session_start();

	if(!isset($_SESSION['us_email'])){
		echo "<script type='text/javascript'>location.href='registrar.php';</script>'";
	}

	$email = $_SESSION['us_email'];
    $tipo = $_SESSION['us_tipo'];

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
                                    <p class=""><h5>Se este não é seu e-mail, <a href="logout.php?sair=naoemeuemail">clique aqui.</a></h5></p>
                                </div>

                                <div class='form-group col-lg-3 text-center'></div>
                                <div class='form-group col-lg-6 text-center'>
                                    <input class='form-control' type='text' name='nome'  placeholder='Nome completo'>
                                    <br>
                                    <input class='form-control' type='text' name='endereco' placeholder='Endereço completo (Logradouro, número, complemento, Cidade/UF, CEP)'>								
									<br>
                                    <?php

                                    	if ($tipo == 'Entidade'){
                                    		echo "<input class='form-control' type='text' name='responsavel' placeholder='Nome do responsável pela entidade'>";			
                                    	} else if ($tipo == 'Aluno'){
                                    		echo "<input class='form-control' type='text' name='curso' placeholder='Nome do seu curso'>";			
                                    	} else if ($tipo == 'Professor'){
                                    		echo "<input class='form-control' type='text' name='curso' placeholder='Nome do curso em que leciona'>";			
                                    	}
                                    	
									?>
									<br>                                	
									<br><button type="submit" formmethod="post" formaction="finalizar.php" class="btn btn-success btn-md" name="finalizar">Confirmo que os dados estão corretos e aceito criar meu registro</button>
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