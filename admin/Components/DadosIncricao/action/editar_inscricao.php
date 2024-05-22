<?php
session_start();
include('../../../../Connection/index.php');


$conexao = new ConexaoMySQLi();
$db = $conexao->getConexao();
// Verificar a conexão
if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

// Verificar se o ID do usuário foi fornecido na solicitação
if (isset($_POST['id'])) {
    // Obter o ID do usuário a ser excluído
    $idUsuario = $_POST['id'];
    $senha_nova = $_POST['novaSenha'];
    // echo $senha_nova;

    // Preparar e executar a consulta para excluir o usuário
    $sql_update_senha = "UPDATE usuarios SET Pass = '{$senha_nova}' WHERE id_user = $idUsuario";

    if (
        $db->query($sql_update_senha) === TRUE
    ) {
        $_SESSION['senhaAtualizada'] = True;
    };
    header("Location:../../../../painel");
} else {
    $_SESSION['erro'] = "ID do usuário não fornecido.";
}


exit();
