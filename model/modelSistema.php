<?php

include 'conexao.php';

function criarPaciente($cpf) 
{
    if (conferirExistenciaPaciente($cpf)) 
    {
        echo "Paciente já existe.";
    } 
    else 
    {
        $conecta = conectarBanco();
        if ($conecta) 
        {
            try 
            {
                $texto = "INSERT INTO paciente(pac_cpf) VALUE (:cpf)";
                $stmt = $conecta->prepare($texto);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->execute();
                echo "Paciente criado com sucesso.";
            }
            catch (PDOException $e) 
            {
                echo "Erro ao criar paciente: " . $e->getMessage();
            }
        } 
        else 
        {
            echo "Falha na conexão com o banco de dados.";
        }
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
