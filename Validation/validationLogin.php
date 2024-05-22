<?php
session_start();
include('../Connection/index.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../lib/vendor/autoload.php';

$conexao = new ConexaoMySQLi();
$db = $conexao->getConexao();

if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (empty($_POST['email']) && empty($_POST['pass'])) {
        // As variáveis foram enviadas e não estão vazias
        // Faça algo aqui
        header('Location:../login');
        exit;
    } else {

        // Consulta preparada para evitar injeção de SQL
        $query = "SELECT * FROM usuarios WHERE Email = ? AND Pass = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $_POST['email'], $_POST['pass']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se o usuário foi encontrado
        if ($result->num_rows > 0) {
            // Login bem-sucedido
            $usuario = $result->fetch_assoc();
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['pass'] = $_POST['pass'];
            $_SESSION['id'] = $usuario['id_user'];
            $_SESSION['profile'] = $usuario['Profil']; // Passa o perfil do usuário para a sessão
            header('Location:../painel');
            exit;
            exit;
        } else {
            echo "Dados Não Encontrado";
            $_SESSION['dadosNotFound'] = $_POST['email'];
            // Login inválido
            header('Location:../login');
            exit;
        }

    }
}
