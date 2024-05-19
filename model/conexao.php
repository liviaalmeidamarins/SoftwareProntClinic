<?php

function conectarBanco()
{
    $host = '127.0.0.1';
    $port = '3307';
    $dbname = 'prontclinic';
    $usuario = 'root';
    $senha = '';

    try 
    {
        $conecta = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $usuario, $senha);
        $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conecta;
    } 
    catch (PDOException $e) 
    {
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        return null;
    }
}

?>
