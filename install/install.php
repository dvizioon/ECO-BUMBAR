<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalação do Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #e8f5e9;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border: 1px solid #388e3c;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }

        .card-header {
            background-color: #388e3c;
            color: white;
        }

        .btn-success {
            background-color: #388e3c;
            border-color: #388e3c;
        }

        .btn-success:hover {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }

        .alert i {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obter dados do formulário
            $dbHost = $_POST['dbHost'];
            $dbUser = $_POST['dbUser'];
            $dbPassword = $_POST['dbPassword'];
            $dbName = $_POST['dbName'];
            $userEmail = $_POST['userEmail'];
            $userPassword = $_POST['userPassword'];

            // Tente conectar ao banco de dados
            $conn = new mysqli($dbHost, $dbUser, $dbPassword);

            // Verifique se a conexão foi bem-sucedida
            if ($conn->connect_error) {
                $message = "<div class='alert alert-danger'><i class='bi bi-exclamation-triangle-fill'></i> Conexão falhou: " . $conn->connect_error . "</div>";
            } else {
                // Verifique se o banco de dados já existe
                $dbExistsQuery = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'";
                $dbExistsResult = $conn->query($dbExistsQuery);

                if ($dbExistsResult->num_rows > 0) {
                    $message = "<div class='alert alert-warning'><i class='bi bi-exclamation-circle-fill'></i> O banco de dados já existe. <a href='/phpmyadmin'>Visitar phpmyadmin</a></div>";
                    // Salvar credenciais no arquivo credenciais.txt
                    $credentialsDir = dirname(__DIR__) . '\Connection';

                    if (!is_dir($credentialsDir)) {
                        // mkdir($credentialsDir, 0755, true);
                        $message = "<div class='alert alert-warning'><i class='bi bi-exclamation-circle-fill'></i> Pasta Connection Não Encontrada...</div>";
                    } else {

                        $credentialsFile = $credentialsDir . '/index.php'; 
                        $credentialsContent = "<?php
class ConexaoMySQLi
{
    private \$conexao;

    public function __construct()
    {
        // Define as credenciais
        define('DB_HOST', '$dbHost');
        define('DB_USER', '$dbUser');
        define('DB_PASS', '$dbPassword');
        define('DB_NAME', '$dbName');

        // Criar conexão com o banco de dados
        \$this->conexao = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verificar conexão
        if (\$this->conexao->connect_error) {
            die('Conexão falhou: ' . \$this->conexao->connect_error);
        }
    }

    public function getConexao()
    {
        return \$this->conexao;
    }
}

// Exemplo de uso:
// \$conexao = new ConexaoMySQLi();
// \$db = \$conexao->getConexao();

// Agora você pode usar a variável \$db para executar consultas SQL
// Exemplo: \$result = \$db->query('SELECT * FROM tabela');
";


                        file_put_contents($credentialsFile, $credentialsContent);
                    }
                } else {
                    // Crie o banco de dados e tabelas
                    $sqlScript = "
            CREATE DATABASE IF NOT EXISTS $dbName;
            USE $dbName;

            CREATE TABLE IF NOT EXISTS usuarios (
                id_user INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Cpf VARCHAR(255) NOT NULL,
                Nome VARCHAR(255) NOT NULL,
                Pass VARCHAR(255) NOT NULL,
                Email VARCHAR(255) NOT NULL,
                Telefone VARCHAR(255) NOT NULL,
                Cidade VARCHAR(255) NOT NULL,
                Profil ENUM('user','admin'),
                EstadoCert ENUM('Habilitado','Desabilitado') DEFAULT('Desabilitado'),
                Certificado VARCHAR(255) NOT NULL
            );

            CREATE TABLE IF NOT EXISTS live (
                id_live INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Live_Url_y VARCHAR(255) NOT NULL,
                Live_Url_m VARCHAR(255) NOT NULL,
                Info_Live VARCHAR(255) NOT NULL
            );

            INSERT INTO usuarios (Cpf, Nome, Pass, Email, Telefone, Cidade, Profil, EstadoCert, Certificado) VALUES
            ('...', 'admin', '$userPassword', '$userEmail', '$dbPassword', '...', 'admin', 'Desabilitado', '...');
            ";

                    if ($conn->multi_query($sqlScript) === TRUE) {


                        $message = "<div class='alert alert-success'><i class='bi bi-check-circle-fill'></i> Instalação concluída com sucesso! Por favor, remova a pasta 'install' por razões de segurança.</div>";
                    } else {
                        $message = "<div class='alert alert-danger'><i class='bi bi-x-circle-fill'></i> Erro na instalação: " . $conn->error . "</div>";
                    }
                }

                $conn->close();
            }
        }
        ?>
        <?php if (isset($message)) echo $message; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>