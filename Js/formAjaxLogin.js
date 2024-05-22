$(document).ready(function () {
    $('#loginForm button').on('click', function (e) {
        e.preventDefault();

        var email = $('#emailLogin');
        var password = $('#passwordLogin');

        // Remover classes e mensagens de erro existentes
        $('.form-control').removeClass('is-invalid is-valid');
        $('.invalid-feedback, .valid-feedback').remove();

        if (email.val().trim() === '') {
            email.addClass('is-invalid');
            email.after('<div class="invalid-feedback">O email é obrigatório.</div>');
            return false;
        }

        if (password.val().length < 8) {
            password.addClass('is-invalid');
            password.after('<div class="invalid-feedback">A senha deve ter pelo menos 8 caracteres.</div>');
            return false;
        }

        // Se todas as validações passarem, adicionar a classe 'is-valid' e a borda verde
        email.addClass('is-valid');
        password.addClass('is-valid');

        $('#loginForm').attr('method', 'POST');
        $('#loginForm').attr('action', './Validation/validationLogin.php');


        // Cria o elemento de carregamento
        var loadingElement = document.createElement('div');
        loadingElement.id = 'loading';
        loadingElement.style.display = 'none';
        loadingElement.style.position = 'fixed';
        loadingElement.style.zIndex = '1000';
        loadingElement.style.top = '0';
        loadingElement.style.left = '0';
        loadingElement.style.height = '100%';
        loadingElement.style.width = '100%';
        loadingElement.style.background = 'rgba(0, 0, 0, 0.5)';

        // Cria o ícone de banana
        var bananaIcon = document.createElement('div');
        bananaIcon.id = 'banana-icon';
        bananaIcon.style.position = 'absolute';
        bananaIcon.style.top = '50%';
        bananaIcon.style.left = '50%';
        bananaIcon.style.transform = 'translate(-50%, -50%)';
        bananaIcon.style.fontSize = '50px'; // Torna a banana maior
        bananaIcon.textContent = '🌎';

        // Adiciona o ícone de banana ao elemento de carregamento
        loadingElement.appendChild(bananaIcon);

        // Adiciona o elemento de carregamento ao body
        document.body.appendChild(loadingElement);

        // Exibe o elemento de carregamento
        loadingElement.style.display = 'block';

        // Faz a banana girar
        var degree = 0;
        var rotation = setInterval(function () {
            bananaIcon.style.transform = 'translate(-50%, -50%) rotate(' + degree + 'deg)';
            degree = (degree + 10) % 360;
        }, 21);

        // Enviar o formulário após 2 segundos
        setTimeout(function () {
            clearInterval(rotation); // Para a rotação
            document.getElementById('loginForm').submit();
            loadingElement.remove();
        }, 2000);

    });
});
