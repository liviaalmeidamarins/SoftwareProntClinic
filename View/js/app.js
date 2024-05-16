 // Abre a modal ao clicar no link "Formulário"
 document.getElementById('openModalBtn').addEventListener('click', function(){
    document.getElementById('myModal').style.display = 'block';
});

// Fecha a modal ao clicar no botão fechar
document.getElementsByClassName('close')[0].addEventListener('click', function(){
    document.getElementById('myModal').style.display = 'none';
});

// Verifica se o CPF foi digitado e mostra os campos de nome e telefone se necessário


// modal configurações
document.getElementById('modal3').addEventListener('click', function(){
    document.getElementById('minhamodal3').style.display = 'block';
});

// Fecha a modal ao clicar no botão fechar
document.getElementsByClassName('close')[1].addEventListener('click', function(){
    document.getElementById('minhamodal3').style.display = 'none';
});


// Etapas da modal 1

function mostrarAsQuestoes() {
    // Seleciona os campos dentro da modal
    var campos = document.querySelectorAll(".etapa");
    
    // Itera sobre os campos para verificar se estão escondidos
    campos.forEach(function(campo) {
      // Se o campo está escondido, torna-o visível
      if (campo.style.display === "none") {
        campo.style.display = "block";
      }
    });
  }
  
  

