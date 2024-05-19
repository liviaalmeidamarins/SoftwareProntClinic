<?php
require_once '../Model/modelHome.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];  
    $email = $_POST['email'];  
    $senha = $_POST['senha'];
    $senhaRepetida = $_POST['senhaRepetida'];
 
    
    $nomeValido = false;
    $emailValido = false;
    $senhaValida = false;

    // Validação do nome
    if (!empty($nome) && strlen($nome) <= 255) 
    {
        $nomeValido = true;
    } 
    else 
    {
       
    }

    // Validação do email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!ConferirEmailBancoDeDados($email)) {
            $emailValido = true;
        } else {
            
        }
    } else {
        
    }

    // Validação da senha
    if ($senha !== null && $senha !== "") 
    {
        if ($senha == $senhaRepetida) 
        {
            if (strlen($senha) >= 8 && strlen($senha) <= 60 &&
                preg_match('/[A-Z]/', $senha) && preg_match('/[a-z]/', $senha) && preg_match('/\d/', $senha)) 
            {
                $senhaValida = true; 
            }
            else 
            {
              
            }
        } 
        else 
        {
           
        }
    }
    else 
    {
       
    }

    if ($nomeValido && $emailValido && $senhaValida) 
    {
        CriarClinica($nome, $email, $senha);
        header("Location: ../View/sistema.html");
        exit();
    }
} 
else 
{

}

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o login foi bem-sucedido
    if (login($email, $senha)) {
        header("Location: ../View/sistema.html");
        exit();
    } else {
        echo 'error';
    }
}

/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (Login($email, $senha)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo 'error';
}
*/
?>