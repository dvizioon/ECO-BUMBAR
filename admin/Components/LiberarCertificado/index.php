<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal com Select - Bootstrap 5</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Habilitar Certificados</h1>
            <button class="btn btn-primary" onclick="openModal()">Abrir Configuração</button>
        </div>
        <div id="certificado" class="alert" role="alert">
            <strong>Status - Certificados:</strong> <span id="status"><?php
                                                                        if (isset($_SESSION['certificado'])) {
                                                                            echo $_SESSION['certificado'];
                                                                        } else {
                                                                            echo "Desabilitado";
                                                                        }

                                                                        ?></span>
        </div>
    </section>



    <?php
    if (isset($_SESSION['usuarioHb'])) {

        echo "<div class='container mt-4'>
        <div class='row'>
            <div class='col-md-8 offset-md-2'>
                <div class='card'>
                    <div class='card-header'>
                        <h3 class='text-center'>Usuário Atualizados</h3>
                    </div>
                    <div class='card-body' style='overflow-y: auto; max-height: 300px;'>";
        echo $_SESSION['usuarioHb'];

        echo "</div>
                </div>
            </div>
        </div>
    </div>";
    }

    ?>

    <!-- Modal -->
    <div class="modal" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deseja Habilitar os Certificados?</h5>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formComponetBTN1">
                        <div class="mb-3">
                            <label for="select" class="form-label">Selecione uma opção:</label>
                            <select id="select" class="form-select" name="configCert">
                                <option value="Desabilitado">Desabilitado</option>
                                <option value="Habilitado">Habilitado</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="confirmSubmit()" name="submit">Enviar <i class="bi bi-check"></i></button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancelar <i class="bi bi-x"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openModal() {
            var modal = document.getElementById('modal');
            modal.classList.add('show');
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeModal() {
            var modal = document.getElementById('modal');
            modal.classList.remove('show');
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        function confirmSubmit() {
            Swal.fire({
                title: 'Você tem certeza?',
                text: 'Deseja enviar o formulário?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, enviar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm();
                }
            });
        }

        function submitForm() {
            var formulario = document.querySelector('#formComponetBTN1');
            formulario.setAttribute('action', './admin/Config/EnableCertificado.php');
            formulario.setAttribute('method', 'POST');

            // Adicionar um atraso de 1 segundo antes de enviar o formulário
            setTimeout(function() {
                formulario.submit();
                // Aquí puedes agregar la lógica para enviar el formulario
                closeModal(); // Cerrar el modal después de enviar el formulario
            }, 1000); // 1000 milissegundos = 1 segundo
        }
    </script>
</body>

</html>