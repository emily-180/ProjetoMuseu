<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Museu IFSULDEMINAS</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/ProjetoMuseu/static/css/main.css">

  <?php if(isset($pagina_css)): ?>
    <link rel="stylesheet" href="/ProjetoMuseu/static/css/<?php echo $pagina_css; ?>">
  <?php endif; ?>
</head>
<body>

  <header class="custom-header">
    <div class="container py-4">
      <div class="row align-items-center text-center text-md-start">
        <div class="col-12 col-md-2 mb-3 mb-md-0">
          <img src="/ProjetoMuseu/static/imagens/logo.png" alt="Logo do Museu" class="logo-museu img-fluid">
        </div>
        <div class="col-12 col-md-10">
          <h1 class="nome-museu mb-1">Museu de Ciências Naturais José Alencar de Carvalho</h1>
          <p class="slogan-museu mb-0">IFSULDEMINAS Campus Machado</p>
        </div>
      </div>
    </div>

    <div class="green-space"></div>

    <nav class="custom-navbar">
      <div class="container d-flex flex-wrap justify-content-center gap-3">
        <a href="/ProjetoMuseu/index.php" class="nav-link-custom">Início</a>
        <a href="/ProjetoMuseu/views/sobre.php" class="nav-link-custom">Sobre</a>
        <a href="/ProjetoMuseu/views/visitas.php" class="nav-link-custom">Visitas</a>
        <a href="/ProjetoMuseu/views/agendamento.php" class="nav-link-custom">Agendamento</a>
        <a href="/ProjetoMuseu/views/contato.php" class="nav-link-custom">Contato</a>
      </div>
    </nav>
  </header>

</body>
</html>
