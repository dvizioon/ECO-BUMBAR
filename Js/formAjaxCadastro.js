$(document).ready(function () {

    $('#SignUpForm button').prop('disabled', true);

    $('#telefone').on('blur', function () {
        var telefone = $(this).val().replace(/[^\d]/g, ''); // Remove todos os caracteres não numéricos
        if (telefone.length === 11) {
            var ddd = telefone.slice(0, 2);
            var numero = telefone.slice(2);
            var numeroFormatado = '(' + ddd + ') ' + numero.slice(0, 5) + '-' + numero.slice(5);
            $(this).val(numeroFormatado);
        } else {
            // Se o número de telefone não estiver completo, deixe-o como está
            $(this).val(telefone);
        }
    });



    $('#cep').on('input', function () {
        var cep = $(this).val().replace(/[^\d]/g, ''); // Remove todos os caracteres não numéricos
        $(this).val(cep); // Atualiza o valor do campo de CEP

        if (cep.length === 8) {
            // Quando o CEP tiver 6 dígitos, exibe um alerta para o usuário
            // $(this).val()
            var validacep = /^[0-9]{8}$/;

            // Valida o formato do CEP.
            if (validacep.test(cep)) {
                // Consulta o webservice viacep.com.br.
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
                    if (!("erro" in dados)) {
                        // Exibe os dados do CEP em um alerta.
                        // var mensagem = "CEP: " + cep + "\n"
                        //     + "Logradouro: " + dados.logradouro + "\n"
                        //     + "Bairro: " + dados.bairro + "\n"
                        //     + "Cidade: " + dados.localidade + "\n"
                        //     + "UF: " + dados.uf + "\n"
                        //     + "IBGE: " + dados.ibge;
                        // alert(mensagem);

                        // Exibe mensagem de busca iniciada
                        Swal.fire({
                            title: "Buscando CEP...",
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                // Consulta o webservice viacep.com.br.
                                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
                                    if (!("erro" in dados)) {
                                        // Exibe os dados do CEP em um alerta.
                                        // var mensagem = "CEP: " + cep + "\n"
                                        //     + "Logradouro: " + dados.logradouro + "\n"
                                        //     + "Bairro: " + dados.bairro + "\n"
                                        //     + "Cidade: " + dados.localidade + "\n"
                                        //     + "UF: " + dados.uf + "\n"
                                        //     + "IBGE: " + dados.ibge;
                                        // alert(mensagem);




                                        var mensagem = `
                                       <div class="container">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Informações do Endereço</h5>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                        <input type="text" class="form-control" placeholder="CEP" value="${cep}" disabled>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fas fa-road"></i></span>
                                                        <input type="text" class="form-control" placeholder="Logradouro" value="${dados.logradouro}" disabled>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                                                        <input type="text" class="form-control" placeholder="Bairro" value="${dados.bairro}" disabled>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                        <input type="text" class="form-control" placeholder="Cidade" value="${dados.localidade}" disabled>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    `;

                                        $("#cidade").val(dados.localidade)


                                        Swal.fire({

                                            title: "Informações do Endereço",
                                            html: mensagem,
                                            icon: "success",
                                            showCloseButton: true,
                                            timer: 4000 // Tempo em milissegundos (2 segundos)
                                        });

                                        $('#SignUpForm button').prop('disabled', false);


                                    } else {
                                        // CEP pesquisado não foi encontrado.
                                        $('#SignUpForm button').prop('disabled', true);

                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "O Cep Digitado é inválido ou Está Errado",
                                            footer: '<a href="#">Precisa de ajuda?</a>'
                                        });

                                    }
                                }).fail(function () {
                                    // Falha na consulta ao webservice.
                                    alert("Erro ao consultar o CEP.");
                                });
                            }
                        });

                    } else {
                        // CEP pesquisado não foi encontrado.
                        // alert("CEP não encontrado.");
                        $('#SignUpForm button').prop('disabled', true);

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "O Cep Digitado é inválido ou Está Errado",
                            footer: '<a href="#">Precisa de ajuda?</a>'
                        });

                    }
                }).fail(function () {
                    // Falha na consulta ao webservice.
                    alert("Erro ao consultar o CEP.");
                });
            } else {
                // CEP é inválido.
                alert("Formato de CEP inválido.");
            }
        } else {
            // CEP sem valor, limpa formulário.
            $("#rua, #bairro, #cidade, #uf, #ibge").val("");
        }

    });

    $('#SignUpForm button').on('click', function (e) {
        e.preventDefault();

        // Remover todas as mensagens de erro existentes
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        var nome = $('#nome').val();
        var email = $('#email').val();
        var cpf = $('#cpf').val();
        var telefone = $('#telefone').val();
        var cep = $('#cep').val();
        var isValid = true;

        // Validar Nome
        if (nome === '') {
            $('#nome').addClass('is-invalid');
            $('#nome').after('<div class="invalid-feedback">Por favor, digite seu nome.</div>');
            isValid = false;
        } else {
            $('#nome').addClass('is-valid');
        }

        // Validar E-mail
        if (email === '') {
            $('#email').addClass('is-invalid');
            $('#email').after('<div class="invalid-feedback">Por favor, digite seu e-mail.</div>');
            isValid = false;
        } else if (!email.includes('@') || email.split('@')[0].length < 6) {
            $('#email').addClass('is-invalid');
            $('#email').after('<div class="invalid-feedback">Por favor, digite um e-mail válido.</div>');
            isValid = false;
        } else {
            $('#email').addClass('is-valid');
        }

        // Validar CPF
        var cpfRegex = /^\d{11}$/;
        if (!cpfRegex.test(cpf)) {
            $('#cpf').addClass('is-invalid');
            $('#cpf').after('<div class="invalid-feedback">Por favor, digite um CPF válido (11 números ex:11100011100).</div>');
            isValid = false;
        } else {
            $('#cpf').addClass('is-valid');
        }

        // Validar Telefone
        var telefoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
        if (!telefoneRegex.test(telefone)) {
            $('#telefone').addClass('is-invalid');
            $('#telefone').after('<div class="invalid-feedback">Por favor, digite um telefone válido (ex: (99) 99999-9999).</div>');
            isValid = false;
        } else {
            $('#telefone').addClass('is-valid');
        }

        // Validar CEP
        // Aqui você pode adicionar sua lógica de validação para o CEP
        if (cep.length !== 8) {
            $('#cep').addClass('is-invalid');
            $('#cep').after('<div class="invalid-feedback">Por favor, digite um CEP válido (8 números).</div>');
            isValid = false;
        } else {
            $('#cep').addClass('is-valid');
        }


        // Se todos os campos forem válidos, você pode enviar o formulário
        if (isValid) {
            // Aqui você pode enviar o formulário

            $('#SignUpForm').attr('method', 'POST');
            $('#SignUpForm').attr('action', './Validation/validationUser.php');

            let timerInterval;
            Swal.fire({
                title: "Redirecionando...",
                html: "Aguarde enquanto processamos seus Dados",
                timer: 2000,
                timerProgressBar: true,
                allowOutsideClick: false, // Impede que o Swal seja fechado clicando fora dele
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    document.getElementById('SignUpForm').submit();
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });



        }

    });
});
