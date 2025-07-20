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

<header class="hero-header">
  <div class="overlay d-flex flex-column h-100">
    <div class="container d-flex justify-content-between align-items-center py-3">
      <img src="/ProjetoMuseu/static/imagens/logo.png" alt="Logo Museu" class="logo-header">
     
      <button class="btn btn-outline-light d-md-none ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral" aria-controls="menuLateral">
        <i class="bi bi-list" style="font-size: 1.5rem;"></i>
      </button>

    
      <nav class="nav-links d-none d-md-flex gap-4 align-items-center">
        <a href="/ProjetoMuseu/index.php" class="nav-item">INÍCIO</a>
        <a href="/ProjetoMuseu/views/sobre.php" class="nav-item">SOBRE</a>
        <a href="/ProjetoMuseu/views/visitas.php" class="nav-item">VISITAS</a>
        <a href="/ProjetoMuseu/views/agendamento.php" class="nav-item">AGENDAMENTO</a>
        <a href="/ProjetoMuseu/views/contato.php" class="nav-item">CONTATO</a>
        <a href="https://www.instagram.com/museu_josealencardecarvalho/" target="_blank" class="text-white "><i class="bi bi-instagram social-icons" style="font-size: 1.3rem;"></i></a>
      </nav>
    </div>

    
    <div class="offcanvas offcanvas-start text-bg-success" tabindex="-1" id="menuLateral" aria-labelledby="menuLateralLabel">
  <div class="offcanvas-header justify-content-center">
    <img src="/ProjetoMuseu/static/imagens/logo.png" alt="Logo do Museu" class="img-fluid" style="max-width: 160px;">
  </div>

  <div class="offcanvas-body d-flex flex-column gap-4">
    <h5 class="offcanvas-title text-white" id="menuLateralLabel">Menu</h5>
    <a href="/ProjetoMuseu/index.php" class="text-white text-decoration-none fs-5">
      <i class="bi bi-house me-2"></i> Início
    </a>
    <a href="/ProjetoMuseu/views/sobre.php" class="text-white text-decoration-none fs-5">
      <i class="bi bi-info-circle me-2"></i> Sobre
    </a>
    <a href="/ProjetoMuseu/views/visitas.php" class="text-white text-decoration-none fs-5">
      <i class="bi bi-calendar me-2"></i> Visitas
    </a>
    <a href="/ProjetoMuseu/views/agendamento.php" class="text-white text-decoration-none fs-5">
      <i class="bi bi-calendar-check me-2"></i> Agendamento
    </a>
    <a href="/ProjetoMuseu/views/contato.php" class="text-white text-decoration-none fs-5">
      <i class="bi bi-envelope-fill me-2"></i> Contato
    </a>
    <a href="https://www.instagram.com/museu_josealencardecarvalho/" target="_blank" class="text-white text-decoration-none fs-5">
      <i class="bi bi-instagram me-2"></i> Instagram
    </a>
  </div>
</div>




    <div class="container text-center mt-auto mb-5">
      <h1 class="hero-title">Museu de Ciências Naturais<br>José Alencar de Carvalho</h1>
    </div>
  </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
