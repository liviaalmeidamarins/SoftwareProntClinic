// AQUI FICA O JS DA PAGINA DO VISITANTETE
document.getElementById('formCadastro').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio do formulário

    let nome = document.getElementById('nomeCadastro').value.trim();
    let email = document.getElementById('email').value.trim();
    let senha = document.getElementById('senha').value.trim();
    let confirmarSenhaCadastro = document.getElementById('confirmarSenhaCadastro').value.trim();
    let termosAceitos = document.getElementById('agree-form').checked;
    let message = document.getElementById('message');

    message.style.color = 'red';

    // Verifica se todos os campos estão preenchidos
    if (!nome || !email || !senha || !confirmarSenhaCadastro) {
        message.textContent = 'Por favor, preencha todos os campos!';
        return;
    }

    // Verifica se as senhas coincidem
    if (senha !== confirmarSenhaCadastro) {
        message.textContent = 'As senhas não coincidem!';
        return;
    }

    // Verifica se os termos de serviço foram aceitos
    if (!termosAceitos) {
        message.textContent = 'Você deve aceitar os termos de serviço!';
        return;
    }

    // Se todas as verificações passarem
    message.style.color = 'green';
    message.textContent = 'Cadastro realizado com sucesso!';
});




