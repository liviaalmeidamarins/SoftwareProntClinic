<?php

require_once '../Model/modelSistema.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $tipo = $_POST['tipo'];

    if($tipo === 'CPF_Modal') 
    {
        $cpf = $_POST['cpf'];

        error_log("cpf: " . $cpf);
    
        $cpf = preg_replace('/\D/', '', $cpf);
    
    
        if (preg_match('/^\d{11}$/', $cpf)) 
        {
            if (conferirExistenciaPaciente($cpf)) 
            {
                echo json_encode(["status" => "CPF_existente"]);
                exit;
            } 
            else 
            {
                echo json_encode(["status" => "CPF_nao_encontrado"]);
                exit;
            }
        } 
        else 
        {
            echo json_encode(["status" => "CPF_invalido"]);
        }
        exit;
    }
    else if($tipo === 'Cadastro') 
    {
        $cpf = $_POST['cpf-cadastro'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $convenio = $_POST['convenio'];
        $dataNascimento = $_POST['dataNascimento'];

        if (!empty($nome)) 
        {

            if(strlen($nome) < 255)
            {
                criarPaciente($cpf, $nome, $telefone, $email, $convenio, $dataNascimento);
                echo json_encode(["status" => "Cadastro_feito"]);
                exit;
            }
            else
            {
                echo json_encode(["status" => "Nome_grande"]);
                exit;
            }
        }
        else
        {
            echo json_encode(["status" => "Nome_vazio"]);
            exit;
        }

    }
}

?>