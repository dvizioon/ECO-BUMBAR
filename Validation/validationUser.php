<?php
session_start();
include('../Connection/index.php');

use Fpdf\Fpdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../lib/vendor/autoload.php';


$conexao = new ConexaoMySQLi();
$db = $conexao->getConexao();

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['cpf']) && isset($_POST['telefone'])  &&  isset($_POST['cidade'])) {
    if (empty($_POST['nome']) && empty($_POST['email']) && empty($_POST['cpf']) && empty($_POST['telefone']) && empty($_POST['cidade'])) {
        // As variáveis foram enviadas e não estão vazias
        header('Location:../index.php');
        exit;
    } else {
        function gerarSenha()
        {
            $tamanho = 8; // Tamanho fixo da senha
            // Caracteres permitidos na senha
            $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*';
            // Embaralha os caracteres e pega os $tamanho primeiros
            $senha = substr(str_shuffle($caracteres), 0, $tamanho);
            return $senha;
        }

        // Exemplo de uso: gera uma senha com 8 caracteres
        $senhaAleatoria = gerarSenha();

        // echo $senhaAleatoria;


        $mail = new PHPMailer(true);

        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $iniFile = "../Config/Server.ini";
            if (file_exists($iniFile)) {
                $config = parse_ini_file($iniFile);
                $host = $config['Host'] ?? '';
                $username = $config['Username'] ?? '';
                $password = $config['Password'] ?? '';
                $smtpSecure = $config['SMTPSecure'] ?? '';
                $port = $config['Port'] ?? '';
            }
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = "$host";
            $mail->SMTPAuth = true;
            $mail->Username = "$username";
            $mail->Password = "$password";
            $mail->SMTPSecure = "$smtpSecure";
            $mail->Port = $port;

            $mail->setFrom("$username", 'Administração');
            $mail->addAddress($_POST['email'], $_POST['nome']);

            $mail->isHTML(true);
            $mail->Subject = 'Titulo do E-mail';
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; max-width: 400px; margin: 0 auto; border: 2px solid #4CAF50; border-radius: 10px; padding: 20px;'>
                    <h1 style='color: #4CAF50; text-align: center;'>🌱 Bem-vindo ao EcoBumbar!</h1>
                    <div style='background-color: #f2f2f2; border-radius: 10px; padding: 10px;'>
                        <p style='color: #333;'><b>Usuário:</b> " . $_POST['email'] . "</p>
                        <p style='color: #333;'><b>Senha:</b> " . $senhaAleatoria . "</p>
                        <p style='color: #333;'><b>Data de Criação:</b> " . date('d/m/Y') . "</p>
                    </div>
                    <p style='color: #333; margin-top: 20px;'>Por favor, guarde estas informações em um local seguro.</p>
                    <div style='text-align: center;'>
                        <a href='http://$_SERVER[HTTP_HOST]/login' style='color: #fff; background-color: #4CAF50; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block;'>Fazer Login</a>
                    </div>
                </div>
            ";
            $mail->AltBody = "Olá! Aqui estão os detalhes da sua conta: Usuário: " . $_POST['email'] . ", Senha: " . $senhaAleatoria . ", Data de Criação: " . date('d/m/Y') . ". Por favor, guarde estas informações em um local seguro. Para fazer login, visite https://www.ecobumbar.com/login.";

            // $CreatUser = "INSERT INTO usuarios (Cpf, Nome, Pass, prof, Email, Telefone, Cidade) VALUES ('{$_POST['cpf']}', '{$_POST['nome']}', '{$senhaAleatoria}', 'user', '{$_POST['email']}', '{$_POST['telefone']}', '{$_POST['cidade']}');";
            // echo 'E-mail enviado com sucesso!<br>';


            // Verifica se o CPF já existe no banco de dados
            $cpfExistente = "SELECT COUNT(*) AS total FROM usuarios WHERE Cpf = '{$_POST['cpf']}'";
            $emailExistente = "SELECT COUNT(*) AS total FROM usuarios WHERE Email = '{$_POST['email']}'";

            $resultadoCpf = $db->query($cpfExistente);
            $resultadoEmail = $db->query($emailExistente);

            $dadosCpf = $resultadoCpf->fetch_assoc();
            $dadosEmail = $resultadoEmail->fetch_assoc();

            if ($dadosCpf['total'] > 0) {
                // echo "CPF já está em uso. Por favor, escolha outro CPF.";
                $_SESSION['cpfExits'] = $_POST['cpf'];
                header('Location:../index.php');
                exit;
            } elseif ($dadosEmail['total'] > 0) {
                $_SESSION['emaiExist'] = $_POST['email'];
                header('Location:../index.php');
                exit;
            } else {
                // CPF e e-mail não existem, proceda com a inserção no banco de dados

                // Obter os dados do formulário
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $email = $_POST['email'];

                // Gerar a data atual
                $data = date('d/m/Y');

                // Criar uma nova instância de FPDF
                $pdf = new FPDF('L');

                // Adicionar uma página
                $pdf->AddPage();

                // Adicionar a imagem de fundo
                $pdf->Image('../Assets/Logo.png', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

                // Definir a fonte
                $pdf->SetFont('Arial', 'B', 20); // Aumentar o tamanho da fonte para 20

                // Adicionar o conteúdo ao PDF
                $pdf->Cell(0, 10, 'Certificado', 0, 1, 'C'); // Centralizar o texto
                $pdf->Cell(0, 10, 'Nome: ' . $nome, 0, 1, 'C'); // Centralizar o texto
                $pdf->Cell(0, 10, 'O portador do CPF: ' . $cpf, 0, 1, 'C'); // Centralizar o texto
                $pdf->Cell(0, 10, 'Data: ' . $data, 0, 1, 'C'); // Centralizar o texto

                // Adicionar uma assinatura no final
                $pdf->Ln(10); // Adicionar uma linha em branco
                $pdf->Cell(0, 120, 'Assinatura: ecoBumbar', 0, 1, 'R'); // Adicionar a assinatura no canto direito

                // Salvar o PDF no diretório de uploads
                $pdfFilePath = '../Uploads/Certificados_Cadastrados/' . $_POST['cpf'] . '.pdf';
                $pdf->Output($pdfFilePath, 'F');

                // Limpar os campos do formulário
                $nome = '';
                $cpf = '';
                $email = '';
                $data = '';

                $filePdfUser = './Uploads/Certificados_Cadastrados/' . $_POST['cpf'] . '.pdf';
                // Prepara a consulta de inserção
                $insertQuery = "INSERT INTO usuarios (Cpf, Nome, Pass, Email, Telefone, Cidade, Profil , EstadoCert , Certificado ) 
                VALUES ('{$_POST['cpf']}', '{$_POST['nome']}', '{$senhaAleatoria}', '{$_POST['email']}', '{$_POST['telefone']}', '{$_POST['cidade']}','user','Desabilitado','{$filePdfUser}')";

                // Executa a consulta de inserção
                if ($db->query($insertQuery) === TRUE) {
                    // Envie o e-mail com as informações
                    $mail->send();

                    $msgSucesso = "
                      <div class='container mt-5'>
                            <div class='row justify-content-center align-items-center'>
                                <div class='col-md-8'>
                                    <div class='card text-center'>
                                        <div class='card-body'>
                                            <img src='../Assets/Logo.png' width='200' />
                                            <h2 class='card-title'><i class='fas fa-check-circle'></i> Enviado com Sucesso</h2>
                                            <p class='card-text'>Olá, <strong>" . $_POST['nome'] . "</strong>!</p>
                                            <p class='card-text'>Por favor, verifique sua caixa de entrada de e-mail <strong>" . $_POST['email'] . "</strong>!</p>
                                            <p class='card-text'>Caso não encontre o e-mail, verifique também a pasta de spam ou lixo eletrônico.</p>
                                            <p class='card-text'>Se ainda assim não encontrar, entre em contato conosco: <a href='mailto:ecobumbar2024@gmail.com'>ecobumbar2024@gmail.com</a></p>
                                            <a href='https://mail.google.com' class='btn btn-primary'><i class='far fa-envelope'></i> Abrir Gmail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    ";
                } else {
                    echo "Erro ao cadastrar usuário: " . $db->error;
                }
            }
        } catch (Exception $e) {
            echo "Erro: E-mail não enviado com sucesso. Error PHPMailer: {$mail->ErrorInfo}";
            //echo "Erro: E-mail não enviado com sucesso.<br>";
        };
    };
}



?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Caixa de Entrada</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>

<body>
    <?php

    if (isset($msgSucesso)) {
        echo $msgSucesso;
        exit;
    }

    ?>


</body>

</html>