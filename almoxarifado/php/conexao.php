<?php

$nome = "sql308.infinityfree.com";              
$usuario = "if0_40601656";                      
$senha = "Junioj47";           
$banco = "if0_40601656_almoxarifado_utilidades"; 

$conn = new mysqli($nome, $usuario, $senha, $banco);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    
    die("Erro de conexão com o banco de dados."); 
}
?>