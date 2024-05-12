 // Abre a modal ao clicar no link "Formulário"
 document.getElementById('openModalBtn').addEventListener('click', function(){
    document.getElementById('myModal').style.display = 'block';
});

// Fecha a modal ao clicar no botão fechar
document.getElementsByClassName('close')[0].addEventListener('click', function(){
    document.getElementById('myModal').style.display = 'none';
});

// Verifica se o CPF foi digitado e mostra os campos de nome e telefone se necessário
document.getElementById('cpf').addEventListener('change', function(){
    if(this.value === '') {
        document.getElementById('notRegistered').style.display = 'block';
    } else {
        document.getElementById('notRegistered').style.display = 'none';
    }
}); 

// modal configurações
document.getElementById('modal3').addEventListener('click', function(){
    document.getElementById('minhamodal3').style.display = 'block';
});

// Fecha a modal ao clicar no botão fechar
document.getElementsByClassName('close')[1].addEventListener('click', function(){
    document.getElementById('minhamodal3').style.display = 'none';
});
