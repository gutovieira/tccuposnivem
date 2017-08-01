<?php 
	include("./class/db_connect.php");
	        ob_start();
        session_start();
        ob_end_clean();
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
    include("./header.php");	


	if (isset($_GET['p'])){
		$pagina = $_GET['p'].".php";
		
		if (is_file("$pagina"))
			include("$pagina");
		else
			include ("404.php");
	} else
		include ("./home.php");

?>





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