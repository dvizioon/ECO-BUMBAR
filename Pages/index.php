<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Bumbar</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>

    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./Assets/Logo.png" style="width:50%;" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Evento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Suporte</a>
                    </li>
                    <!-- Dropdown de login -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="position:relative;" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login Eco Bumbar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="width: 300px;position:absolute;left:-50%;">
                            <!-- Formulário de login -->
                            <li>
                                <form id="loginForm" class="dropdown-item px-4 py-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" id="emailLogin" name="email" placeholder="daniel@example.com">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" name="pass" id="passwordLogin">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="background-color: #34d399;"><i class="fas fa-sign-in-alt"></i> Entrar</button>
                                </form>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li style="text-align: center;cursor:pointer;">
                                <a class="icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" data-bs-toggle="modal" data-bs-target="#cadastroModal">
                                    Cadastro
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Fim do dropdown de login -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container text-center">
            <h1 class="display-1">Eco Bumbar Precisa de Você Por quê ?</h1>
            <p class="lead">Role para baixo e veja porque essa iniciativa precisa de você</p>
        </div>
    </section>
    <!-- https://via.placeholder.com/800x400 -->

    <!-- Carousel Section -->
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <section class="section m-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="./Assets/Logo.png" class="img-fluid" alt="Eco Bumbar">
                </div>
                <div class="col-md-6">
                    <h2 class="mb-4">A História do Eco Bumbar</h2>
                    <p>O Eco Bumbar foi fundado em 2010 por um grupo de entusiastas ambientais com o objetivo de
                        promover
                        práticas sustentáveis e a preservação do meio ambiente.o projeto cresceu ao longo dos anos e
                        expandiu suas atividades
                        para
                        incluir iniciativas de reflorestamento, educação ambiental e desenvolvimento sustentável em
                        comunidades locais.</p>
                    <p>Com o compromisso de criar um impacto positivo no planeta, o Eco Bumbar continua a trabalhar
                        arduamente para inspirar e capacitar indivíduos e comunidades a adotar um estilo de vida mais
                        sustentável e consciente.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Content Section -->
    <section class="section m-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-content">
                        <h2>Proteja Nosso Planeta</h2>
                        <p>Aprenda sobre práticas sustentáveis e como você pode contribuir para a preservação dos
                            ecossistemas do nosso planeta.</p>
                        <a href="#" class="btn btn-primary">Saiba Mais</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-content">
                        <h2>Junte-se a Eventos Empolgantes</h2>
                        <p>Participe de eventos e workshops ecológicos focados na conscientização ambiental e esforços
                            de
                            conservação.</p>
                        <a href="#" class="btn btn-success">Junte-se Agora</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section m-5">
        <div class="container">
            <h2 class="text-center mb-4">Programação do Evento</h2>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="local-tab" data-bs-toggle="tab" data-bs-target="#local" type="button" role="tab" aria-controls="local" aria-selected="true"><i class="fas fa-map-marker-alt"></i> Local</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="programacao-tab" data-bs-toggle="tab" data-bs-target="#programacao" type="button" role="tab" aria-controls="programacao" aria-selected="false"><i class="fas fa-calendar-alt"></i> Programação</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="horario-tab" data-bs-toggle="tab" data-bs-target="#horario" type="button" role="tab" aria-controls="horario" aria-selected="false"><i class="fas fa-clock"></i>
                        Horário</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="informacoes-tab" data-bs-toggle="tab" data-bs-target="#informacoes" type="button" role="tab" aria-controls="informacoes" aria-selected="false"><i class="fas fa-info-circle"></i> Informações Adicionais</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="local" role="tabpanel" aria-labelledby="local-tab">
                    <h3>Local do Evento</h3>
                    <p>O evento acontecerá Remotamente Fique atento as Datas.</p>
                </div>
                <div class="tab-pane fade" id="programacao" role="tabpanel" aria-labelledby="programacao-tab">
                    <h3>Programação do Evento</h3>
                    <ul>
                        <li>9:00 - Abertura</li>
                        <li>10:00 - Palestra sobre Sustentabilidade</li>
                        <li>12:00 - Intervalo para Almoço</li>
                        <li>14:00 - Oficinas de Reciclagem</li>
                        <li>16:00 - Encerramento</li>
                        <li>18:00 - Coquetel de Networking</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="horario" role="tabpanel" aria-labelledby="horario-tab">
                    <h3>Horário do Evento</h3>
                    <p>O evento ocorrerá no dia 15 de março de 2024, das 9:00 às 18:00.</p>
                </div>
                <div class="tab-pane fade" id="informacoes" role="tabpanel" aria-labelledby="informacoes-tab">
                    <h3>Informações Adicionais</h3>
                    <p>Para mais informações, entre em contato pelo e-mail ecobumbar@eventomaranhao.com ou pelo telefone
                        (99)
                        9999-9999.</p>
                </div>
            </div>
        </div>
    </section>


    <section class="section m-5">
        <h2 class="text-center mb-4">Iniciativas Privadas</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-content">
                        <div class="accordion" id="accordionProtect">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingProtect">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProtect" aria-expanded="true" aria-controls="collapseProtect">
                                        Proteja Nossas Florestas
                                    </button>
                                </h2>
                                <div id="collapseProtect" class="accordion-collapse collapse" aria-labelledby="headingProtect" data-bs-parent="#accordionProtect">
                                    <div class="accordion-body">
                                        <p>Aprenda sobre práticas de reflorestamento e como você pode ajudar na
                                            conservação
                                            de nossas florestas e biodiversidade.</p>
                                        <a href="#" class="btn btn-primary">Saiba Mais</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-content">
                        <div class="accordion" id="accordionEvents">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEvents">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEvents" aria-expanded="false" aria-controls="collapseEvents">
                                        Iniciativas Locais
                                    </button>
                                </h2>
                                <div id="collapseEvents" class="accordion-collapse collapse" aria-labelledby="headingEvents" data-bs-parent="#accordionEvents">
                                    <div class="accordion-body">
                                        <p>Descubra como se envolver em projetos comunitários voltados para a
                                            preservação do
                                            meio ambiente em sua região.</p>
                                        <a href="#" class="btn btn-success">Participe Agora</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Novos acordeões com imagem e texto -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="accordion" id="accordionImage1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingImage1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImage1" aria-expanded="false" aria-controls="collapseImage1">
                                    ECO BUMBAR 2019
                                </button>
                            </h2>
                            <div id="collapseImage1" class="accordion-collapse collapse" aria-labelledby="headingImage1" data-bs-parent="#accordionImage1">
                                <div class="accordion-body d-flex gap-2">
                                    <img src="https://via.placeholder.com/200x150" class="img-fluid" alt="Imagem 1">
                                    <p>...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion" id="accordionImage2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingImage2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImage2" aria-expanded="false" aria-controls="collapseImage2">
                                    ECO BUMBAR 2021
                                </button>
                            </h2>
                            <div id="collapseImage2" class="accordion-collapse collapse" aria-labelledby="headingImage2" data-bs-parent="#accordionImage2">
                                <div class="accordion-body d-flex gap-2">
                                    <img src="https://via.placeholder.com/200x150" class="img-fluid" alt="Imagem 2">
                                    <p>...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <section class="parallax-section">
        <div class="parallax-content">
            <div class="container">
                <h2 class="text-center mb-4">Participe do Nosso Evento!</h2>
                <p class="text-center">Inscreva-se agora para fazer parte do nosso evento do Eco Bumbar.</p>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#cadastroModal">
                        <i class="fas fa-calendar-check"></i> Inscreva-se Agora
                    </button>
                </div>
            </div>
        </div>
    </section>

    <?php

    if (isset($_SESSION['cpfExits'])) :
    ?>
        <script>
            var msg_cpf = `
        <div class="container mt-5">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Verificação de CPF</h4>
                <p class="mb-0">
                    O CPF informado parece ser inválido. Por favor, verifique se digitou corretamente. Se persistir o problema, entre em contato conosco pelo email <a href="mailto:ecobumbar2024@gmail.com">ecobumbar2024@gmail.com</a>. <i class="far fa-frown"></i> <i class="far fa-envelope"></i>
                </p>
            </div>
        </div>
    `;

            Swal.fire({
                title: "Erro Na Validação CPF Já Existe",
                icon: "error",
                html: msg_cpf,
                showCloseButton: true
            });
        </script>


    <?php
    endif;
    unset($_SESSION['cpfExits'])
    ?>

    <?php
    if (isset($_SESSION['emaiExist'])) :
    ?>
        <script>
            var msg_cpf = `
                <div class="container mt-5">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Verificação de EMAIL</h4>
                        <p class="mb-0">
                            O EMAIL informado parece ser inválido. Por favor, verifique se digitou corretamente. Se persistir o problema, entre em contato conosco pelo email <a href="mailto:ecobumbar2024@gmail.com">ecobumbar2024@gmail.com</a>. <i class="far fa-frown"></i> <i class="far fa-envelope"></i>
                        </p>
                    </div>
                </div>
            `;

            Swal.fire({
                title: "Erro Na Validação EMAIL Já Existe",
                icon: "error",
                html: msg_cpf,
                showCloseButton: true
            });
        </script>

    <?php
    endif;
    unset($_SESSION['emaiExist'])
    ?>


    <!-- Modal de Cadastro -->
    <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="cadastroModalLabel"><i class="fas fa-user-plus"></i> Cadastro
                        de Participante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 bg-white p-3" style="border-radius: 1rem;">
                            <img src="./Assets/Cadastro.jpg" class="img-fluid" alt="Imagem de Cadastro">
                        </div>
                        <div class="col-lg-6">
                            <form id="SignUpForm">
                                <div class="mb-3">
                                    <label for="nome" class="form-label text-white">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-white">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cpf" class="form-label text-white">CPF:</label>
                                    <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" name="cpf" pattern="\d{11}" title="Digite apenas 11 números" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefone" class="form-label text-white">Telefone:</label>
                                    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Digite seu telefone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cep" class="form-label text-white">CEP:</label>
                                    <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite seu CEP" required>
                                    <input type="hidden" class="form-control" id="cidade" name="cidade">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-light">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Carrosel de parceiros -->

    <section class="section m-5">
        <div class="container">
            <h2 class="text-center mb-4">Nossos Parceiros</h2>
            <div id="carouselPartners" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://via.placeholder.com/200x150" class="card-img-top" alt="Partner 1">
                                    <div class="card-body colorSection">
                                        <h5 class="card-title">Nome do Parceiro 1</h5>
                                        <p class="card-text">Descrição do Parceiro 1.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://via.placeholder.com/200x150" class="card-img-top" alt="Partner 2">
                                    <div class="card-body colorSection">
                                        <h5 class="card-title">Nome do Parceiro 2</h5>
                                        <p class="card-text">Descrição do Parceiro 2.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://via.placeholder.com/200x150" class="card-img-top" alt="Partner 3">
                                    <div class="card-body colorSection">
                                        <h5 class="card-title">Nome do Parceiro 3</h5>
                                        <p class="card-text">Descrição do Parceiro 3.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Mais itens do carrossel aqui -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPartners" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselPartners" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
        </div>
    </section>

    <section class="section m-5">
        <div class="container">
            <h2 class="text-center mb-4">Projetos da Eco Bumbar</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/800x600" class="card-img-top" alt="Projeto 1">
                        <div class="card-body">
                            <h5 class="card-title">Reflorestamento Sustentável</h5>
                            <p class="card-text">Nossos esforços de reflorestamento visam restaurar ecossistemas e
                                proteger
                                a biodiversidade.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/800x600" class="card-img-top" alt="Projeto 2">
                        <div class="card-body">
                            <h5 class="card-title">Educação Ambiental</h5>
                            <p class="card-text">Promovemos programas educacionais para aumentar a conscientização sobre
                                questões ambientais.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/800x600" class="card-img-top" alt="Projeto 3">
                        <div class="card-body">
                            <h5 class="card-title">Tecnologias Sustentáveis</h5>
                            <p class="card-text">Investimos em soluções tecnológicas que reduzem o impacto ambiental e
                                promovem a sustentabilidade.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Cidades Convidadas</h2>
        <div id="map"></div>
    </div>


    <section class="section m-5">
        <h2 class="text-center mb-4">Entre em Contato</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form>
                        <div class="mb-3">
                            <label for="nome" class="form-label"><i class="bi bi-person-fill"></i> Nome:</label>
                            <input type="text" class="form-control" id="nome" placeholder="Digite seu nome">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> E-mail:</label>
                            <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail">
                        </div>
                        <div class="mb-3">
                            <label for="mensagem" class="form-label"><i class="bi bi-chat-fill"></i> Mensagem:</label>
                            <textarea class="form-control" id="mensagem" rows="5" placeholder="Digite sua mensagem"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-envelope"></i> Enviar
                                Mensagem</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <img src="https://www.shaktiplasticinds.com/wp-content/uploads/2021/07/EPR.png" class="img-fluid" alt="Imagem de Contato">
                </div>
            </div>
        </div>
    </section>



    <section class="section m-5">
        <!-- Raspadinha -->
        <h2 class="text-center mb-4">Eco Prêmios</h2>

        <div class="d-flex justify-content-between align-items-center bg-white p-3 section-contentN">
            <div style="width: 50%;">
                <div>
                    <h2 class="fw-bold">Ganhe um super Prêmios</h2>
                    <p class="text-muted">Não perca a oportunidade de adquirir seu Prêmios! Raspe
                        e
                        descubra o código do Prêmios exclusivo.</p>
                </div>
            </div>

            <div class="flip-card d-flex align-items-center justify-content-center" style="width: 50%;height: 23rem;padding: 1rem; overflow: hidden;">
                <div class="flip-card-inner ">
                    <div class="flip-card-front d-flex align-items-center justify-content-center">
                        <img src="./Assets/Raspadinha.png" style="width: 50%;" />
                    </div>
                    <div class="flip-card-back">
                        <section class="parallax-section">
                            <div class="parallax-content">
                                <div class="container">
                                    <h2 class="text-center mb-4">Participe do Nosso Evento!</h2>
                                    <p class="text-center">Inscreva-se agora para fazer parte do nosso evento do Eco
                                        Bumbar.</p>
                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#cadastroModal">
                                            <i class="fas fa-calendar-check"></i> Inscreva-se Agora
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section m-5">
        <h2 class="text-center mb-4">Pesquisar Projetos do Eco Bumbar</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Escolha o Mês:</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Escolha um mês...</option>
                            <option value="Janeiro">Janeiro</option>
                            <option value="Fevereiro">Fevereiro</option>
                            <option value="Março">Março</option>
                            <!-- Adicione mais opções conforme necessário -->
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupDate">Escolha a Data:</label>
                        <input type="date" class="form-control" id="inputGroupDate">
                    </div>
                </div>
                <div class="col-lg-4">
                    <button type="button" class="btn btn-primary" onclick="pesquisarPorData()">Pesquisar</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div id="resultadoPesquisa">
                        <!-- Aqui é onde o resultado da pesquisa será exibido -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function pesquisarPorData() {
            var mesSelecionado = document.getElementById("inputGroupSelect01").value;
            var dataSelecionada = document.getElementById("inputGroupDate").value;
            var textoResultado = "Projetos do Eco Bumbar em " + mesSelecionado + " de " + dataSelecionada + ":";

            // Aqui você pode adicionar a lógica para buscar os projetos do Eco Bumbar para a data selecionada

            // Por enquanto, vamos apenas exibir um texto de placeholder
            textoResultado += "<br>Este é um texto de exemplo para simular os projetos do Eco Bumbar em " + mesSelecionado + " de " + dataSelecionada + ".";

            document.getElementById("resultadoPesquisa").innerHTML = textoResultado;
        }
    </script>






    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="text-center py-3">
                <p class="mb-0">&copy; 2024 Eco Bumbar Eventos. Todo os direitos reservados <a href="#" target="_blank">Daniel</a></p>
            </div>
        </div>
    </footer>


    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-5.08921, -45.4269], 6);

        // Adicionando camada de mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        // Lista de cidades com participações
        var cities = [{
                name: 'São Luís',
                coordinates: [-2.53073, -44.3068],
                participation: 'Apresentação Cultural'
            },
            {
                name: 'Imperatriz',
                coordinates: [-5.51829, -47.4728],
                participation: 'Feira de Artesanato'
            },
            {
                name: 'Caxias',
                coordinates: [-4.85859, -43.3569],
                participation: 'Oficina de Sustentabilidade'
            },
            {
                name: 'São José de Ribamar',
                coordinates: [-2.54814, -44.0596],
                participation: 'Palestra sobre Preservação Ambiental'
            },
            {
                name: 'Timon',
                coordinates: [-5.09747, -42.8237],
                participation: 'Exposição de Fotografias'
            },
            {
                name: 'Codó',
                coordinates: [-4.45583, -43.8925],
                participation: 'Reciclagem de Resíduos'
            },
            {
                name: 'Bacabal',
                coordinates: [-4.23472, -44.7839],
                participation: 'Plantação de Árvores'
            },
            {
                name: 'Açailândia',
                coordinates: [-4.94722, -47.5003],
                participation: 'Limpeza de Praias'
            },
            {
                name: 'Balsas',
                coordinates: [-7.5325, -46.0389],
                participation: 'Campanha de Conscientização Ambiental'
            },
            {
                name: 'Barra do Corda',
                coordinates: [-5.50528, -45.2536],
                participation: 'Feira de Produtos Sustentáveis'
            }
            // Adicione mais cidades conforme necessário
        ];

        // Adicionando marcadores para cada cidade
        cities.forEach(function(city) {
            var marker = L.marker(city.coordinates).addTo(map);
            marker.bindPopup('<b>' + city.name + '</b><br>' + city.participation).openPopup();
        });
    </script>

</body>

</html>