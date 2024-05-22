<?php
session_start();

if (!isset($_SESSION['email'])) {

    if (!isset($_SESSION['pass']) && !isset($_SESSION['profile'])) {

        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        session_destroy();

        header('Location: ../../login');
        exit;
    }

    unset($_SESSION['email']);
    unset($_SESSION['pass']);
    session_destroy();

    header('Location: ../../login');
    exit;
};


?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="./Css/style.css" media="all">
    <!-- Inclua os ícones do Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <div class="containerAll">

        <div class="sidebar">
            <div class="text-center mb-4">
                <h3 class="text-white">Menu</h3>
            </div>
            <!-- Lista de itens do menu -->
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="d-inline-block text-truncate" style="max-width: 150px;" href="#" onclick="toggleSubMenu('userSubMenu')">Usuário <?php echo $_SESSION['email'] ?></a>
                    <!-- Conteúdo para a opção de usuário -->
                    <ul class="submenu" id="userSubMenu" style="display: block;">
                        <li><a href="#" onclick="loadComponent('./admin/Components/GroupWhatsapp/index.php')">Entrar No Grupo</a></li>
                        <li><a href="#" onclick="loadComponent('./admin/Components/Certificado/index.php')">Meus Certificados</a></li>
                        <li><a href="#" onclick="loadComponent('./admin/Components/Live/index.php')">Lives ao Vivo</a></li>
                        <li><a href="#" onclick="loadComponent('./admin/Components/DadosIncricao/index.php')">Fichar de Incrição</a></li>
                    </ul>


                </li>

                <?php if ($_SESSION['profile'] === "admin") : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="toggleSubMenu('adminSubMenu')">Administração</a>
                        <!-- Conteúdo para a opção de administração -->
                        <ul class="submenu" id="adminSubMenu" style="display: block;">
                            <li><a href="#" onclick="loadComponent('./admin/Components/Grapichs/index.php')">Dashboard</a></li>
                            <li><a href="#" onclick="loadComponent('./admin/Components/LiberarCertificado/index.php')">Liberar Certificados</a></li>
                            <li><a href="#" onclick="loadComponent('./admin/Components/Usuarios/index.php')">Usuarios Cadastrados</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleSubMenu('adminSubMenu')">Configuração</a>
                    <!-- Conteúdo para a opção de administração -->
                    <ul class="submenu" id="adminSubMenu" style="display: block;">
                        <?php if ($_SESSION['profile'] === "admin") : ?>
                            <li><a href="#" onclick="loadComponent('./admin/Components/ConfigEmail/index.php')">Email/SMTP</a></li>
                        <?php endif; ?>
                        <li><a href="#" onclick="loadComponent('./admin/Components/About/index.php')">Sobre o Sitema</a></li>
                    </ul>
                </li>
            </ul>
        </div>


        <div class="container-header-content">

            <div class="headerBox">

                <div>
                    <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
                        <i class="fas fa-bars text-white"></i>
                    </button>
                </div>
                <div style="display: flex; gap:0.5rem;align-items:center ;font-size:1.2rem;">
                    <span class="text-white bg-success p-1 rounded">Olá, <?php echo $_SESSION['email'] ?></span>

                    <button type="button" class="btn btn-primary position-relative" id="openModalBtn">
                        <i class="fas fa-envelope"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            1+
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                    <i class="fas fa-user-circle"></i>
                    <a href="./admin/Modules/Logouth.php">
                        <i class="fas fa-sign-out-alt text-white"></i>
                    </a>
                </div>

            </div>

            <div class="contentViewcomponents"></div>
        </div>


    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popprjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        // Função para carregar os componentes dinamicamente
        function loadComponent(component) {
            // Faz uma requisição AJAX para carregar o conteúdo do componente
            $.ajax({
                url: component,
                type: 'GET',
                success: function(response) {
                    // Insere o conteúdo na div "content"
                    $('.contentViewcomponents').html(response);
                    // Salva o caminho do componente no localStorage
                    localStorage.setItem("caminho", component);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Verifica se a chave 'caminho' existe no localStorage
        if (!localStorage.getItem('caminho')) {
            // Se não existir, define o valor padrão para a chave 'caminho'
            localStorage.setItem('caminho', './admin/Components/GroupWhatsapp/index.php');
        }

        // Obtém o caminho do componente a ser carregado
        const caminhoComponente = localStorage.getItem('caminho');

        // Verifica se a div "contentViewcomponents" está vazia
        const content = $(".contentViewcomponents");
        if (content.html() === "") {
            // Carrega o componente correspondente ao caminho salvo
            loadComponent(caminhoComponente);
        }

        // Função para abrir ou fechar o menu lateral
        function toggleSidebar() {
            $('.sidebar').toggleClass('active');
        }

        function toggleSubMenu(subMenuId) {
            var subMenu = document.getElementById(subMenuId);
            if (subMenu.style.display === "none") {
                subMenu.style.display = "block";
            } else {
                subMenu.style.display = "none";
            }
        }

        $(document).ready(function() {
            $('#openModalBtn').click(function() {
                $('#atualizacaoModal').modal('show');
            });
        });
    </script>


</body>

</html>