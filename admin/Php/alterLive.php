<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="./Css/style.css" media="all">
    <!-- Inclua os ícones do Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <?php
    include('../../Connection/index.php');

    $conexao = new ConexaoMySQLi();
    $db = $conexao->getConexao();

    if (isset($_POST['submitLive'])) {
        // Processar o formulário
        // Seu código para processar o formulário vai aqui
        // Por exemplo:

        $NovaLive = $_POST['videoName'];

        // Atualize o valor de $live_youtuber com o novo vídeo
        $live_youtuber = $NovaLive;

        $infoName = $_POST['infoName'];

        // Atualize o banco de dados com o novo URL do vídeo
        $queryUpdate = "UPDATE live SET Live_Url_y = '$live_youtuber',Info_Live = '$infoName' WHERE id_live = 1"; // Substitua '1' pelo ID da linha que você quer atualizar
        $resultado = $db->query($queryUpdate);

        if ($resultado) {
            $script = "
                    <div class='container mt-5'>
                        <div class='row'>
                            <div class='col-md-6 offset-md-3 text-center'>
                                <div class='alert alert-info' role='alert'>
                                    <strong>Video Atualizado Com Sucesso " . $NovaLive . "...</strong><br>
                                    Você será redirecionado para o Painel em <span id='countdown'>3</span> segundos.
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        var seconds = 5; // Defina o número de segundos aqui
                        var countdownElement = document.getElementById('countdown');

                        // Função para atualizar o contador
                        function updateCountdown() {
                            countdownElement.textContent = seconds;
                            seconds--;
                            if (seconds < 0) {
                                clearInterval(countdownInterval);
                                window.location.href = '../../painel';
                            }
                        }

                        // Atualiza o contador inicialmente
                        updateCountdown();

                        // Atualiza o contador a cada segundo
                        var countdownInterval = setInterval(updateCountdown, 1000);
                    </script>
                    ";

            echo $script;
        } else {
            echo "Erro ao atualizar URL do vídeo: " . $db->error;
        }

        // Restante do seu código ...
    } else if (isset($_POST['submitMeet'])) {
        // Processar o formulário
        // Seu código para processar o formulário vai aqui
        // Por exemplo:

        $NovaLive = $_POST['MeetName'];

        // Atualize o valor de $live_youtuber com o novo vídeo
        $live_meet = $NovaLive;

        // Remova o caractere "=" do final do URL do Meet
        $live_meet = rtrim($live_meet, '=');

        // Atualize o banco de dados com o novo URL do vídeo
        $queryUpdate = "UPDATE live SET Live_Url_m = '$live_meet' WHERE id_live = 1"; // Substitua '1' pelo ID da linha que você quer atualizar
        $resultado = $db->query($queryUpdate);

        if ($resultado) {
            $script = "
                    <div class='container mt-5'>
                        <div class='row'>
                            <div class='col-md-6 offset-md-3 text-center'>
                                <div class='alert alert-info' role='alert'>
                                    <strong>Link Meet Atualizado Com Sucesso " . $NovaLive . "...</strong><br>
                                    Você será redirecionado para o Painel em <span id='countdown'>3</span> segundos.
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        var seconds = 5; // Defina o número de segundos aqui
                        var countdownElement = document.getElementById('countdown');

                        // Função para atualizar o contador
                        function updateCountdown() {
                            countdownElement.textContent = seconds;
                            seconds--;
                            if (seconds < 0) {
                                clearInterval(countdownInterval);
                                window.location.href = '../../painel';
                            }
                        }

                        // Atualiza o contador inicialmente
                        updateCountdown();

                        // Atualiza o contador a cada segundo
                        var countdownInterval = setInterval(updateCountdown, 1000);
                    </script>
                    ";

            echo $script;
        } else {
            echo "Erro ao atualizar URL do vídeo: " . $db->error;
        }
    }

    ?>
</body>

</html>