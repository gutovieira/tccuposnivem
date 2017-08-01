<?php
	session_start();

	if (@$_GET['sair'] == 'naoemeuemail'){
		session_destroy();
		echo "<script>location.href='registrar.php';</script>";
	}

	if (@$_SESSION['status_login']=='logado'){
		session_destroy();
		echo "<script>location.href='index.php';</script>";
	}
	else {
		session_destroy();
		echo "<script>location.href='index.php';</script>";
	}


/*	if (@$_GET['sair'] == 'out'){
		unset($_SESSION['us_email']);
		unset($_SESSION['us_senha']);
		unset($_SESSION['us_tipo']);
		unset($_SESSION['status_login']);
		echo "<script>location.href='login.php';</script>";
	}
*/

?>

