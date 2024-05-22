<?php
session_start();
include('../../../Connection/index.php');

$conexao = new ConexaoMySQLi();
$db = $conexao->getConexao();

// Verificar a conexão
if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

// Consultar número de usuários por estado
$sql_usuarios_por_estado = "SELECT EstadoCert, COUNT(*) as total FROM usuarios GROUP BY EstadoCert";
$resultado_usuarios_por_estado = $db->query($sql_usuarios_por_estado);

$usuariosPorEstado = [];
while ($row = $resultado_usuarios_por_estado->fetch_assoc()) {
    $usuariosPorEstado[] = [$row['EstadoCert'], (int)$row['total']];
}

// Consultar estados mais ativos (número de usuários por estado)
$sql_estados_ativos = "SELECT EstadoCert, COUNT(*) as total FROM usuarios GROUP BY EstadoCert ORDER BY total DESC";
$resultado_estados_ativos = $db->query($sql_estados_ativos);

$estadosAtivos = [];
while ($row = $resultado_estados_ativos->fetch_assoc()) {
    $estadosAtivos[] = [$row['EstadoCert'], (int)$row['total']];
}

// Consultar quantidade de certificados habilitados
$sql_certificados = "SELECT Certificado, COUNT(*) as total FROM usuarios WHERE Certificado != '' GROUP BY Certificado";
$resultado_certificados = $db->query($sql_certificados);

$certificados = [];
while ($row = $resultado_certificados->fetch_assoc()) {
    $certificados[] = [$row['Certificado'], (int)$row['total']];
}

// Consultar cidades mais ativas (número de usuários por cidade)
$sql_cidades_ativas = "SELECT Cidade, COUNT(*) as total FROM usuarios GROUP BY Cidade ORDER BY total DESC";
$resultado_cidades_ativas = $db->query($sql_cidades_ativas);

$cidadesAtivas = [];
while ($row = $resultado_cidades_ativas->fetch_assoc()) {
    $cidadesAtivas[] = [$row['Cidade'], (int)$row['total']];
}

// Converter dados para JSON
$usuariosPorEstadoJson = json_encode($usuariosPorEstado);
$estadosAtivosJson = json_encode($estadosAtivos);
$certificadosJson = json_encode($certificados);
$cidadesAtivasJson = json_encode($cidadesAtivas);
?>

<body>

    <style>
        .chart-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            overflow: hidden;
            overflow-y: scroll;
            height: 89vh;
            padding: 1rem;
        }

        .chart-box {
            flex: 0 0 40%;
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="chart-container">
        <div id="usuariosPorEstado" class="chart-box" style="height: 500px;"></div>
        <div id="estadosAtivos" class="chart-box" style="height: 500px;"></div>
        <div id="certificadosHabilitados" class="chart-box" style="height: 500px;"></div>
        <div id="cidadesAtivas" class="chart-box" style="height: 500px;"></div>
    </div>
    <script>
        $(document).ready(function() {
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawCharts);

            function drawCharts() {
                drawUsuariosPorEstado();
                drawEstadosAtivos();
                drawCertificadosHabilitados();
                drawCidadesAtivas();
            }

            function drawUsuariosPorEstado() {
                var data = google.visualization.arrayToDataTable([
                    ['Estado', 'Quantidade'],
                    ...<?php echo $usuariosPorEstadoJson; ?>
                ]);

                var options = {
                    title: 'Número de Usuários por Estado',
                    width: '100%',
                    height: '100%',
                    pieHole: 0.4,
                    colors: ['#76C7C0', '#4CAF50', '#81C784', '#A5D6A7', '#C8E6C9'],
                    backgroundColor: '#E8F5E9',
                    legend: {
                        textStyle: {
                            color: '#388E3C'
                        }
                    },
                    titleTextStyle: {
                        color: '#388E3C'
                    }
                };

                var chart = new google.visualization.PieChart(document.getElementById('usuariosPorEstado'));
                chart.draw(data, options);
            }

            function drawEstadosAtivos() {
                var data = google.visualization.arrayToDataTable([
                    ['Estado', 'Quantidade'],
                    ...<?php echo $estadosAtivosJson; ?>
                ]);

                var options = {
                    title: 'Estados Mais Ativos',
                    width: '100%',
                    height: '100%',
                    legend: {
                        position: 'none'
                    },
                    bar: {
                        groupWidth: '50%'
                    },
                    colors: ['#4CAF50'],
                    backgroundColor: '#E8F5E9',
                    titleTextStyle: {
                        color: '#388E3C'
                    },
                    hAxis: {
                        textStyle: {
                            color: '#388E3C'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#388E3C'
                        }
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('estadosAtivos'));
                chart.draw(data, options);
            }

            function drawCertificadosHabilitados() {
                var data = google.visualization.arrayToDataTable([
                    ['Certificado', 'Quantidade'],
                    ...<?php echo $certificadosJson; ?>
                ]);

                var options = {
                    title: 'Quantidade de Certificados Habilitados',
                    width: '100%',
                    height: '100%',
                    pieHole: 0.4,
                    colors: ['#76C7C0', '#4CAF50', '#81C784', '#A5D6A7', '#C8E6C9'],
                    backgroundColor: '#E8F5E9',
                    legend: {
                        textStyle: {
                            color: '#388E3C'
                        }
                    },
                    titleTextStyle: {
                        color: '#388E3C'
                    }
                };

                var chart = new google.visualization.PieChart(document.getElementById('certificadosHabilitados'));
                chart.draw(data, options);
            }

            function drawCidadesAtivas() {
                var data = google.visualization.arrayToDataTable([
                    ['Cidade', 'Quantidade'],
                    ...<?php echo $cidadesAtivasJson; ?>
                ]);

                var options = {
                    title: 'Cidades Mais Ativas',
                    width: '100%',
                    height: '100%',
                    colors: ['#4CAF50'],
                    backgroundColor: '#E8F5E9',
                    titleTextStyle: {
                        color: '#388E3C'
                    },
                    hAxis: {
                        textStyle: {
                            color: '#388E3C'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#388E3C'
                        }
                    },
                    bar: {
                        groupWidth: '50%'
                    }
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('cidadesAtivas'));
                chart.draw(data, options);
            }
        });
    </script>
</body>