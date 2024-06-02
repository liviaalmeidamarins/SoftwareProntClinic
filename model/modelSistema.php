<?php

include 'conexao.php';

function criarPaciente($cpf, $nome, $telefone, $email, $convenio, $dataNascimento) {
    $conecta = conectarBanco();
    if ($conecta) {
        try {
            session_start(); // Iniciar a sessão para acessar as variáveis de sessão
            $idClinica = $_SESSION['id_clinica']; // Recuperar o ID da clínica da sessão
            
            // Definir o fuso horário para o horário de Brasília
            date_default_timezone_set('America/Sao_Paulo');
            
            // Obter a data e hora atual no formato 'Y-m-d H:i:s'
            $dataAtualizacao = date('Y-m-d H:i:s');

            $texto = "INSERT INTO paciente(id_clinica, pac_cpf, pac_nome, pac_telefone, pac_email, pac_convenio, pac_nascimento, pac_atualizacao) 
                      VALUES (:idClinica, :cpf, :nome, :telefone, :email, :convenio, :dataNascimento, :dataAtualizacao)";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':idClinica', $idClinica);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':convenio', $convenio);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':dataAtualizacao', $dataAtualizacao);
            $stmt->execute();
            //echo "Paciente criado com sucesso.";
        } catch (PDOException $e) {
            //echo "Erro ao criar paciente: " . $e->getMessage();
        }
    } else {
       // echo "Falha na conexão com o banco de dados.";
    }
}


function conferirExistenciaPaciente($cpf)
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try {
            $consulta = $conecta->prepare("SELECT * FROM paciente WHERE pac_cpf = :cpf");
            $consulta->bindParam(':cpf', $cpf);
            $consulta->execute();
            if ($consulta->rowCount() > 0) 
            {
                echo "Paciente encontrado.";
                return true;
            } 
            else
            {
                echo "Paciente não encontrado.";
                return false;
            }
        } 
        catch (PDOException $e) 
        {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
        return false;
    }
}

?>
