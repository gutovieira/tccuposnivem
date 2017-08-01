<?php 

	include("./class/db_connect.php");

 ?>

<!-- Header -->
<header id="top-home" class="header">
    <div class="text-vertical-center carousel-caption">
        <h1>SOCIVERSIDADE</strong></h1>
        <h3>A plataforma perfeita para colaboração entre alunos, professores e <br>instituições em projetos sociais!</h3>
        <br>
        <a href="#about" class="btn btn-dark btn-lg">Saiba mais</a>
    </div>
</header>


 <!-- About -->
<section id="about" class="about" style="width: 100%; height: 85%;">
    <div class="container" style="height: 85%;">
        <div class="row" style="position: relative; margin-top: 18%; margin-bottom: 25%">
            <div class="col-lg-12 text-vertical-center">
                <hr class="small" align="center"><br><br>
                <h2 class="text-primary" <strong>SOCIVERSIDADE</strong> é a plataforma perfeita para colaboração em projetos sociais!</h2>
                <p class="lead" >Nossa plataforma é o lugar certo para unir as mais nobres <strong class="bg-info">entidades</strong> do terceiro setor aos mais talentosos <strong class="bg-warning">alunos</strong> e <strong class="bg-success">professores</strong> de nossa Universidade, num esforço em conjunto para desenvolverem as mais brilhantes propostas de projetos sociais com as mais modernas e atualizadas tecnologias. 
                <br><br><a href="#services" class="btn btn-dark btn-lg">Saiba mais</a>.
                </p>
                <br><br>
                <hr class="small" align="center">
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<!-- Services -->
<!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
<section id="services" class="services bg-primary" style="width: 100%; height: 100%;>
    <div class="container">
        <div class="row text-center" style="position: relative; margin-top: 9%; margin-bottom: 50%">
            <div class="col-lg-10 col-lg-offset-1">
                <h1>Se você é...</h1>
                <hr class="small">
                <br>

                <div class="row">
                    <div class="col-md-4 col-sm-8">
                        <div class="service-item">
                            <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-cloud fa-stack-1x text-primary"></i>
                        </span>
                            <h4>
                                <strong>uma Entidade</strong><br><br>
                            </h4>
                            <p class="lead">e tem uma proposta de projeto que gostaria que fosse desenvolvida por alunos da UNIVEM</p><br>
                            <a href="index.php?p=listaProposta" class="btn btn-info">clique aqui para publicá-la</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-8">
                        <div class="service-item">
                            <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-compass fa-stack-1x text-primary"></i>
                        </span>
                            <h4>
                                <strong>um Aluno</strong><br><br>
                            </h4>
                            <p class="lead">e gostaria de desenvolver uma dos projetos publicados pelas instituições do terceiro setor parceiras da UNIVEM</p><br>
                            <a href="index.php?p=listaProposta" class="btn btn-warning">clique aqui para participar</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-8">
                        <div class="service-item">
                            <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-flask fa-stack-1x text-primary"></i>
                        </span>
                            <h4>
                                <strong>um Professor</strong><br><br>
                            </h4>
                            <p class="lead">e deseja orientar o desenvolvimento de projetos publicados pelas entidades do terceiro setor.</p><br>
                            <a href="index.php?p=listaProposta" class="btn btn-success">clique aqui e saiba mais</a>
                        </div>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.col-lg-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>