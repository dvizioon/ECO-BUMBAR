<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalação do Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e8f5e9;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border: 1px solid #388e3c;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #25D366;
        }

        .btn-success {
            background-color: #25D366;
            border-color: #388e3c;
        }

        .btn-success:hover {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }

        .sql-script {
            white-space: pre-wrap;
        }

        .block {
            display: none;
            transition: opacity 1s ease-in-out;
        }

        .block.active {
            display: block;
            opacity: 1;
        }

        .block.inactive {
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="d-flex justify-content-center p-2">
                        <img style="width: 10rem;" src="../Assets/Logo.png" alt="">
                    </div>
                    <div class="card-header text-center text-white">
                        <h2>Instalação do Sistema /EcoBumbar</h2>
                    </div>
                    <div class="card-body">
                        <form id="installForm" action="./install.php" method="POST">
                            <!-- Block Host -->
                            <div id="blockHost" class="block active">
                                <div class="mb-3">
                                    <label for="dbHost" class="form-label">Host do Banco de Dados</label>
                                    <input type="text" class="form-control" id="dbHost" name="dbHost" required placeholder="localhost">
                                </div>
                                <div class="mb-3">
                                    <label for="dbUser" class="form-label">Usuário do Banco de Dados</label>
                                    <input type="text" class="form-control" id="dbUser" name="dbUser" required placeholder="root">
                                </div>
                                <div class="mb-3">
                                    <label for="dbPassword" class="form-label">Senha do Banco de Dados</label>
                                    <input type="password" class="form-control" id="dbPassword" name="dbPassword" required placeholder="43dr3...">
                                </div>
                                <div class="mb-3">
                                    <label for="dbName" class="form-label">Nome do Banco de Dados</label>
                                    <input type="text" class="form-control" id="dbName" name="dbName" required placeholder="ecobumbar">
                                </div>
                                <button type="button" class="btn btn-success w-100" onclick="showBlockUser()">Prosseguir</button>
                            </div>
                            <!-- Block User -->
                            <div id="blockUser" class="block inactive">
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="userPassword" name="userPassword" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Instalar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showBlockUser() {
            const blockHost = document.getElementById('blockHost');
            const blockUser = document.getElementById('blockUser');
            blockHost.classList.add('inactive');
            setTimeout(() => {
                blockHost.classList.remove('active');
                blockUser.classList.remove('inactive');
                blockUser.classList.add('active');
            }, 1000); // Aguarde a transição terminar (1 segundo)
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>