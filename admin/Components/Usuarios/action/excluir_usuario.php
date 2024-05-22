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
if (isset($_GET['id'])) {
    // Obter o ID do usuário a ser excluído
    $idUsuario = $_GET['id'];
    // echo $idUsuario;
    $emailUser = $_GET['Email'];
    // echo $emailUser;
    // echo $_SESSION['email'];

    // Preparar e executar a consulta para excluir o usuário
    $sql_excluir_usuario = "DELETE FROM usuarios WHERE id_user = $idUsuario";

    if ($db->query($sql_excluir_usuario) === TRUE) {
        $_SESSION['mensagem'] = "Usuário excluído com sucesso.";
        // Realizar uma verificação
        if($emailUser === $_SESSION['email']){
            session_destroy();
            header("Location:../../../../login");
            exit();
        }

    } else {
        $_SESSION['erro'] = "Erro ao excluir usuário: " . $db->error;
    }

   
} else {
    $_SESSION['erro'] = "ID do usuário não fornecido.";
}


exit();
