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
        $email = $usuario['Email'];
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
<html lang="pt-br">

<head>
    <title>Download do Certificado</title>
    <!-- Inclua o CSS do Bootstrap aqui -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-2">Download do Certificado</h2>
        <?php if ($certificado === "Habilitado") : ?>
            <ul class="nav nav-tabs mt-3">
                <li class="nav-item">
                    <a class="nav-link active" id="download-tab" data-toggle="tab" href="#download">Baixar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="preview-tab" data-toggle="tab" href="#preview">Visualizar</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="download">
                    <div class="mt-3">
                        <h5>Baixar Certificado 📥</h5>
                        <button class="btn btn-primary" onclick="window.location.href='<?php echo "{$caminho}" ?>'">Baixar Certificado</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="preview">
                    <div class="mt-3" style='overflow-y: auto; max-height: 430px;'>
                        <h5>Visualizar Certificado 👀</h5>

                        <!-- Substitua 'certificado.pdf' pelo caminho do seu arquivo de certificado -->
                        <embed src="<?php echo "{$caminho}" ?>" type="application/pdf" width="100%" height="600px" />
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-warning mt-3" role="alert">
                <?php echo $_SESSION['email'] ?> o Certificado ainda não foi Liberado Aguarde...
            </div>
        <?php endif; ?>

    </div>
    <!-- Inclua o JS do Bootstrap aqui -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>