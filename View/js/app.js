 // Abre a modal ao clicar no link "Formulário"
 document.getElementById('openModalBtn').addEventListener('click', function(){
    document.getElementById('myModal').style.display = 'block';
});

// Fecha a modal ao clicar no botão fechar
document.getElementsByClassName('close')[0].addEventListener('click', function(){
    document.getElementById('myModal').style.display = 'none';
});


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
  
// Função para remover a classe 'clicked' de todos os ícones
function clearClickedClass() {
    const icons = document.querySelectorAll('.icon');
    icons.forEach(icon => icon.classList.remove('clicked'));
}

// Função para definir o primeiro ícone como verde por padrão
function setDefaultIcon() {
    const firstIcon = document.querySelector('#homeIcon');
    firstIcon.classList.add('default');
}

// Defina o primeiro ícone como verde ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    setDefaultIcon();
});

// Adiciona eventos de clique a cada ícone
document.querySelectorAll('.icon').forEach(icon => {
    icon.addEventListener('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do link
        clearClickedClass();
        this.classList.add('clicked');
        // Remove a classe 'default' de todos os ícones
        document.querySelectorAll('.icon').forEach(icon => icon.classList.remove('default'));
    });
});

