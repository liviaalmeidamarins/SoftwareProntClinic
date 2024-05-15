<?php
include 'conexao.php';




function CriarClinica($nome, $email, $senha) 
{

    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $texto = "INSERT INTO clinica(Cli_nome, Cli_email, Cli_senha) VALUES (:nome, :email, :senha)";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
            echo "clinica criada com sucesso.";
        } 
        catch (PDOException $e) 
        {
            echo "Erro ao criar clinica: " . $e->getMessage();
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
    }
    
}

function ConferirEmailBancoDeDados($email)
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try {
            $consulta = $conecta->prepare("SELECT * FROM clinica WHERE Cli_email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            if ($consulta->rowCount() > 0) 
            {
                echo "E-mail encontrado.";
                return true;
            } 
            else
            {
                echo "E-mail não encontrado.";
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