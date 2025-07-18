<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="row align-items-center">
                <div class="col-md-2 text-center text-md-start">
                    <img src="/ProjetoMuseu/static/imagens/logo.png" alt="Logo do Museu" class="logo-museu">
                </div>
                <div class="col-md-10 text-center text-md-start">
                    <h1 class="nome-museu mb-1">Museu de Ciências Naturais José Alencar de Carvalho</h1>
                    <p class="slogan-museu mb-0">IFSULDEMINAS Campus Machado</p>
                </div>
            </div>
        </div>
      
        <div class="green-space"></div>
      
        <nav class="custom-navbar">
            <div class="container d-flex justify-content-center flex-wrap gap-3">
                <a href="/ProjetoMuseu/index.php" class="nav-link-custom">INÍCIO</a>
                <a href="/ProjetoMuseu/views/sobre.php" class="nav-link-custom">SOBRE</a>
                <a href="/ProjetoMuseu/views/visitas.php" class="nav-link-custom">VISITAS</a>
                <a href="/ProjetoMuseu/views/agendamento.php" class="nav-link-custom">AGENDAMENTO</a>
                <a href="/ProjetoMuseu/views/contato.php" class="nav-link-custom">CONTATO</a>
            </div>
        </nav>
    </header>
</body>
</html>