<?php
$host = $username = $password = $smtpSecure = $port = '';
$errors = [];

$iniFile = "../../../Config/Server.ini";
if (file_exists($iniFile)) {
    $config = parse_ini_file($iniFile);
    $host = $config['Host'] ?? '';
    $username = $config['Username'] ?? '';
    $password = $config['Password'] ?? '';
    $smtpSecure = $config['SMTPSecure'] ?? '';
    $port = $config['Port'] ?? '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar e capturar os valores do formulário
    $host = test_input($_POST["host"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $smtpSecure = test_input($_POST["smtpSecure"]);
    $port = test_input($_POST["port"]);

    if (empty($host)) {
        $errors[] = "O campo Host é obrigatório";
    }

    if (empty($username)) {
        $errors[] = "O campo Username é obrigatório";
    }

    if (empty($password)) {
        $errors[] = "O campo Password é obrigatório";
    }

    if (empty($smtpSecure)) {
        $errors[] = "O campo SMTP Secure é obrigatório";
    }

    if (empty($port)) {
        $errors[] = "O campo Port é obrigatório";
    }

    // Se não houver erros, salvar as configurações
    if (empty($errors)) {
        $iniString = "[EmailHost]\n";
        $iniString .= "Host=$host\n";
        $iniString .= "Username=$username\n";
        $iniString .= "Password=$password\n";
        $iniString .= "SMTPSecure=$smtpSecure\n";
        $iniString .= "Port=$port\n";

        file_put_contents($iniFile, $iniString);

        // Redirecionar de volta para a mesma página
        echo "<script>window.location.href = '../../../painel'</script>";
    }
}

// Função para validar os dados do formulário
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
