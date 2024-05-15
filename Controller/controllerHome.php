<?php
require_once '../Model/modelHome.php';


// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    require_once 'teste.php';
    $nome = $_POST['nome'];  
    $email = $_POST['email'];  
    $senha = $_POST['senha'];
    $senhaRepetida = $_POST['senhaRepetida'];
 
    $nomeValido = false;
    $emailValido = false;
    $senhaValida = false;

    // Verifica se o nome foi preenchido e tem menos de 255 caracteres
    if (!empty($_POST["nome"]) && strlen($_POST["nome"]) <= 255) 
    {
        $nomeValido = true;
    }
    else
    {
       
    }



    // Verifica se o email foi preenchido e é válido
    if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
    {
        if (!ConferirEmailBancoDeDados($email)) 
        {
            $emailValido = true;
        }
    }

    // nova senha 

    if ($senha !== null && $senha !== "")
    {
        if($senha == $senhaRepetida)
        {
            if (strlen($senha) >= 8 && strlen($senha) <= 60 &&
            preg_match('/[A-Z]/', $senha) && preg_match('/[a-z]/', $senha) && preg_match('/\d/', $senha)) 
            {
                $senhaValida = true; 
            }
        }
        else
        {
            
        }
    }
    else
    {
        
    }

    // Se todos os campos forem válidos, chama o método criarClinica e carrega a página sistema.html
    if ($nomeValido && $emailValido && $senhaValida) 
    {
        CriarClinica($nome, $email, $senha);
        header("Location: ../View/sistema.html");
        exit;
    }


}
?>