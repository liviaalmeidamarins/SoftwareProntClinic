// LOGIN JS
function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const icon = document.querySelector('.toggle-password i');
    const passwordFieldType = passwordField.getAttribute('type');
    
    if (passwordFieldType === 'password') {
        passwordField.setAttribute('type', 'text');
        icon.classList.remove('fa-eye-slash');//olho fechado
        icon.classList.add('fa-eye');//olho aberto
    } else {
        passwordField.setAttribute('type', 'password');
        icon.classList.remove('fa-eye');//olho aberto
        icon.classList.add('fa-eye-slash');//olho fechado
    }
}

//AJAX

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    
    // Recupera os dados do formulário
    const formData = new FormData(this);

    // Envia os dados do formulário para o backend via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php'); // URL do script PHP de login
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Se a resposta for bem-sucedida, verifica se o login foi bem-sucedido
            if (xhr.responseText.trim() === 'success') {
                // Redireciona para a nova página
                window.location.href = '../View/sistema.html'; // Substitua pela URL da nova página
            } else {
                // Se o login falhar, exibe uma mensagem de erro
                alert('Login falhou. Por favor, verifique suas credenciais.');
            }
        } else {
            // Se a requisição falhar, exibe uma mensagem de erro
            alert('Erro ao enviar solicitação. Por favor, tente novamente mais tarde.');
        }
    };
    xhr.onerror = function() {
        // Se houver um erro de rede, exibe uma mensagem de erro
        alert('Erro de rede. Por favor, verifique sua conexão com a internet.');
    };
    xhr.send(formData);
});



