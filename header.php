<?php

    include("./class/db_connect.php");

    if(!isset($_SESSION)){

        ob_start();

        session_start();

        ob_end_clean();

    }



    if ((@$_SESSION['status_login']) == 'logado'){



        if (($_SESSION['us_tipo']) == 'Aluno'){

            $sql_code = "SELECT * FROM tb_aluno WHERE aluno_userID = $_SESSION[us_usuario]";

            $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

            $saida = $sql_query->fetch_assoc();



            $usuario_nome = $saida["aluno_nome"];

            $usuario_end =  $saida["aluno_endereco"];

            $usuario_curso =  "Aluno do curso: <strong>".$saida["aluno_curso"];

            $usuario_email =  @$_SESSION['us_email'];



        

        }

        else if (($_SESSION['us_tipo']) == 'Professor'){

            $sql_code = "SELECT * FROM tb_professor WHERE professor_userID = $_SESSION[us_usuario]";

            $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

            $saida = $sql_query->fetch_assoc();



            $usuario_nome = $saida["professor_nome"];

            $usuario_end =  $saida["professor_endereco"];

            $usuario_curso =  "Professor no curso: <strong>".$saida["professor_curso"];

            $usuario_email =  @$_SESSION['us_email'];





        }

        else if (($_SESSION['us_tipo']) == 'Entidade'){

            $sql_code = "SELECT * FROM tb_entidade WHERE entidade_userID = $_SESSION[us_usuario]";

            $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

            $saida = $sql_query->fetch_assoc();



            $usuario_nome = $saida["entidade_responsavel"];

            $usuario_end = $saida["entidade_endereco"];

            $usuario_curso = "Responsável pela entidade <strong>".$saida["entidade_nome"];

            $usuario_email =  @$_SESSION['us_email'];





        }

    }

?>







<section id="top" class="text-info "">

    <div class="container">

        <div class="">

            <div class="col-lg-4 valign-topo">

                <br>

                <h2><span class="glyphicon glyphicon-fire"></span><strong> || SOCIVERSIDADE</strong></h2>

                <br>

            </div>

            <div class="col-lg-8" align="right">

                <br><p class="text-info">

                <address>

                <?php 

                    if (@$_SESSION['status_login'] == 'logado'){

                        echo "Olá <strong>".@$usuario_nome."</strong>! <span class='glyphicon glyphicon-user'></span><br> ";

                        echo " ".$usuario_curso."</strong> <span class='glyphicon glyphicon-book small'></span><br>";

                        echo " ".$usuario_end." <span class='glyphicon glyphicon-envelope '></span><br> ";

                        echo " <strong>".$usuario_email." <span class='glyphicon glyphicon-envelope '></span></strong><br> ";

                    }

                ?>

                </address>

                </p>

            </div>

        </div>

    </div>

</section>













<section id="header">



    <!-- Navigation -->

    <nav class="navbar navbar-inverse navbar-top" role="navigation" style="margin-bottom: 0px">

        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="http://poswebmovel.compsi.univem.edu.br/" target="_blank"> <strong> Pós-Graduação UNIVEM</strong></a>



                

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">

                    <li>

                        <a href="index.php?p=home"><small><span class="glyphicon glyphicon-home"></span></small> Início</a>

                    </li>

                    <li>

                        <a href="index.php?p=home#about">Quem somos</a>

                    </li>

                    <li>

                        <a href="index.php?p=home#contato">Contato</a>

                    </li>

                   <li>

                        <a href=""> </a>

                    </li>

                   <li>

                        <a href=""> </a>

                    </li>

                    <li>

                        <a href="index.php?p=home#services">Alunos | Professores | Entidades</a>

                    </li>



                    <?php



                        if ((@$_SESSION['status_login'] == 'logado') && (@$_SESSION['us_tipo'] == 'Entidade')){

                            echo "                    

                                <li>

                                    <a href='proposta.php'>Publicar Proposta</a>

                                </li>

                            ";

                        }



                        if (@$_SESSION['status_login'] == 'logado'){

                            echo "

                                <li>

                                    <a href='index.php?p=listaProposta'>Ver Propostas</a>

                                </li>

                            ";

                        }

                    ?>



                    <li>

                        <a href=""> </a>

                    </li>

                   <li>

                        <a href=""> </a>

                    </li>



                    <?php



                            if ((@$_SESSION['status_login'])=='logado'){

                                echo "

                                    <li>

                                        <a href='logout.php?sair=out'>Sair <span class='glyphicon glyphicon-log-out'></span></a>

                                    </li>

                                ";

                            }

                            else{

                                echo "

                                    <li> 

                                        <a href='login.php'> Entrar</a>

                                    </li>

                                    <li> 

                                        <a href='registrar.php'> Registrar-se</a>

                                    </li>

                                ";   

                            }



                    ?>



                 </ul>

            </div>

            <!-- /.navbar-collapse -->

        </div>

        <!-- /.container -->

    </nav>







</section>


<!-- Final do section header -->
