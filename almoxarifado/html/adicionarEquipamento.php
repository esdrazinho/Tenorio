<?php
session_start();
if(!isset($_SESSION['id_funcionario'])){
    header("Location: entrarNaConta.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Adicionar Equipamento</title>
  <link rel="stylesheet" href="../css/telaPrincipal.css" />
</head>
<body>
  <div class="dashboard">
    <aside class="sidebar">
      <h2 class="logo">Almoxarifado</h2>
      <ul class="menu">
        <li>
          <a href="../php.front/telaeditor.php">Início</a>
        </li>
      </ul>
    </aside>

    <main class="content"> 
        <div class="topbar">
          <h1>Adicionar Equipamento</h1>
        </div>

        <div class="breadcrumbs">
          <span>Equipamentos</span> > <span class="atual">Adicionar Equipamento</span>
        </div>

        <div class="form-container">
          <form class="form-editar" action="../php/adicionar_equipamento.php" method="POST">
            <div class="form-grupo">
              <label>Nome do Equipamento</label>
              <input type="text" name="nome" required />
            </div>

            <div class="form-grupo">
              <label>Quantidade</label>
              <input type="number" name="quantidade" min="1" required />
            </div>

            <div class="form-grupo">
              <label>Marca</label>
              <input type="text" name="fabricante" />
            </div>

            <div class="form-grupo">
              <label>Descrição</label>
              <input type="text" name="descricao" placeholder="Digite uma descrição..." />
            </div>

            <div class="botoes">
              <button type="submit" class="salvar">Salvar Equipamento</button>
              <button type="button" class="cancelar" onclick="window.history.back()">Cancelar</button>
            </div>
          </form>
        </div>
    </main>
  </div>
  </body>
</html>