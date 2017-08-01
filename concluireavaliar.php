<?php

    include("./class/db_connect.php");

$msg = "";

if (isset($_POST['avaliar'])){


    // Verificar se o usuário clicou no botão submit sem preencher titulo e resumo, e exibe um alerta de erro

    if (strlen(@$_POST['proposta_comentario']) == 0){
        $erro[] = "Digite uma avaliação antes de concluir o projeto!";
        $has_error = "has-error";

    }else{

    // Registro da conclusão nas tabelas tb_aceita e tb_proposta do banco de dados.
       
       // Recuperação dos parâmetros passados via GET e POST, inserção no Banco e Redirecionamento

        $proposta_comentario = $_POST['proposta_comentario'];

        foreach ($_GET as $chave => $valor) {
            $dado[$chave] = mysqli_real_escape_string($mysqli,$valor);
        }   # Linha acima se aplica o tratamento da variável para prevenção contra SQL injection - usar a função real_escape_string();

        $entidade = $dado['usuario'];
        $proposta = $dado['proposta'];

        
        # Registra a conclusão nas tabelas tb_aceita e tb_proposta, altera o status do projeto para CONCLUIDO e adiciona grava o comentário da entidade avaliando o grupo de alunos que desenvolveu o projeto.

        $sql_code = "UPDATE tb_aceita SET aceita_dataconclusao = NOW() WHERE aceita_propostaID = $proposta";
        $concluiaceite = $mysqli->query($sql_code) or die($mysqli->error);

        $sql_code = "UPDATE tb_proposta SET proposta_dataconclusao = NOW(), proposta_status = 'CONCLUIDO', proposta_comentario = '$proposta_comentario'  WHERE proposta_id = $proposta";
        $concluiproposta = $mysqli->query($sql_code) or die($mysqli->error);

        if ((@$concluiaceite)&&(@$concluiproposta)){
            echo "<script>alert('Projeto concluído com sucesso e avaliação devidamente registrada!')</script>";
            header("location: resultadoconcluir.php?r=pass");
        }else{
            echo "<script>alert('Não foi possível registrar a conclusão e avaliação deste projeto, tente novamente!')</script>";
            header("location: resultadoconcluir.php?r=error");
        }




    }
}


ob_start();
if(!isset($_SESSION))
    session_start();
ob_end_clean();


if (((@$_SESSION['status_login']) == 'logado') && ((@$_SESSION['us_tipo']) == 'Entidade')){
    //echo "<br>".$_SESSION['us_tipo'];


    if ((!isset($_GET['usuario'])) || (!isset($_GET['proposta']))){
        echo "<script>alert('Código Inválido!');</script>";
       
        header("Location: index.php?p=listaProposta");

        //location.href='index.php?p=listaProposta';</script>";
    }
    else{


        // consulta a tabela tb_aceita e retorna todos os registros do projeto em questão

        $sql_code = "SELECT * FROM tb_aceita WHERE aceita_propostaID = '$_GET[proposta]'";
        $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
        $saida = $sql_query->fetch_assoc();
        $total = $sql_query->num_rows;

/*DEBUG        echo $total."<br>";
        do {echo "<br>".$saida['aceita_userID'];}
        while ($saida = $sql_query->fetch_assoc());
*/
        $sql_code2 = "SELECT * FROM tb_proposta WHERE proposta_id = '$_GET[proposta]'";
        $sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
        $saida2 = $sql_query2->fetch_assoc();
        $total2 = $sql_query2->num_rows;

        $sql_code3 = "SELECT * FROM tb_entidade WHERE entidade_userID = '$_GET[usuario]'";
        $sql_query3 = $mysqli->query($sql_code3) or die ($mysqli->error);
        $saida3 = $sql_query3->fetch_assoc();
        $total3 = $sql_query3->num_rows;

        if ($total >= 1){

            foreach ($_GET as $chave => $valor) {
                $dado[$chave] = mysqli_real_escape_string($mysqli,$valor);
            }   # Linha acima se aplica o tratamento da variável para prevenção contra SQL injection - usar a função real_escape_string();

            $proposta = $dado['proposta'];
            $entidade = $dado['usuario'];

//DEBUG            echo $proposta;
//DEBUG            echo "<br>".$entidade;
/*
            // Formata a data de cadastro para ser exibida no formato dd/mm/yyyy
            $d = explode(" ", $saida2['proposta_datacadastro']);    # a função explode divide o registro em 2 variáveis, o ponto de quebra é o espaço, definido por " ". No exemplo, se fosse o registro $linha['datadecadastro'] fosse 2017-06-17 12:12:00, ele criaria $d[0] = "2017-06-17" e o $d[1] = "12:12:00"
            $data = explode("-", $d[0]);    # mesma lógica da linha acima, porém agora vai usar o delimitador "-" para dividir o registro em registros de array separados, nesse exemplo da data 2017-06-17 ficariam $data[0] = 2017, $data[1] = 06 e $data[3] = 17.
            $proposta_datacadastro_formatada = "$data[2]/$data[1]/$data[0] às $d[1]"; 
 */           
            $d = explode(" ", $saida2['proposta_datacadastro']);    # a função explode divide o registro em 2 variáveis, o ponto de quebra é o espaço, definido por " ". No exemplo, se fosse o registro $linha['datadecadastro'] fosse 2017-06-17 12:12:00, ele criaria $d[0] = "2017-06-17" e o $d[1] = "12:12:00"
            $data = explode("-", $d[0]);    # mesma lógica da linha acima, porém agora vai usar o delimitador "-" para dividir o registro em registros de array separados, nesse exemplo da data 2017-06-17 ficariam $data[0] = 2017, $data[1] = 06 e $data[3] = 17.
            $proposta_datacadastro_formatada = "$data[2]/$data[1]/$data[0] às $d[1]"; 

            $d3 = explode(" ", $saida2['proposta_dataaceite']);
            $dataaceite = explode("-", $d3[0]);
            @$dataaceite_formatada = "$dataaceite[2]/$dataaceite[1]/$dataaceite[0]"; 

            $d4 = explode(" ", $saida2['proposta_dataprazo']);
            $dataprazo = explode("-", $d4[0]);
            @$dataprazo_formatada = "$dataprazo[2]/$dataprazo[1]/$dataprazo[0]";           

        }
    }

}

