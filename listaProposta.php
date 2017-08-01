<?php

ob_start();
if(!isset($_SESSION))
    session_start();
ob_end_clean();


if ((@$_SESSION['status_login']) == 'logado'){
    //echo "<br>".$_SESSION['us_tipo'];


    if ($_SESSION['us_tipo'] == "Aluno"){

        // Consulta todos os registros da tabela tb_proposta
        $sql_code = "SELECT * FROM tb_proposta ORDER BY proposta_datacadastro DESC";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $saida = $sql_query->fetch_assoc();
        $totalpropostas = $sql_query->num_rows;

        // Consulta a tabela tb_aluno e retorna todos os dados do aluno que está logado
        $sql_code2 = "SELECT * FROM tb_aluno WHERE aluno_userID = $_SESSION[us_usuario]";
        $sql_query2 = $mysqli->query($sql_code2) or die($mysqli->error);
        $saida2 = $sql_query2->fetch_assoc();
        $codigousuario = $saida2["aluno_userID"];

        $sql_code3 = "SELECT * FROM tb_entidade WHERE entidade_userID = $saida[proposta_entidadeUserID]";
        $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
        $saida3 = $sql_query3->fetch_assoc();

        $dado = explode(" ", $saida2['aluno_nome']);    # a função explode divide o registro em 2 variáveis, o ponto de quebra é o espaço, definido por " ". 
        $usuario_logado_nome = $dado[0];    # variável recebe o primeiro nome, obtido da quebra na função da linha anterior.


//        $msg_num_propostas = "<span class='glyphicon glyphicon-list-al'></span> $saida2['aluno_nome'], existem <i>".$totalpropostas." propostas</i> publicadas e disponíveis para você no momento.";

/* DEBUG - printa na tela o retorno das query
        do {
            echo "<br>".$saida['proposta_titulo'];
        } while ($saida = $sql_query->fetch_assoc());

        echo "<br>".$_SESSION['us_datacadastro'];
*/
    } 




    else if ($_SESSION['us_tipo'] == "Professor"){

        // Consulta todas os registros da tabela tb_proposta
        $sql_code = "SELECT * FROM tb_proposta ORDER BY proposta_datacadastro DESC";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $saida = $sql_query->fetch_assoc();
        $totalpropostas = $sql_query->num_rows;

        // Consulta a tabela tb_professor e retorna todos os dados do professor que está logado
        $sql_code2 = "SELECT * FROM tb_professor WHERE professor_userID = $_SESSION[us_usuario]";
        $sql_query2 = $mysqli->query($sql_code2) or die($mysqli->error);
        $saida2 = $sql_query2->fetch_assoc();
        $codigousuario = $saida2["professor_userID"];

        $sql_code3 = "SELECT * FROM tb_entidade WHERE entidade_userID = $saida[proposta_entidadeUserID]";
        $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
        $saida3 = $sql_query3->fetch_assoc();

        $dado = explode(" ", $saida2['professor_nome']);    # a função explode divide o registro em 2 variáveis, o ponto de quebra é o espaço, definido por " ". 
        $usuario_logado_nome = $dado[0];    # variável recebe o primeiro nome, obtido da quebra na função da linha anterior.

//        $msg_num_propostas = "<span class='glyphicon glyphicon-list-al'></span> $saida2['professor_nome'], existem <i>".$totalpropostas." propostas</i> publicadas e disponíveis para você no momento.";

/* DEBUG - printa na tela o retorno das query
        do {
            echo "<br>".$saida['proposta_titulo'];
        } while ($saida = $sql_query->fetch_assoc());

        echo "<br>".$_SESSION['us_datacadastro'];
*/
    }


    else if ($_SESSION['us_tipo'] == "Entidade"){

        // Consulta todas os registros da tabela tb_proposta que pertençam a entidade logada
        $sql_code = "SELECT * FROM tb_proposta WHERE proposta_entidadeUserID = $_SESSION[us_usuario] ORDER BY proposta_datacadastro DESC";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $saida = $sql_query->fetch_assoc();
        $totalpropostas = $sql_query->num_rows;
        
            $sql_code3 = "SELECT * FROM tb_entidade WHERE entidade_userID = $_SESSION[us_usuario]";
            $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
            $saida3 = $sql_query3->fetch_assoc();

            $codigousuario = $saida3["entidade_userID"];


            $dado = explode(" ", $saida3['entidade_responsavel']);    # a função explode divide o registro em 2 variáveis, o ponto de quebra é o espaço, definido por " ". 
            $usuario_logado_nome = $dado[0];    # variável recebe o primeiro nome, obtido da quebra na função da linha anterior.
            $entidade_logado_nome = $saida3['entidade_nome'];


/* DEBUG - printa na tela o retorno das query
        do {
            echo "<br>".$saida['proposta_titulo'];
        } while ($saida = $sql_query->fetch_assoc());

        echo "<br>".$_SESSION['us_datacadastro'];
*/
    }
}


