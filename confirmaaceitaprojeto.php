
<?php

include("./class/db_connect.php");

ob_start();
if(!isset($_SESSION))
    session_start();
ob_end_clean();


if (((@$_SESSION['status_login']) == 'logado') && ((@$_SESSION['us_tipo']) == 'Aluno')){
    //echo "<br>".$_SESSION['us_tipo'];


    if ((!isset($_GET['usuario'])) || (!isset($_GET['proposta']))){
        echo "<script>alert('Código Inválido!');</script>"; 
       
        //header("Location: index.php?p=listaProposta");

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

        if ($total >= 1){
            $erro[] = "Você já aceitou este projeto.<br>";
            
            //echo @$erro[0];
            //echo "<a href='' onclick='javascript:history.go(-1)'>Voltar</a>";

        //}

            foreach ($_GET as $chave => $valor) {
                $dado[$chave] = mysqli_real_escape_string($mysqli,$valor);
            }   # Linha acima se aplica o tratamento da variável para prevenção contra SQL injection - usar a função real_escape_string();

            $usuario = $dado['usuario'];
            $proposta = $dado['proposta'];

            // Consulta a tabela tb_proposta e retorna somente o registro desta proposta em questão
            $sql_code2 = "SELECT * FROM tb_proposta WHERE proposta_id = '$proposta'";
            $sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
            $saida2 = $sql_query2->fetch_assoc();
            $total2 = $sql_query2->num_rows;

            // DEBUG: echo $saida2['proposta_id'];

            // Formata a data de cadastro para ser exibida no formato dd/mm/yyyy
            $d = explode(" ", $saida2['proposta_datacadastro']);    # a função explode divide o registro em 2 variáveis, o ponto de quebra é o espaço, definido por " ". No exemplo, se fosse o registro $linha['datadecadastro'] fosse 2017-06-17 12:12:00, ele criaria $d[0] = "2017-06-17" e o $d[1] = "12:12:00"
            $data = explode("-", $d[0]);    # mesma lógica da linha acima, porém agora vai usar o delimitador "-" para dividir o registro em registros de array separados, nesse exemplo da data 2017-06-17 ficariam $data[0] = 2017, $data[1] = 06 e $data[3] = 17.
            $proposta_datacadastro_formatada = "$data[2]/$data[1]/$data[0] às $d[1]"; 
            

            $d2 = explode(" ", $saida2['proposta_dataaceite']);
            $data2 = explode("-", $d2[0]);
            $proposta_dataaceite = "$data2[2]/$data2[1]/$data2[0]";

            $d3 = explode(" ", $saida2['proposta_dataprazo']);
            $data3 = explode("-", $d3[0]);
            $proposta_dataprazo = "$data3[2]/$data3[1]/$data3[0]";

            $proposta_status = $saida2['proposta_status'];


            //Consulta a tabela tb_entidade e retorna a entidade que publicou esta proposta, para ser exibida na tela de confirmação de aceitação
            $sql_code3 = "SELECT * FROM tb_entidade WHERE entidade_userID = '$saida2[proposta_entidadeUserID]'";
            $sql_query3 = $mysqli->query($sql_code3) or die ($mysqli->error);
            $saida3 = $sql_query3->fetch_assoc();
            $total3 = $sql_query3->num_rows;

            // DEBUG: echo $saida3['entidade_nome'];    
            

        }
        else if ($total == 0){
            

        // Confirmação de aceitação.

            // Obtém os parâmetros passados via GET e armazena em variáveis locais

            foreach ($_GET as $chave => $valor) {
                $dado[$chave] = mysqli_real_escape_string($mysqli,$valor);
            }   # Linha acima se aplica o tratamento da variável para prevenção contra SQL injection - usar a função real_escape_string();

            $usuario = $dado['usuario'];
            $proposta = $dado['proposta'];

            // Consulta a tabela tb_proposta e retorna somente o registro desta proposta em questão
            $sql_code2 = "SELECT * FROM tb_proposta WHERE proposta_id = '$proposta'";
            $sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
            $saida2 = $sql_query2->fetch_assoc();
            $total2 = $sql_query2->num_rows;

            // DEBUG: echo $saida2['proposta_id'];

            // Formata a data de cadastro para ser exibida no formato dd/mm/yyyy
            $d = explode(" ", $saida2['proposta_datacadastro']);    # a função explode divide o registro em 2 variáveis, o ponto de quebra é o espaço, definido por " ". No exemplo, se fosse o registro $linha['datadecadastro'] fosse 2017-06-17 12:12:00, ele criaria $d[0] = "2017-06-17" e o $d[1] = "12:12:00"
            $data = explode("-", $d[0]);    # mesma lógica da linha acima, porém agora vai usar o delimitador "-" para dividir o registro em registros de array separados, nesse exemplo da data 2017-06-17 ficariam $data[0] = 2017, $data[1] = 06 e $data[3] = 17.
            $proposta_datacadastro_formatada = "$data[2]/$data[1]/$data[0] às $d[1]"; 


            $d2 = explode(" ", $saida2['proposta_dataaceite']);
            $data2 = explode("-", $d2[0]);
            $proposta_dataaceite = "$data2[2]/$data2[1]/$data2[0]";

            $d3 = explode(" ", $saida2['proposta_dataprazo']);
            $data3 = explode("-", $d3[0]);
            $proposta_dataprazo = "$data3[2]/$data3[1]/$data3[0]";

            $proposta_status = $saida2['proposta_status'];
            
            //Consulta a tabela tb_entidade e retorna a entidade que publicou esta proposta, para ser exibida na tela de confirmação de aceitação
            $sql_code3 = "SELECT * FROM tb_entidade WHERE entidade_userID = '$saida2[proposta_entidadeUserID]'";
            $sql_query3 = $mysqli->query($sql_code3) or die ($mysqli->error);
            $saida3 = $sql_query3->fetch_assoc();
            $total3 = $sql_query3->num_rows;

            // DEBUG: echo $saida3['entidade_nome'];    
            
        } 
    }

}