else{
    echo "<script>alert('Proibido o acesso. Clique em OK para voltar!'); location.href='index.php?=home';</script>";
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

        <title>Meu TCC</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">



    <!-- Inicio links para o reutilizar as folhas do StartBootstrap-->
        <!-- Custom CSS -->
        <link href="css/tcc1.css" rel="stylesheet">
            <!-- Custom CSS -->
        <link href="css/tcc3.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- Fim do StartBootstrap -->


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
                    </div>
                    <div class="col-lg-3">
                        <p><h4 class="text-muted">
                            Publicado por <i class="text-primary"><?php echo @$saida3['entidade_nome']; ?></i>
                        </h4></p>
                        <p class="text-muted"><span class="glyphicon glyphicon-time text-muted"></span> postado em <?php echo @$proposta_datacadastro_formatada; ?></p>
                    </div>

                    <div class="col-lg-12">
                        <p class="text-justify text-info well"><?php echo nl2br(@$saida2['proposta_resumo']); ?></p>
                    </div>
            </div>
        </div>
        <div class="col-lg-12">

            <div class="col-lg-6">
                <p><strong class="text-primary">Alunos participantes deste projeto:</strong></p>
                <?php
        
                    $sql_code = "SELECT * FROM tb_aceita WHERE aceita_propostaID = '$_GET[proposta]'";
                    $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
                    $saida = $sql_query->fetch_assoc();
                    $total = $sql_query->num_rows;

            /*DEBUG        do {echo "<br>".$saida['aceita_userID'];}
                    while ($saida = $sql_query->fetch_assoc());
            */
                    do {
                        $sql_code5 = "SELECT * FROM tb_aluno WHERE aluno_userID = '$saida[aceita_userID]'";
                        $sql_query5 = $mysqli->query($sql_code5) or die($mysqli->error);
                        $saida5 = $sql_query5->fetch_assoc();
                        $totalsaida5 = $sql_query5->num_rows;
                    
                        if ($totalsaida5==1) { 
                                echo $saida5['aluno_nome']."<br>"; 
                            }

                    } while ($saida = $sql_query->fetch_assoc());

                ?>
            </div>

            <div class="col-lg-6" align="right">
                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Data de inicio: <strong><?php echo @$dataaceite_formatada; ?></strong></p>
                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Prazo para conclusão: <strong><?php echo @$dataprazo_formatada; ?></strong></p>
            </div>


            <div class="col-lg-12 text-center">
                <div class="row col-lg-12">
                    <hr>
                    <p class="lead text-info"><strong>Para concluir o projeto, digite uma breve avaliação sobre o<br>desenvolvimento do projeto e o desempenho do grupo.</strong></p>
                </div>
            <div class="col-lg-12">
                <div class="col-lg-2">
                </div>
                <div class="row col-lg-8 <?php echo @$has_error; ?>">
                    <form class="form-group form-group-control">

                    <?php
                        if(count(@$erro) > 0){
                            foreach ($erro as $msg){
                            echo "
                                <h4 class='text-danger'>".$msg."</h4>
                                <br>";
                            }
                        }
                    ?>

                        <textarea class="form-control" rows="3" name="proposta_comentario" placeholder=''></textarea>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-2">
                </div>
                <div class="row col-lg-8">
                        <br><button type="submit" formmethod="post" class="btn btn-success btn-md" name="avaliar"><span class='glyphicon glyphicon-ok'></span> CONFIRMAR AVALIAÇÃO E CONCLUIR PROJETO!</button>
                        <a class='form-group btn btn-warning btn-md' href='' onclick='javascript:history.go(-1)'> <span class='glyphicon glyphicon-ban-circle'></span> Voltar para a lista de projetos! </a>
                    </form>
                </div>
                <div class="col-lg-2">
                </div>
   
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
</body>
</html>

<?php 

    include("footer.php");

 ?>
