<?php

include("./class/db_connect.php");

ob_start();
if(!isset($_SESSION))
    session_start();
ob_end_clean();


if (((@$_SESSION['status_login']) == 'logado') && ((@$_SESSION['us_tipo']) != 'Entidade')){
    //echo "<br>".$_SESSION['us_tipo'];


    if ((!isset($_GET['usuario'])) || (!isset($_GET['proposta']))){
        
            header("Location: index.php?p=listaProposta");

        //location.href='index.php?p=listaProposta';</script>";
    }
    else{
/*
       echo "DEBUG: printa o usuario e a proposta passados como parametro via GET<br><br>";
        echo $_GET['usuario']." <= <br>";
        echo $_GET['proposta']." <= <br>";
        echo $_SESSION['us_tipo']."<br>";
        echo $_SESSION['us_datacadastro']." <= <br><br><br>";
*/


        // consulta todos os registros da tabela tb_aceita para ver se este usuário já aceitou este projeto para não duplicar

        $sql_code = "SELECT * FROM tb_aceita WHERE (aceita_userID = '$_GET[usuario]') AND (aceita_propostaID = '$_GET[proposta]')";
        $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
        $saida = $sql_query->fetch_assoc();
        $total = $sql_query->num_rows;


/*        echo "DEBUG: printa campos da tabela que retornaram como resultado do SELECT ao banco de dados:<br><br>";
        echo $total."<= <br>";
        echo $saida["aceita_id"]." <= <br>";
        echo $saida["aceita_userID"]." <= <br>";
        echo $saida["aceita_propostaID"]." <= <br>";
        echo $saida["aceita_dataaceite"]." <= <br>";
        echo $saida["aceita_dataprazo"]." <= <br>";
*/
        if ($total > 0){
            $erro[] = "Você já aceitou este projeto.";
            
            echo @$erro[0];

        }

        else if ($total == 0){
            echo "<script> alert('Estamos registrando seu aceite... Clique OK para continuar');</script>";


        // Registro do aceite na tabela tb_aceita do banco de dados.

            // Inserção no Banco e Redirecionamento

            foreach ($_GET as $chave => $valor) {
                $dado[$chave] = mysqli_real_escape_string($mysqli,$valor);
            }   # Linha acima se aplica o tratamento da variável para prevenção contra SQL injection - usar a função real_escape_string();

            $usuario = $dado['usuario'];
            $proposta = $dado['proposta'];

            # Cria um registro de aceite na tabela tb_aceita referenciando a proposta e o usuário que aceitou.

            $sql_code = "INSERT INTO tb_aceita (
            aceita_userID,
            aceita_propostaID,
            aceita_dataaceite) 
            VALUES (
            '$usuario',
            '$proposta',
            NOW()
            )";

            $insere = $mysqli->query($sql_code) or die($mysqli->error);

            if ($insere){
                
                //echo "Aceito com sucesso!";


                // se o registro de aceite foi inserido com sucesso, agora é necessário mudar o status do projeto

                // Consulta se o status desta proposta já é DESENVOLVIMENTO. Caso não seja, atualiza o registro da proposta e muda seu status de ABERTO para DESENVOLVIMENTO
                $sql_code2 = "SELECT * FROM tb_proposta WHERE proposta_id = $_GET[proposta]";
                $sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
                $saida2 = $sql_query2->fetch_assoc();

                // Se o status do projeto for diferente de DESENVOLVIMENTO, então atualiza o registro
                if (@$saida2['proposta_status'] != "DESENVOLVIMENTO"){

                    if (isset($_POST['aceita_dataprazo'])) {
                        $prazo = $_POST['aceita_dataprazo'];
                    

                        $sql_code3 = "UPDATE tb_proposta SET proposta_status = 'DESENVOLVIMENTO', proposta_dataaceite = NOW(), proposta_dataprazo = '$prazo' WHERE proposta_id = '$proposta'";
                        $insere3 = $mysqli->query($sql_code3) or die($mysqli->error);
                    
                        if (@$insere3){
                            echo "<script>alert('Status do projeto atualizado com sucesso!')</script>";
                            header("location: resultadoaceite.php?r=pass");
                        }
                        else{
                            echo "<script>alert('Falha ao atualizar o status do projeto para DESENVOLVIMENTO!')</script>";
                            header("location: resultadoaceite.php?r=error");
                        }                    
                    }
                }
                else{
                    echo "<script>alert('Status do projeto atualizado com sucesso!')</script>";
                    header("location: resultadoaceite.php?r=pass");
                }
            } 
            else {
                    echo "<script>alert('Ocorreu um erro, tente aceitar novamente!')</script>";
                    header("location: resultadoaceite.php?r=error");
                // se o registro NÃO for inserido no banco com sucesso, redireciona para a página de erro
                //header("Location: finalizado.php?r=error");
                //echo "<script> location.href='finalizado.php?r=error'; </script>";
                }
        } 
    }

}

else{
    echo "<script>alert('Acesso proibido! Clique em OK para voltar!'); location.href='index.php?p=listaProposta';</script>";
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


    </head>
    <body>

<?php
    include("footer.php");      
?>