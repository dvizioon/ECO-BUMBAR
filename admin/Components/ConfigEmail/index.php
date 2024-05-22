<?php
$host = $username = $password = $smtpSecure = $port = '';
$errors = [];

// Carregar os dados do arquivo Server.ini, se existir
$iniFile = "../../../Config/Server.ini";
if (file_exists($iniFile)) {
    $config = parse_ini_file($iniFile);
    $host = $config['Host'] ?? '';
    $username = $config['Username'] ?? '';
    $password = $config['Password'] ?? '';
    $smtpSecure = $config['SMTPSecure'] ?? '';
    $port = $config['Port'] ?? '';
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações de Email</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #25D366;
            color: #fff;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .card-title {
            margin-bottom: 0;
        }

        .card-body {
            padding: 30px;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .icon i {
            color: #25D366;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn {
            background-color: #25D366;
            color: white;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Configurações de Email</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="./admin/Components/ConfigEmail/configSMTP.php" method="POST">
                    <div class="form-group">
                        <label for="host">Host</label>
                        <input type="text" class="form-control" id="host" name="host" value="<?php echo htmlspecialchars($host); ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                    </div>
                    <div class="form-group">
                        <label for="smtpSecure">SMTP Secure</label>
                        <input type="text" class="form-control" id="smtpSecure" name="smtpSecure" value="<?php echo htmlspecialchars($smtpSecure); ?>">
                    </div>
                    <div class="form-group">
                        <label for="port">Port</label>
                        <input type="text" class="form-control" id="port" name="port" value="<?php echo htmlspecialchars($port); ?>">
                    </div>
                    <button type="submit" class="btn">Salvar Configurações</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>