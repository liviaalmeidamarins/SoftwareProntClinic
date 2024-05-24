<?php 
require_once '../model/modelHome.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];  
    $email = $_POST['email'];  
    $senha = $_POST['senha'];
    $senhaRepetida = $_POST['senhaRepetida'];

    error_log("nome: " . $nome);
    error_log("email: " . $email);
    error_log("senha: " . $senha);
    error_log("senhaRepetida: " . $senhaRepetida);

    $erros = [];

    // Verifica se o nome foi preenchido e tem menos de 255 caracteres
    if (empty($nome) || strlen($nome) > 255) {
        $erros['nome'] = "Nome deve ser preenchido e ter no máximo 255 caracteres.";
    }

    // Verifica se o email foi preenchido e é válido
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = "Email inválido.";
    } elseif (ConferirEmailBancoDeDados($email)) {
        $erros['email'] = "Email já cadastrado.";
    }

    // Verifica se as senhas foram preenchidas e são válidas
    if (empty($senha)) {
        $erros['senha'] = "Senha não pode ser vazia.";
    } elseif ($senha !== $senhaRepetida) {
        $erros['senhaRepetida'] = "As senhas não coincidem.";
    } elseif (strlen($senha) < 8 || strlen($senha) > 60 ||
        !preg_match('/[A-Z]/', $senha) || !preg_match('/[a-z]/', $senha) || !preg_match('/\d/', $senha)) {
        $erros['senha'] = "Senha deve ter entre 8 e 60 caracteres, incluindo uma letra maiúscula, uma minúscula e um número.";
    }

    // Se não houver erros, cria a clínica
    if (empty($erros)) {
        echo json_encode(["status" => "cadastro_aceito"]);
        CriarClinica($nome, $email, $senha);
        exit;
    } else {
        echo json_encode(["status" => "erro", "erros" => $erros]);
        exit;
    }
}
?>
