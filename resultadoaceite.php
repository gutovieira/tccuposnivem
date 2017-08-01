<?php

include("./class/db_connect.php");

ob_start();
if(!isset($_SESSION))
    session_start();
ob_end_clean();


if (((@$_SESSION['status_login']) == 'logado') && ((@$_SESSION['us_tipo']) != 'Entidade')){
    //echo "<br>".$_SESSION['us_tipo'];


    if (!isset($_GET['r'])){
        
            header("Location: index.php?p=listaProposta");

        //location.href='index.php?p=listaProposta';</script>";
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
                                            <p class='lead text-success'> <strong>Registro de aceite realizado com sucesso! <br> Agora você é um participante neste projeto.</strong></p>";

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
                                            <p class='lead text-danger'> <strong>Ocorreu um erro ao realizar o seu registro como participante neste projeto. Tente novamente!</strong></p>";
                                }
                        ?>


                                <br><br><a href="index.php?p=listaProposta" class="btn btn-success btn-md" role="button">Voltar para a lista de propostas</a>
                            </div>
                            <div class="form-group col-lg-3 text-center"></div>         
                        </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>


    </head>
    <body>

<?php

    include("footer.php");      

}
else{
    echo "<script>alert('Acesso proibido! Clique em OK para voltar!'); location.href='index.php?p=home';</script>";
}
?>