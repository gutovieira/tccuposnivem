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

?>

