<?php
require_once '../model/modelHome.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // For debugging purposes, log the received values
    error_log("Email: " . $email);
    error_log("Senha: " . $senha);

    $erros = [];

    // Validar email
    if (empty($email)) {
        $erros['email'] = "Email não pode ser vazio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = "Email inválido.";
    }

    // Validar senha
    if (empty($senha)) {
        $erros['senha'] = "Senha não pode ser vazia.";
    }

    if (empty($erros) && Login($email, $senha)) {
        echo json_encode(["status" => "login_aceito"]);
    } else {
        if (empty($erros)) {
            $erros['login'] = "Email ou senha incorretos.";
        }
        echo json_encode(["status" => "login_nao_aceito", "erros" => $erros]);
    }
    exit;
}
?>
