<?php

	include("./class/db_connect.php");

$msg = "";

if (isset($_POST['finalizarproposta'])){


    // Verificar se o usuário clicou no botão submit sem preencher titulo e resumo, e exibe um alerta de erro

    if ((strlen(@$_POST['proposta_titulo']) == 0) || (strlen(@$_POST['proposta_titulo']) == 0) || (strlen(@$_POST['proposta_resumo']) == 0) || (strlen(@$_POST['proposta_resumo']) == 0)){
    	$erro[] = "Digite um título e um resumo antes de cadastrar sua proposta!";
    	$has_error = "has-error";

    	if(!isset($_SESSION))
			session_start();

	    $prop_titulo_session = $_POST['proposta_titulo'];
	    $prop_resumo_session = $_POST['proposta_resumo'];

    }
    else {

    // Registro dos dados

    	# Verificar se a sessão foi aberta, se não (!isset) inicia a sessão:

	    if(!isset($_SESSION))
			session_start();


	// Inserção no Banco e Redirecionamento

	    foreach ($_POST as $chave => $valor)       
	        $_SESSION[$chave] =  mysqli_real_escape_string($mysqli,$valor);         
	        # Linha acima se aplica o tratamento da variável para prevenção contra SQL injection - usar a função real_escape_string();

	    $proposta_titulo = $_SESSION['proposta_titulo'];
	    $proposta_resumo = $_SESSION['proposta_resumo'];
	    $proposta_status_inicial = "ABERTO";
	    $proposta_entidadeUserID = $_SESSION['us_usuario'];

		# Cria um registro de login na tabela tb_login

		$sql_code = "INSERT INTO tb_proposta (
        proposta_titulo,
        proposta_resumo,
        proposta_datacadastro,
        proposta_status,
        proposta_entidadeUserID)
        VALUES (
        '$proposta_titulo',
        '$proposta_resumo',
        NOW(),
        '$proposta_status_inicial',
        '$proposta_entidadeUserID'
        )";

        $insere = $mysqli->query($sql_code) or die($mysqli->error);

        if ($insere){
			unset($_SESSION['proposta_titulo'],
		    	$_SESSION['proposta_resumo']);

			// se o registro for inserido no banco com sucesso, redireciona para a página de confirmação
		        //header("Location: resultadopublicaproposta.php?r=pass");
		        echo "<script> location.href='resultadopublicaproposta.php?r=pass'; </script>";

			} 
		else {

			// se o registro NÃO for inserido no banco com sucesso, redireciona para a página de erro
			//header("Location: resultadopublicaproposta.php?r=error");
			echo "<script> location.href='resultadopublicaproposta.php?r=error'; </script>";
		}
  	}          	
}


if (!isset($_SESSION))
	session_start();

if(!isset($_SESSION['us_usuario']) || !is_numeric($_SESSION['us_usuario'])){
	
	//header("Location: login.php");
	
	echo "<script>location.href='login.php';</script>'";
}

