<?php


require_once '../Model/modelSistema.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cfp'])) 
{
    // Recebendo os dados do formulário
    $cpf = $_POST['cfp'];

    // Verificando se o CPF tem exatos 11 dígitos (somente números) e se o nome não é nulo e menor que 255 caracteres
    if (preg_match('/^\d{11}$/', $cpf))
    {
        criarPaciente($cpf);
        echo "CPF válido. Processamento concluído.";
    } 
    else 
    {
        // Resposta de exemplo para o AJAX
        echo "CPF inválido ou nome vazio ou maior que 255 caracteres.";
    }
}

?>