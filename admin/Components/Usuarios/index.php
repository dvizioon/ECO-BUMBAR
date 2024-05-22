<?php
session_start();
include('../../../Connection/index.php');

$conexao = new ConexaoMySQLi();
$db = $conexao->getConexao();
// Verificar a conexão
if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

// Consultar todos os usuários
$sql_listar_usuarios = "SELECT * FROM usuarios";
$resultado = $db->query($sql_listar_usuarios);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Lista de Usuários</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th>Ações</th> <!-- Coluna para os botões de exclusão -->
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $usuario['id_user']; ?></td>
                        <td><?php echo $usuario['Nome']; ?></td>
                        <td><?php echo $usuario['Email']; ?></td>
                        <td><?php echo $usuario['Telefone']; ?></td>
                        <td><?php echo $usuario['Cidade']; ?></td>
                        <td>
                            <!-- Botão de exclusão -->
                            <button type="button" class="btn btn-danger btn-sm" onclick="excluirUsuario(<?php echo $usuario['id_user']; ?>, '<?php echo $usuario['Email']; ?>')">

                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function excluirUsuario(idUsuario, email) {
            if (confirm('Tem certeza de que deseja excluir este usuário?')) {
                // Redirecionar para a página de exclusão com o ID do usuário
                window.location.href = `./admin/Components/Usuarios/action/excluir_usuario.php?id=${idUsuario}&Email=${email}`;

            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Fechar conexão com o banco de dados
$db->close();
?>