else{ 

    $sql_code2 = "SELECT * FROM tb_login WHERE user_id = '$_SESSION[us_usuario]'";
    $sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
    $saida2 = $sql_query2->fetch_assoc();

    if ($saida2['user_tipo'] == "Entidade"){

        $sql_code = "SELECT * FROM tb_entidade WHERE entidade_userID = '$_SESSION[us_usuario]'";
        $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
        $saida = $sql_query->fetch_assoc();

	}
	else{
		//header("Location: index.php?p=home");

		echo "<script>location.href='index.php?p=home';</script>'";
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

    <section id="cadastrarProposta" class="about">
 
        <div class="container">
 
            <div class="row">
				<div class="col-lg-12">
					 <p><h3 class="text-primary">Nossos alunos e professores estão ansiosos para conhecerem sua proposta de projeto!</h3></p>
					 <hr>
				</div>
 
                <div class="text-center">

						<form>
							<div class='form-group col-lg-12' align="left">
								<p class="lead"><strong class=""><?php echo @$saida['entidade_responsavel']; ?></strong>, como representante da entidade <strong class=""><?php echo @$saida['entidade_nome']; ?></strong>, você pode agora cadastrar sua proposta de projeto em nossa plataforma de colaboração.
								Ela deve conter um resumo das principais características do projeto como por exemplo objetivo, público alvo, etc. Isto despertará nos alunos e professores um maior interesse em aceitarem desenvolver seu projeto.</p>
							</div>

							<div class='form-group col-lg-9 text-center  <?php echo @$has_error; ?>'>

								<?php
									if(count(@$erro) > 0){
								    	foreach ($erro as $msg){
								    		echo "
												<h4 class='text-danger'>".$msg."</h4>
												<br><br>";
								    	}
								    	echo "
											<input class='form-control' type='text' name='proposta_titulo' placeholder='Digite um título para sua proposta de projeto' value='".@$prop_titulo_session."'>
			                                <br>
			                                <textarea class='form-control' rows='15' name='proposta_resumo' placeholder='Digite um breve resumo de sua proposta' value=''>".@$prop_resumo_session."</textarea>
											<br>
										";
								    }
								    else {
								    	echo "
											<input class='form-control' type='text' name='proposta_titulo'  placeholder='Digite um título para sua proposta de projeto'>
			                                <br>
			                                <textarea class='form-control' rows='15' name='proposta_resumo' placeholder='Digite um breve resumo de sua proposta'></textarea>
											<br>
										";
								    }

							    ?>
														    
							</div>

							<div class="col-lg-3 well">

								<div class='col-lg-12' align="left">
									<p class="control-label lead"><strong class="text-primary">Entidade autora</strong></p><hr>
								</div> 
								<div class='form-group'>
	                            	<div class="col-lg-4" align="left">
		                            	<p class="form-control-static text-primary">UserID:</p>
		                            </div>
		                            <div class="col-lg-8" align="left">
		                            	<p class="form-control-static"><?php echo @$saida['entidade_userID']; ?></p>
									</div>
								</div>

								<div class='form-group'>
	                            	<div class="col-lg-4" align="left">
		                            	<p class="form-control-static text-primary">Nome:</p>
		                            </div>
		                            <div class="col-lg-8" align="left">
		                            	<p class="form-control-static"><?php echo @$saida['entidade_nome']; ?></p>
									</div>
								</div>

								<div class='form-group'>
	                            	<div class="col-lg-4" align="left">
		                            	<p class="form-control-static text-primary">Endereço:</p>
		                            </div>
		                            <div class="col-lg-8" align="left">
		                            	<p class="form-control-static"><?php echo @$saida['entidade_endereco']; ?></p>
									</div>
								</div>

								<div class='form-group'>
	                            	<div class="col-lg-4" align="left">
		                            	<p class="form-control-static text-primary">Responsável:</p>
		                            </div>
		                            <div class="col-lg-8" align="left">
		                            	<p class="form-control-static"><?php echo @$saida['entidade_responsavel']; ?></p>
									</div>
								</div>

								<div class='form-group'>
	                            	<div class="col-lg-4" align="left">
		                            	<p class="form-control-static text-primary">E-mail:</p>
		                            </div>
		                            <div class="col-lg-8" align="left">
		                            	<p class="form-control-static"><?php echo @$saida2['user_email']; ?></p>
									</div>
								</div>

								<div class='form-group'>
	                            	<div class="col-lg-4" align="left">
		                            	<p class="form-control-static text-primary">Membro desde:</p>
		                            </div>
		                            <div class="col-lg-8" align="left">
		                            	<p class="form-control-static"><?php echo @$saida2['user_datacadastro']; ?></p>
									</div>
								</div>
							</div>

							<div class='form-group col-lg-9 text-center'>
								<br>
								<button type="submit" formmethod="post" class="btn btn-success btn-md" name="finalizarproposta"><span class="glyphicon glyphicon-ok"></span> Cadastrar proposta de projeto</button>
								<a type="button" href="" onclick="javascript:history.go(-1)" class="btn btn-warning btn-md"><span class="glyphicon glyphicon-ban-circle"></span> Prefiro ver minha lista de projetos</a>
								<p><br><a href="logout.php">Fazer logoff? Clique aqui para <strong>SAIR</strong>!</a></p>
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