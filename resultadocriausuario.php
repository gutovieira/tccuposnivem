<?php
	include("./class/db_connect.php");

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

    <section id="finalizado" class="about">
        <div class="container">
            <div class="row">

                        <?php  
								if ($_GET['r'] == 'pass'){
									echo "
								<div class='col-lg-12 text-center'>
									 <p><h1><span class='glyphicon glyphicon-ok text-success'></span></h1></p>
									 <br><br>
								</div>

				                <div class='text-center'>

	                                <div class=''>
	                                    <div class='form-group col-lg-3 text-center'></div>

	                                    <div class='form-group col-lg-6 text-center'>
	                                        <p class='lead text-success bg-success'> <strong>Seu cadastro foi realizado com sucesso!</strong></p>";

								} else if ($_GET['r'] == 'error'){
									echo "
								<div class='col-lg-12 text-center'>
									 <p><h1><span class='glyphicon glyphicon-thumbs-down text-danger'></h1></p>
									 <p class='lead'><strong>Que pena!</strong> </span></p>
								</div>

				                <div class='text-center'>

	                                <div class=''>
	                                    <div class='form-group col-lg-3 text-center'></div>

	                                    <div class='form-group col-lg-6 text-center'>
	                                        <p class='lead text-danger bg-danger'> <strong>Ocorreu um erro ao realizar o cadastro, tente novamente!</strong></p>";
								} else {
									echo "<script> location.href='registrar.php'; </script>";
								}
						?>


                                <br><br><br><a href="login.php" class="btn btn-success btn-md" role="button">Clique aqui para ir para página de login</a>
								<p><br><a href="esqueciminhasenha.php">Esqueceu sua senha?</a>
								<br><a href="login.php">Já é cadastrado? Clique aqui para <strong>ENTRAR</strong>!</a></p>
							</div>
							<div class="form-group col-lg-3 text-center"></div>			
						</div>
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