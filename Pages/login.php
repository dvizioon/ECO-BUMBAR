<?php
session_start();
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            border-color: #ced4da;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-primary:focus {
            box-shadow: none;
        }

        .info-box {
            border-radius: 10px;
            background-color: #f0f0f0;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">

            <div class="col-md-4">

                <div class="card" style="border: 2px solid #34d399d3;">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4"><i class="fas fa-lock"></i> Login EcoBumbar</h4>
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" class="form-control" name="email" id="emailLogin" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label"><i class="fas fa-lock"></i> Senha</label>
                                <input type="password" name="pass" class="form-control" id="passwordLogin" required>
                            </div>
                            <button class="btn btn-block" style="background:#34d399d3;"><i class="fas fa-sign-in-alt"></i> Entrar</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-link">Esqueceu sua senha?</a>
                    </div>
                    <div class="info-box">
                        <i class="fas fa-info-circle info-box-icon"></i>
                        <span id="dataHora"></span>
                        <p>Verifique seu e-mail ou sua caixa de spam ou lixo Eletrônico para obter instruções. 📧</p>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_SESSION['dadosNotFound'])) :
        ?>
            <script>
                var msg_cpf = `
                    <div class="container mt-5">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Erro de Autenticação</h4>
                            <p>Não foi possível encontrar os dados de acesso.</p>
                            <?php if (isset($_SESSION['dadosNotFound'])) : ?>
                                <hr>
                                <p class="mb-0">Email: <?php echo $_SESSION['dadosNotFound']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                `;


                Swal.fire({
                    title: "Erro na Validação",
                    icon: "error",
                    html: msg_cpf,
                    showCloseButton: true
                });
            </script>

        <?php
        endif;
        unset($_SESSION['dadosNotFound'])
        ?>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popprjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script src="./Js/formAjaxLogin.js"></script>

    <!-- JavaScript para exibir data e hora -->
    <script>
        function atualizarDataHora() {
            var dataHoraAtual = new Date();
            var dataHoraFormatada = dataHoraAtual.toLocaleString('pt-BR');
            document.getElementById('dataHora').textContent = dataHoraFormatada;
        }
        // Atualizar a cada segundo
        setInterval(atualizarDataHora, 1000);
        // Chamada inicial
        atualizarDataHora();
    </script>
</body>

</html>