else{
    echo "<script>alert('Para acessar esta página você precisa estar logado como aluno ou professor. Clique em OK para voltar!'); location.href='login.php';</script>";
    //header("Location: index.php");
}


?>



<!doctype html>
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


<section id="listaProposta" class="about">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">
                
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
            
                <form class="form-group">

                    <div class="col-lg-12">
                    <!-- lista projeto selecionado para aceitar desenvolver -->                
                        <p><h2 class="text-info" ><?php echo @$saida2['proposta_titulo']; ?></h2></p>
                        <p><h4 class="text-muted">
                            Publicado por <i class="text-primary"><?php echo @$saida3['entidade_nome']; ?></i>
                        </h4></p>
                        <p class="text-muted"><span class="glyphicon glyphicon-time text-muted"></span> postado em <?php echo @$proposta_datacadastro_formatada; ?></p>
                        <hr>
                        <p class="text-justify text-info well"><?php echo nl2br(@$saida2['proposta_resumo']); ?></p>
                        
                    </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-12 text-center">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8  text-center">
                    <?php
                        if ($total == 0){

                        
                            if ((@$proposta_status == "ABERTO") && (@$proposta_dataprazo == "00/00/0000")){

                                echo "<p class='lead text-muted'>Escolha uma data como prazo de conclusão do projeto. Quando este prazo expirar, a entidade poderá encerrar o projeto e publicar um feedback sobre o seu trabalho.</p>";

                                echo "<input type='date' required class='form-group bg-warning' name='aceita_dataprazo'><br>";
                            }
                            else{
                                echo "<p class='lead text-muted'>Este projeto já está sendo desenvolvido por outro(s) aluno(s).<br>
                                O prazo para conclusão deste projeto é <strong>".@$proposta_dataprazo."</strong>!</p>
                                
                                <p class='lead text-muted'>Você pode fazer parte do grupo de desenvolvimento ao clicar em aceitar!</p>
                                ";
                            }
                                echo "
                                    <br>
                                </div>
                                <div class='col-lg-2'>
                                </div>
                                <div class='col-lg-12'>
                                    <button class='form-group btn btn-success btn-md' type='submit' formmethod='post' formaction='finalizaraceitaprojeto.php?usuario=".$usuario."&proposta=".$proposta."'>Eu aceito desenvolver este projeto! <i class='glyphicon glyphicon-ok'></i></button>
                                    
                                    <a class='form-group btn btn-warning btn-md' href='' onclick='javascript:history.go(-1)'>Não tenho interesse no momento! <span class='glyphicon glyphicon-ban-circle'></span></a>

                                ";

                        } else if ($total >= 1){
                            echo "<p class='lead text-warning'><strong>Você já é um participante neste projeto!</strong></p>
                            <a class='form-group btn btn-warning btn-md' href='' onclick='javascript:history.go(-1)'>Voltar para a lista de projetos! <span class='caret'></span></a>

                            ";
                        }
                    ?>
                    <br>
                </div>

                </form>   
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
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/docs.min.js"></script>

<?php 

    include("footer.php");

 ?>
    
</body>
</html>