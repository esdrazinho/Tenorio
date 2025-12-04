<?php
session_start();
include 'conexao.php'; 

if (!isset($_SESSION['adm']) || $_SESSION['adm'] != 1) {
    echo "<script>alert('Acesso negado.'); window.history.back();</script>";
    exit;
}

$nome = $_POST['nome'] ?? '';
$cargo = $_POST['cargo'] ?? '';
$re = $_POST['re'] ?? '';

$ehAdmin = 0;
if (isset($_POST['administrador']) && $_POST['administrador'] == 'on') {
    $ehAdmin = 1;
}

$stmt = $conn->prepare("INSERT INTO funcionarios (nome, cargo, re, adm) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $nome, $cargo, $re, $ehAdmin);

if ($stmt->execute()) {
    echo "
    <script>
      alert('Funcionário registrado com sucesso!');
      window.location.href = '../php.front/telaeditor.php?view=funcionarios';
    </script>
    ";
} else {
     echo "
    <script>
      alert('Erro ao registrar funcionário: " . addslashes($conn->error) . "');
      window.history.back();
    </script>
    ";
}

$stmt->close();
$conn->close();
?>