else{
    echo "<script>alert('Para acessar esta página você precisa estar logado. Clique em OK e você será redirecionado a página de login!'); </script>";
    header("Location: login.php");

    //location.href='login.php';</script>";
}


?>


<!-- Início do Front-End HTML da página listaProposta -->

<section id="listaProposta" class="about">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">
                <p class="lead"><h3 class="text-primary"><small><span class="glyphicon glyphicon-tag"></span></small> Lista completa de propostas de projeto publicadas e disponíveis para desenvolvimento.</h3></p>
                <hr>
                
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-md-12">
            

            <?php
                if ($_SESSION['us_tipo'] == "Entidade"){

                    if ($totalpropostas == '0'){
                        $proposta_plural = "proposta";
                        $publicada_plural = "publicada";

                        echo "<br><br><br><br><p class='lead text-center text-info bg-info'><small> <strong><i>$usuario_logado_nome</i></strong>, a entidade <strong><i>$entidade_logado_nome</i></strong> ainda não possui nenhuma <i>$proposta_plural de projeto</i> $publicada_plural! <br><a href='proposta.php'><strong>Publique sua primeira proposta agora!</br></a></small></p>";
                    }
                    if ($totalpropostas == '1') {
                        $proposta_plural = "proposta";
                        $publicada_plural = "publicada";
                        
                        echo "<p class='lead text-center text-info bg-info'><small> <strong><i>$usuario_logado_nome</i></strong>, a entidade <strong><i>$entidade_logado_nome</i></strong> possui um total de <strong><i>$totalpropostas $proposta_plural de projeto</i></strong> $publicada_plural!</small></p>";

                    }
                    if ($totalpropostas > '1') {
                        $proposta_plural = "propostas";
                        $publicada_plural = "publicadas";
                        
                        echo "<p class='lead text-center text-info '><small> <strong><i>$usuario_logado_nome</i></strong>, a entidade <strong><i>$entidade_logado_nome</i></strong> possui um total de <strong><i>$totalpropostas $proposta_plural de projeto</i></strong> $publicada_plural!</small></p>";

                    }
                echo "            
        </div>

            <div class='col-md-12 text-center'>
                <hr class='small'>
            </div>

        </div>
                ";
                }
                else {

                    if ($totalpropostas == '1') {
                        $proposta_plural = "proposta";
                        $publicada_plural = "publicada e disponível";
                        $existe_plural = "";
                    }
                    else {
                        $proposta_plural = "propostas"; 
                        $publicada_plural = "publicadas e disponíveis";
                        $existe_plural = "m";
                    }

                    echo "<p class='lead text-center text-info'><small> <strong><i>$usuario_logado_nome</i></strong>, existe$existe_plural <i>$totalpropostas $proposta_plural</i> $publicada_plural!</small></p>
            </div>

            <div class='col-md-12 text-center'>
                <hr class='small'>
            </div>

        </div>
                    ";
                }


                if ($totalpropostas >= '1'){


                do{


                // Formata a data de publicação da proposta num formato do Brasil

                $d = explode(" ", $saida['proposta_datacadastro']);    # a função explode divide o registro em 2 variáveis, o ponto de quebra é o espaço, definido por " ". No exemplo, se fosse o registro $linha['datadecadastro'] fosse 2017-06-17 12:12:00, ele criaria $d[0] = "2017-06-17" e o $d[1] = "12:12:00"
                $data = explode("-", $d[0]);    # mesma lógica da linha acima, porém agora vai usar o delimitador "-" para dividir o registro em registros de array separados, nesse exemplo da data 2017-06-17 ficariam $data[0] = 2017, $data[1] = 06 e $data[3] = 17.
                $data_formatada = "$data[2]/$data[1]/$data[0] às $d[1]"; 
                

                $proposta_id = $saida['proposta_id'];

               // Consulta a tabela e retorna todos os registros da tabela tb_aceita onde o ID seja proposta_id da vez nesse loop
                $sql_code4 = "SELECT * FROM tb_aceita WHERE aceita_propostaID = $saida[proposta_id]";
                $sql_query4 = $mysqli->query($sql_code4) or die($mysqli->error);
                $saida4 = $sql_query4->fetch_assoc();
                $totalsaida4 = $sql_query4->num_rows;


                // Formata a data de inicio do desenvolvimento do projeto
                $d3 = explode(" ", $saida['proposta_dataaceite']);
                $dataaceite = explode("-", $d3[0]);
                @$dataaceite_formatada = "$dataaceite[2]/$dataaceite[1]/$dataaceite[0]"; 


                // Formata a data de prazo para conclusão da proposta
                $d2 = explode(" ", $saida['proposta_dataprazo']);
                $dataprazo = explode("-", $d2[0]);
                @$dataprazo_formatada = "$dataprazo[2]/$dataprazo[1]/$dataprazo[0]"; 

                // Formata a data de conclusão do projeto
                $d4 = explode(" ", $saida['proposta_dataconclusao']);
                $dataconclusao = explode("-", $d4[0]);
                @$dataconclusao = "$dataconclusao[2]/$dataconclusao[1]/$dataconclusao[0]"; 

                //echo $saida4['proposta_dataprazo'];

                //echo $totalsaida4;

/* DEBUG print
                echo @$saida4['aceita_userID']."<br>";
                echo @$saida5['aluno_nome']."<br>";
                echo @$saida6['professor_nome']."<br>";
*/                
            ?>

            
                <!-- propostas listadas -->
        <div class="row">

            <div class="col-md-12"> 

                <p><h2 class="text-info" ><?php echo $saida['proposta_titulo']; ?></h2></p>
                <hr>
            </div>
            <div class="col-md-8">
                <div class="col-md-12 well">
                    <p class="text-justify text-info"><?php echo nl2br($saida['proposta_resumo']); ?></p>
                </div>
            <div class="row col-md-12 text-center">
            
                <?php


                    if (($_SESSION['us_tipo'] == "Aluno")){

                        if ($saida['proposta_status'] == "ABERTO"){

                            echo "
                                <a class='btn btn-success btn-md' href='confirmaaceitaprojeto.php?usuario=".$codigousuario."&proposta=".$proposta_id."'><span class='glyphicon glyphicon-ok'></span> VER DETALHES e ACEITAR</a> 
                            ";

                        } else if ($saida['proposta_status'] == "DESENVOLVIMENTO"){
                            
                            $dataatual = date('Y-m-d');

                            //DEBUG: echo $saida['proposta_dataprazo'];
                            //DEBUG: echo $dataatual;
                            
                            if (strtotime($dataatual) > strtotime($saida['proposta_dataprazo'])){

                            }else{

                                echo "
                                    <a class='btn btn-success btn-md' href='confirmaaceitaprojeto.php?usuario=".$codigousuario."&proposta=".$proposta_id."'><span class='glyphicon glyphicon-ok'></span> VER DETALHES e ACEITAR</a> 
                                ";
                            }
                        }

                    }

                    if ($saida['proposta_status'] == "CONCLUIDO"){
                        echo "

            </div>
            <div class='col-md-1'>
            </div>
            <div class='row col-md-10'>
                            <p class='text-warning'><span class='glyphicon glyphicon-comment'></span> Comentário de avaliação do projeto <span class='caret'></span> </p>
                            <hr class='small' align='left'>
                            <p class='text-warning'>'".$saida['proposta_comentario']."'</p>
                            <p class='text-warning'>Publicado por: ".$saida3['entidade_responsavel']." (".$saida3['entidade_nome'].")<br>
                            Data de conclusão: ".$dataconclusao."
            </div>
            <div class='col-md-1'>
            </div>
            ";
                    }else
                        echo "
            
            <br><br>
            </div>";

                ?>



            </div>
            




<!-- Coluna lateral com detalhes da proposta -->
            <div class="col-md-4">
                <div class=" col-md-12 ">
                    <p><h4 class="text-muted">
                        Publicado por <i class="text-primary"><?php echo @$saida3["entidade_nome"]; ?></i>
                    </h4></p>
                    <p class="text-muted"><span class="glyphicon glyphicon-time text-muted"></span> postado em <?php echo @$data_formatada; ?></p>

                    <?php
                        if ($_SESSION['us_tipo'] == "Aluno"){
       
                                $dataatual = date('Y-m-d');

                                //DEBUG: echo $saida['proposta_dataprazo'];
                                //DEBUG: echo $dataatual;
                                
                                if (strtotime($saida['proposta_dataprazo']) > strtotime($dataatual)){

                                    echo "
                                        <a class='' href='confirmaaceitaprojeto.php?usuario=".$codigousuario."&proposta=".$proposta_id."'><span class='glyphicon glyphicon-ok'></span> VER DETALHES e ACEITAR</a> 
                                    ";
                                }else if (($saida['proposta_dataprazo']) == "0000-00-00"){
                                    echo "
                                        <a class='' href='confirmaaceitaprojeto.php?usuario=".$codigousuario."&proposta=".$proposta_id."'><span class='glyphicon glyphicon-ok'></span> VER DETALHES e ACEITAR</a> 
                                    ";
                                }
                            }
                                                   
                    ?>
                 <hr class="small" align="left">
                    
                </div>
                <div class=" col-md-12 ">
                    
                    <?php

                        if ($saida['proposta_status'] == "ABERTO"){
                        echo "
                        <h5 class='text-muted'>
                            <a class='btn btn-success btn-sm'><span class='glyphicon glyphicon-play-circle'></span> STATUS: <strong>'".@$saida['proposta_status']."'</strong> </a>
                        </h5>
                        ";
                        }

                        else if ($saida['proposta_status'] == "DESENVOLVIMENTO"){
                        
                        $dataatual = date('Y-m-d');
                            
                            if (strtotime($dataatual) >= strtotime($saida['proposta_dataprazo'])){

                              echo "
                                <h5 class='text-muted'>
                                    <a class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-exclamation-sign'></span> STATUS: <strong>'PRAZO EXPIRADO'</strong> </a>
                                </h5><br>
                                ";  

                            }
                            else{
                                
                                echo "
                                <h5 class='text-muted'>
                                    <a class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-refresh'></span> STATUS: <strong>'".@$saida['proposta_status']."'</strong> </a>
                                </h5><br>
                                ";

                            }

                        }
                        else if ($saida['proposta_status'] == "CONCLUIDO"){
                        echo "
                        <h5 class='text-muted'>
                            <a class='btn btn-info btn-sm'><span class='glyphicon glyphicon-off'></span> STATUS: <strong>'".@$saida['proposta_status']."'</strong></a>
                        </h5>
                        ";
                        }
                    ?>

                    <?php 

                        if ($saida['proposta_status'] == "ABERTO"){

                        }

                        if ($saida['proposta_status'] == "DESENVOLVIMENTO") {
                            echo "
                                <p class='text-muted'><span class='glyphicon glyphicon-calendar'></span> Data de inicio: <strong>".@$dataaceite_formatada."</strong></p>
                                <p class='text-muted'><span class='glyphicon glyphicon-calendar'></span> Prazo para conclusão: <strong>".@$dataprazo_formatada."</strong></p>
                            "; 

                            $dataatual = date('Y-m-d');
                            
                            if ((strtotime($dataatual) >= strtotime($saida['proposta_dataprazo'])) && ($_SESSION['us_tipo'] == "Entidade") && ($saida['proposta_dataconclusao'] == '0000-00-00')){
                                //echo $dataatual." e ".$saida['proposta_dataprazo'];

                                echo "
                                <form>
                                    <br>
                                    <a href='concluireavaliar.php?usuario=".$codigousuario."&proposta=".$proposta_id."' class='btn btn-warning btn-md'>CONCLUIR PROJETO E AVALIAR!</a>
                                </form>
                                ";

                            }
                            
                        }

                    ?>
                    
                </div>

                
                <!-- Início da div que lista os alunos atualmente desenvolvendo este projeto -->

                <div class=" col-md-12">
                </div>
                <div class=" col-md-12 ">
                 <hr class="small" align="left">
                    <p><strong class="text-primary">Alunos participantes deste projeto:</strong></p>
                 
                    <div class=" col-md-12">
                        <p class="text-muted">

                        <?php
                             do {
                                $sql_code5 = "SELECT * FROM tb_aluno WHERE aluno_userID = '$saida4[aceita_userID]'";
                                $sql_query5 = $mysqli->query($sql_code5) or die($mysqli->error);
                                $saida5 = $sql_query5->fetch_assoc();
                                $totalsaida5 = $sql_query5->num_rows;
                            
                                if ($totalsaida5==1) { 
                                    
                                    if ($_SESSION['us_usuario'] == $saida5['aluno_userID']){
                                        echo "<strong class='text-warning'>".$saida5['aluno_nome']."</strong> <strong class='text-warning'>(você)</strong><br>"; 
                                    }else{
                                        echo $saida5['aluno_nome']."<br>"; 
                                    }

                                }
                                else { echo "Esta proposta ainda não foi aceita. "; 

                                    if ($_SESSION['us_tipo'] == "Aluno") {
                                        echo "<br>Está interessado? <a href='confirmaaceitaprojeto.php?usuario=".$codigousuario."&proposta=".$proposta_id."'>Saiba Mais!</a>";
                                    }
                                }

                            } while ($saida4 = $sql_query4->fetch_assoc());
                        ?>
                        </p>
                    </div>
                </div>
<!-- Fim da div que lista os alunos atualmente desenvolvendo este projeto -->

            
            </div>
<!-- Fim da coluna lateral com detalhes da proposta -->





            <div class="col-md-12">
                <hr>
                <br>
            </div>

        </div>
        <!-- /.row -->
               
            <?php
                } while ($saida = $sql_query->fetch_assoc());
            }
            ?>

        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<!-- Backup da formatação inicial do post de proposta

                <p><h2 class="text-info" ><?php //echo $saida['proposta_titulo']; ?></h2></p>
                <p><h4 class="text-muted">
                    Publicado por <i class="text-primary"><?php //echo @$saida3["entidade_nome"]; ?></i>
                </h4></p>
                <p class="text-muted"><span class="glyphicon glyphicon-time text-muted"></span> postado em <?php //echo @$data_formatada; ?></p>
                <hr class="small" align="left">
                <p class="text-justify text-info"><?php //echo nl2br($saida['proposta_resumo']); ?></p>
                <br>
                <a class="btn btn-success btn-sm" href="#">Read More <i class="caret"></i></a>
                <hr><br>            
-->


<!--    <div class="row">
            <div class="col-lg-12 text-center">
                <p class="lead"><h4><a href="index.php">Clique aqui para voltar</a> ou <a href="logout.php">clique aqui para sair</a></h4></p>
            </div>
        </div>
-->