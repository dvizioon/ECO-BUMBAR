<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convite para Grupo do WhatsApp</title>
    <!-- Bootstrap CSS -->

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .whatsapp {
            background-color: #25D366;
        }

        .progress-bar-whatsapp {
            background-color: #25D366;
            /* Cor do logotipo do WhatsApp */
        }

        .progress-bar-instagram {
            background-color: #E4405F;
            /* Cor do logotipo do Instagram */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header whatsapp text-white">
                        <h4>Convite Eco Bumbar WhatsApp</h4>
                    </div>
                    <div style="display:flex;justify-content:center;">
                        <img style="width: 40%;" src="Assets/Logo.png" alt="Logo.png">
                    </div>
                    <div class="card-body">
                        <p>Olá! Seja bem-vindo ao nosso grupo do WhatsApp do Eco Bumbar. Estamos felizes em tê-lo conosco.</p>
                        <p>Por favor, leia e siga as regras do grupo abaixo:</p>
                        <ul>
                            <li><i class="fa fa-check-circle text-success"></i> Respeite todos os membros do grupo. 😊</li>
                            <li><i class="fa fa-check-circle text-success"></i> Evite enviar mensagens fora do contexto do grupo. 📝</li>
                            <li><i class="fa fa-check-circle text-success"></i> Não compartilhe conteúdo impróprio. 🚫</li>
                        </ul>
                        <a href="javascript:void(0)" class="btn btn-success mt-3" id="joinWhatsapp" onclick="startProgress()"><i class="fa fa-whatsapp"></i> Entrar no Grupo do WhatsApp</a>
                        <div class="progress mt-3">
                            <div id="progressBar" class="progress-bar-whatsapp" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function startProgress() {
            var progressBar = document.getElementById("progressBar");
            var width = 1;
            var interval = setInterval(function() {
                if (width >= 100) {
                    clearInterval(interval);
                    // Quando a barra atingir 100%, redirecione para o grupo do WhatsApp
                    window.location.href = "https://chat.whatsapp.com/CMRvWjQUVjnI5wyC418ACh";
                } else {
                    width++;
                    progressBar.style.width = width + "%";
                }
            }, 10); // Ajuste a velocidade da barra de progresso aqui
        }
    </script>
</body>

</html>