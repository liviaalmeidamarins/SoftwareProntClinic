<?php
include 'conexao.php';

function CriarClinica($nome, $email, $senha) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            // Criptografa a senha antes de armazená-la no banco de dados
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
            
            $texto = "INSERT INTO clinica(Cli_nome, Cli_email, Cli_senha) VALUES (:nome, :email, :senha)";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senhaCriptografada);
            $stmt->execute();
            SalvarClinicanaSessao($email);
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

function Login($email, $senha) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $texto = "SELECT Cli_senha FROM clinica WHERE Cli_email = :email";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($resultado && password_verify($senha, $resultado['Cli_senha'])) 
            {
                echo "Login realizado com sucesso.";
                SalvarClinicanaSessao($email);
            } 
            else 
            {
                echo "Email ou senha incorretos.";
            }
        } 
        catch (PDOException $e) 
        {
            echo "Erro ao realizar login: " . $e->getMessage();
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

function SalvarClinicanaSessao($email)
{

    $conecta = conectarBanco();

    if ($conecta) {
        try {
            // Preparando a consulta SQL
            $sql = "SELECT id_clinica, Cli_nome FROM Clinica WHERE cli_email = :email";
            $stmt = $conecta->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Executando a consulta
            $stmt->execute();

            // Verificando se algum registro foi encontrado
            if ($stmt->rowCount() > 0) {
                // Obtendo os dados
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_clinica = $row["id_clinica"];
                    $cli_nome = $row["Cli_nome"];

                    // Salvando os dados na sessão
                    session_start();
                    $_SESSION['id_clinica'] = $id_clinica;
                    $_SESSION['Cli_nome'] = $cli_nome;

                    echo "ID da Clínica: " . $id_clinica . " - Nome da Clínica: " . $cli_nome . "<br>";
                }
            } else {
                echo "Nenhuma clínica encontrada com este email.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Falha na conexão com o banco de dados.";
    }
}

?>


