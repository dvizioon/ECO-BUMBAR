<body>


    <style>
        body {
            background-color: #f0f0f0;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            animation: fadeIn 1s ease-in-out;
        }

        .card-header {
            background-color: #25D366;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }

        .card-title {
            margin-bottom: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .card-body {
            padding: 30px;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 20px;
            color: #25D366;
        }

        .line {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        .about-me {
            font-size: 16px;
            line-height: 1.6;
        }

        @media (max-width: 767px) {
            .icon {
                font-size: 36px;
            }

            .card-body {
                padding: 20px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Sobre Nossa Empresa</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="icon"><i class="fas fa-laptop"></i></div>
                        <h6>Área de Atuação:</h6>
                        <p>Tecnologia da Informação</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="icon"><i class="fas fa-code"></i></div>
                        <h6>Habilidades:</h6>
                        <p>Desenvolvimento Web, Programação, Gerenciamento de Dados</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="icon"><i class="fas fa-lightbulb"></i></div>
                        <h6>Missão:</h6>
                        <p>Transformar ideias em soluções digitais inovadoras para um mundo mais conectado.</p>
                    </div>
                </div>
                <div class="line"></div>
                <div class="row">
                    <div class="col-md-12">
                        <h6>Sobre a Nossa Empresa:</h6>
                        <p>Somos uma empresa líder em tecnologia, especializada em fornecer soluções digitais personalizadas para empresas de todos os tamanhos. Nosso objetivo é impulsionar o sucesso de nossos clientes através da inovação e da excelência em serviços. Com uma equipe altamente qualificada e uma abordagem centrada no cliente, estamos comprometidos em superar as expectativas e criar valor duradouro.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>