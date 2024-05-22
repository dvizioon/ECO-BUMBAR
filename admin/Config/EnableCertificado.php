<?php
session_start();
include('../../Connection/index.php');

$conexao = new ConexaoMySQLi();
$db = $conexao->getConexao();
// Verificar a conexão
if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

$Status_Cert = $_POST['configCert'];

$sql_listar_usuarios = "SELECT * FROM usuarios";
$resultado = $db->query($sql_listar_usuarios);


// Definir o número de usuários por página
$usuarios_por_pagina = 5;

// Obter o número total de usuários
$sql_contar_usuarios = "SELECT COUNT(*) AS total FROM usuarios";
$resultado_contagem = $db->query($sql_contar_usuarios);
$total_usuarios = $resultado_contagem->fetch_assoc()['total'];



if ($resultado->num_rows > 0) {
    // Exibir os dados de cada usuário
    echo "<div class='container mt-4'>
        <div class='row'>
            <div class='col-md-8 offset-md-2'>
                <div class='card'>
                    <div class='card-header'>
                        <h3 class='text-center'>Total Atualizados " . $total_usuarios . "</h3>
                    </div>
                    <div class='card-body' style='overflow-y: auto; max-height: 300px;'>";


    while ($usuario = $resultado->fetch_assoc()) {
        // echo "ID: " . $usuario["id_user"] . " - Nome: " . $usuario["Nome"] . " - Email: " . $usuario["Email"] . "<br>";

        // Atualizar o campo EstadoCert para cada usuário com o valor correspondente de $Status_Cert
        $sql_atualizar_estado_cert = "UPDATE usuarios SET EstadoCert = '{$Status_Cert}' WHERE id_user = " . $usuario["id_user"];

        $_SESSION['certificado'] = $Status_Cert;
        

        if ($db->query($sql_atualizar_estado_cert) === TRUE) {
            // echo "EstadoCert atualizado para '{$Status_Cert}' para o usuário ID: " . $usuario["id_user"] . "<br>";
            $_SESSION['usuarioHb'] = "EstadoCert atualizado para '{$Status_Cert}' para o usuário ID: " . $usuario["id_user"] . "<br>";
        } else {
            echo "Erro ao atualizar EstadoCert: " . $db->error;
        }
    }

} else {
    echo "Nenhum usuário encontrado.";
}



// Calcular o número total de páginas
$total_paginas = ceil($total_usuarios / $usuarios_por_pagina);

// Obter o número da página atual
$pagina_atual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular o offset para a consulta SQL
$offset = ($pagina_atual - 1) * $usuarios_por_pagina;

// Consultar os usuários com paginação
$sql_listar_usuarios_paginacao = "SELECT * FROM usuarios LIMIT $offset, $usuarios_por_pagina";
$resultado = $db->query($sql_listar_usuarios_paginacao);

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
                    <th>Certificado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $usuario['id_user']; ?></td>
                        <td><?php echo $usuario['Nome']; ?></td>
                        <td><?php echo $usuario['Email']; ?></td>
                        <td><?php echo $usuario['EstadoCert']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Paginação -->
        <nav aria-label="Navegação de página">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                    <li class="page-item <?php if ($i == $pagina_atual) echo 'active'; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php

$db->close();

?>