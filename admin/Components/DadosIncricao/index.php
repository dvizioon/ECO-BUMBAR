<?php

session_start();
include('../../../Connection/index.php');

$conexao = new ConexaoMySQLi();
$db = $conexao->getConexao();

// Verificar a conexão
if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

$id_user = $_SESSION['id'];

$sql_listar_usuarios = "SELECT * FROM usuarios WHERE id_user = " . $id_user; // Corrigido o operador de comparação e a concatenação da variável
$resultado = $db->query($sql_listar_usuarios);

// Verifica se a consulta retornou resultados
if ($resultado->num_rows > 0) {
    // Itera sobre os resultados e acessa os dados de cada linha
    while ($usuario = $resultado->fetch_assoc()) {
        // Acessa os dados do usuário
        $id_user = $usuario['id_user'];
        $nome = $usuario['Nome'];
        $pass = $usuario['Pass'];
        $email = $usuario['Email'];
        $cpf = $usuario['Cpf'];
        $cidade = $usuario['Cidade'];
        $telefone = $usuario['Telefone'];
        $certificado = $usuario['EstadoCert'];
        $caminho = $usuario['Certificado'];
    }
} else {
    echo "Nenhum usuário encontrado.";
}

// Fecha a conexão com o banco de dados
$db->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center mt-4">
        <div class="card p-4">
            <h2 class="text-center"><i class="fas fa-user-plus"></i> Formulário de Inscrição</h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome"><i class="fas fa-user"></i> Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome;  ?>" required disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;  ?>" required disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cpf"><i class="fas fa-id-card"></i> CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" required value="<?php echo $cpf;  ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefone"><i class="fas fa-phone"></i> Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo $telefone;  ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="endereco"><i class="fas fa-map-marker-alt"></i> Cidade</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $cidade;  ?>" disabled>
                    </div>
                </div>
                <!-- Botão para abrir o modal de alteração de senha -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAlterarSenha">
                    Alterar Senha
                </button>
            </div>
        </div>
    </div>


    <!-- Modal de alteração de senha -->
    <div class="modal fade" id="modalAlterarSenha" tabindex="-1" aria-labelledby="modalAlterarSenhaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAlterarSenhaLabel">Alterar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./admin/Components/DadosIncricao/action/editar_inscricao.php" id="formAlterarSenha" method="POST">
                    <div class="modal-body" id="formAlterarSenha">
                        <!-- Formulário de alteração de senha aqui -->
                        <div class="form-group">
                            <label for="novaSenha">Senha Antiga</label>
                            <input type="text" class="form-control" value="<?php echo $pass; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="novaSenha">Nova Senha</label>
                            <input type="password" class="form-control" id="novaSenha" name="novaSenha" required>
                            <span id="senhaError" style="color:red;"></span>
                        </div>

                        <div>
                            <input type="hidden" name="id" value="<?php echo $id_user;  ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="alterarSenha()">Salvar Alterações</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        function alterarSenha(e) {
            var novaSenha = document.getElementById("novaSenha").value;

            if (novaSenha.length < 8) {
                document.getElementById("senhaError").innerText = "A senha deve ter pelo menos 8 caracteres.";
                return;
            }

            // Se passar nas validações, pode enviar o formulário
            document.getElementById("formAlterarSenha").submit();
        }
    </script>
</body>

</html>