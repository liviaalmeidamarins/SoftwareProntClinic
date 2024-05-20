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





