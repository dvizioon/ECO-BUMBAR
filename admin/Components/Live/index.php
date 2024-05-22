<?php
session_start();
include('../../../Connection/index.php');

$conexao = new ConexaoMySQLi();
$db = $conexao->getConexao();


if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['profile'])) {

    unset($_SESSION['email']);
    unset($_SESSION['pass']);
    session_destroy();

    header('Location: ../../../login');
    exit;
}


$queryLive = "SELECT * FROM live";
$resultLive = $db->query($queryLive);

// Verifique se a consulta foi bem-sucedida
if ($resultLive) {
    // Verifique se há linhas retornadas
    if ($resultLive->num_rows > 0) {
        // Itere sobre os resultados
        while ($row = $resultLive->fetch_assoc()) {

            $id_live =  $row['id_live'];
            $live_youtuber = $row['Live_Url_y'];
            $live_googleMeet = $row['Live_Url_m'];
            $assutoMeete = $row['Info_Live'];
            // Faça algo com os dados
            // Por exemplo, você pode acessar os campos assim: $row['nome_do_campo']
        }
    } else {
        // echo "Nenhum resultado encontrado.";
        $queryUpdate = "INSERT INTO live (id_live, Live_Url_y, Live_Url_m, Info_Live) VALUES (1, '', '', '')"; // Substitua '1' pelo ID da linha que você quer atualizar
        $resultado = $db->query($queryUpdate);
        $live_youtuber = "";
        $live_googleMeet = "";
        $assutoMeete = "";
        $id_live = "";
    }
} else {
    echo "Erro ao executar a consulta: " . $db->error;
}

// Lembre-se de fechar a conexão após o uso


// Obter o ID do vídeo
$video_id = substr($live_youtuber, strrpos($live_youtuber, '/') + 1);

// Imprimir o ID do vídeo
// echo $video_id; // Saída: 2USHv8kqNL8
$db->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📹 Transmissão ao vivo | 👥 Presença Online</title>

</head>

<body>
    <h1>📹 Live Eco Bumbar 🔴</h1>


    <?php if ($_SESSION['profile'] === "admin") : ?>
        <!-- Botão de Administração -->
        <button type="button" class="btn btn-primary" style="margin-left: 1rem;" data-bs-toggle="modal" data-bs-target="#adminModal">
            <i class="fas fa-cogs"></i> Administração
        </button>

        <!-- Modal de Administração -->
        <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminModalLabel">Administração</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <button onclick="alterLiver()">
                            Mudar Live
                        </button>

                        <button onclick="alterMeet()">
                            Mudar Link
                        </button>
                        <div class="processForm">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="container mt-2">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="youtube-tab" data-bs-toggle="tab" href="#youtube" role="tab" aria-controls="youtube" aria-selected="true">YouTube</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="googlemeet-tab" data-bs-toggle="tab" href="#googlemeet" role="tab" aria-controls="googlemeet" aria-selected="false">Google Meet</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="youtube" role="tabpanel" aria-labelledby="youtube-tab">
                <!-- Conteúdo do YouTube -->
                <div class="card mt-1">
                    <div class="card-body d-flex w-100 align-items-start">
                        <!-- Div com o vídeo do YouTube -->
                        <div id="youtubeVideo" class="flex-grow-1">
                            <!-- Seu vídeo do YouTube aqui -->
                            <!-- Por exemplo, um iframe ou outro elemento de vídeo -->
                        </div>
                        <!-- Botão para abrir e fechar o div com informações -->

                        <div id="videoInfo">
                            <div class="card-body">
                                <h5>Informações sobre o vídeo:</h5>
                                <ul>
                                    <li><i class="fas fa-user"></i> <?php echo $assutoMeete; ?></li>

                                </ul>
                            </div>

                            <div class="d-flex w-100 align-items-center  justify-content-center">
                                <button type=" button" class="btn " style="background-color: #34d399d3;">Marcar Presença</button>
                            </div>

                        </div>
                    </div>
                    <!-- Div com as informações sobre o vídeo (inicialmente oculta) -->

                </div>


            </div>
            <div class="tab-pane fade" id="googlemeet" role="tabpanel" aria-labelledby="googlemeet-tab">
                <!-- Conteúdo do Google Meet -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div id="googleMeetVideo"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript -->
    <script>
        function carregarVideo(plataforma, containerId) {
            var container = document.getElementById(containerId);

            if (plataforma === "youtube") {
                container.innerHTML = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allowfullscreen></iframe>';
            } else if (plataforma === "googlemeet") {
                container.innerHTML = `
                <div class="card mt-3">
                    <div class="card-body">
                        <div id="googleMeetVideo">
                            <h2>📅 Reunião do Google Meet</h2>
                            <p>A reunião no Google Meet começará em breve. Certifique-se de estar pronto!</p>
                            <p>Link da reunião: <a href="<?php echo $live_googleMeet ?>" target="_blank" style="background-color: #ccc; padding: 5px; border: 1px dashed #000;font-size:1.5rem;"><?php echo $live_googleMeet ?></a></p>
                            <p>Assunto: <?php echo $assutoMeete; ?></p>
                            <p><strong>Participe ativamente e contribua para a discussão!</strong></p>
                        </div>
                    </div>
                </div>
            `;
            }
        }

        carregarVideo('youtube', 'youtubeVideo'); // Carrega o vídeo do YouTube por padrão ao carregar a página
        carregarVideo('googlemeet', 'googleMeetVideo'); // Carrega o vídeo do YouTube por padrão ao carregar a página
    </script>

    <script>
        function alterLiver() {
            $(".processForm").empty();
            // Verifica se já existe um formulário na div
            if ($(".processForm").find("form").length === 0) {
                // Cria o formulário como uma string HTML
                var form = `
                <form action="./admin/Php/alterLive.php" method="POST">
                    <div class="mb-3">
                        <label for="videoName" class="form-label">URL do Novo Vídeo:</label>
                        <input type="text" class="form-control" id="videoName" name="videoName" required>
                        <div>
                            <label>Informe a Descição do Video</label>
                            <br>
                            <br>
                            <textarea name="infoName"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitLive">Alterar Vídeo</button>
                </form>
            `;

                // Adiciona o formulário à div com a classe "processForm"
                $(".processForm").append(form);
            }
        }
    </script>

    <script>
        function alterMeet() {
            // Limpa o conteúdo da div com a classe "processForm"
            $(".processForm").empty();

            // Verifica se já existe um formulário na div
            if ($(".processForm").find("form").length === 0) {
                // Cria o formulário como uma string HTML
                var form = `
                <form action="./admin/Php/alterLive.php" method="POST">
                    <div class="mb-3">
                        <label for="meetName" class="form-label">URL do Novo Meet:</label>
                        <input type="text" class="form-control" id="MeetName" name="MeetName" required>
                        
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitMeet">Alterar Meet</button>
                </form>
            `;

                // Adiciona o formulário à div com a classe "processForm"
                $(".processForm").append(form);
            }
        }
    </script>



</body>

</html>