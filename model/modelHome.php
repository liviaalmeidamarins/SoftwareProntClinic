<?php
include 'conexao.php';

function CriarClinica($nome, $email, $senha) 
{
    $senha = password_hash($senha, PASSWORD_DEFAULT);
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

function login($email, $senha)
{

    //$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    //login($email, $senha);

    if( ConferirEmailBancoDeDados($email))
    {
        $conecta = conectarBanco();
        if ($conecta) 
        {
            try{
                $sql = "SELECT * FROM clinica WHERE Cli_email = :email";
                $stm = $conecta->prepare($sql);
                $stm->bindParam(':email', $email, PDO::PARAM_STR); // tipo do parâmetro é String
                $stm->execute();
                $resultado = $stm->fetch(PDO::FETCH_ASSOC);
                
                if($resultado && password_verify($senha, $resultado['Cli_senha'])){
                    echo "Login Aceito, seja bem vindo";
                }
                else
                {
                    echo "Erro no login";
                }
            }
            catch(PDOException $erro){
                echo "{$erro}";
            }
        } 
        else 
        {
            echo "Falha na conexão com o banco de dados.";
        }
    }
    else
    {
        echo "Email não encontrado.";
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