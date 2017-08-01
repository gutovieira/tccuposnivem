<?php
ob_start();
	include("./class/db_connect.php");
ob_end_clean();

	$msg = "";

if(!isset($_SESSION))
	session_start();

	if ((@$_SESSION['status_login'])=='logado'){
		echo "<script>alert('Você já está logado!'); ";
		header("Location: index.php?p=listaProposta");

		//location.href='index.php?p=listaProposta';</script>";
	}
	else
	{

		if(isset($_POST['entrar'])){

			if (isset($_POST['user_email']) && strlen($_POST['user_email']) == 0){
			    $erro[] = "Nenhum usuário ou senha foram digitados, tente novamente.";
			}
	/*		else if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){     // função do PHP para validar o email: filter_var(variavel, FILTER_VALIDATE_EMAIL)
	    		$erro[] = "Endereço de e-mail inválido, tente novamente.";
	    	}
	*/
			else if(isset($_POST['user_email']) && strlen($_POST['user_email']) > 0){


				if(!isset($_SESSION))
					session_start();


				$_SESSION['us_email'] = $mysqli->escape_string($_POST['user_email']);
				$_SESSION['us_senha'] = md5($_POST['user_senha']);

				$sql_code = "SELECT * FROM tb_login WHERE user_email = '$_SESSION[us_email]'";
				$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
				$saida = $sql_query->fetch_assoc();
				$total = $sql_query->num_rows;

					if (substr_count($_SESSION['us_email'], '@') != 1 || substr_count($_SESSION['us_email'], '.') < 1 || substr_count($_SESSION['us_email'], '.') > 2){
						$erro[] = "E-mail inválido, preencha-o corretamente.";
					}

					else if($total==0){
						$erro[] = "Usuário inexistente, tente novamente.";
					} 
					
				else {

					if(@$saida['user_senha'] == @$_SESSION['us_senha']){
						$_SESSION['us_usuario'] = $saida['user_id'];
						$_SESSION['us_tipo'] = $saida['user_tipo'];
						$_SESSION['us_datacadastro'] = $saida['user_datacadastro'];
					} 

					else{
						$erro []= "Usuário e/ou senha incorretos, tente novamente.";
					}
				}

				if (count($erro) == 0 || !isset($erro)){
					$_SESSION['status_login'] = "logado";
					header("Location: index.php?p=listaProposta");

					//echo "<script>location.href='index.php?p=listaProposta';</script>";
				}
			}

			else if (isset($_POST['us_email']) && strlen($_POST['us_email']) == 0){
			    $erro[] = "Nenhum usuário ou senha foram digitados, tente novamente.";
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

    <section id="login" class="about">
        <div class="container">
            
            <div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<p class="lead"><strong class="text-primary">Entrar</strong></p>
					<hr>
				</div>
				<div class="col-lg-3"></div>
			</div>


            <div class="row">
				<div class="col-lg-3">
				</div>
				<div class="col-lg-9">
				</div>

                <div class="text-center">

						<form>

                        <?php  
                            if(count(@$erro) > 0){
                                foreach ($erro as $msg) {
                                    echo "<p class='text-danger'>$msg</p>";
                                }
                                echo "
                                <div class='has-error'>
                                    <div class='form-group col-lg-3'  align='left'></div>

                                    <div class='form-group col-lg-6' align='left'>
                                        <input class='form-control' type='text' name='user_email' placeholder='E-mail' value='".@$_SESSION['us_email']."'>
                                        <br><input class='form-control' type='password' name='user_senha' placeholder='Digite sua senha'>
                                    	<a href='esqueciminhasenha.php'>Esqueceu sua senha?</a>";
                                }else{
                                echo "
                                <div class=''>
                                    <div class='form-group col-lg-3 text-left'></div>

                                    <div class='form-group col-lg-6' align='left'>
                                        <input class='form-control' type='text' name='user_email'  placeholder='E-mail' value='".@$_SESSION['us_email']."'>
                                        <br><input class='form-control' type='password' name='user_senha' placeholder='Senha'>
                                        <a href='esqueciminhasenha.php'>Esqueceu sua senha?</a>";


                                }
                        ?>


                                <br>
                                <br>
                                <br>
                                <p align="center"><button type="submit" formmethod="post" class="btn btn-success btn-md" name="entrar">Entrar</button>
							</div>
							<div class="form-group col-lg-3 text-center"></div>			

							<div class="form-group col-lg-12 text-center">
								<h4><a href="registrar.php">Ainda não é cadastrado? Clique aqui e <strong>REGISTRE-SE</strong>!</a></h4></p>
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
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php 

    include("footer.php");

 ?>