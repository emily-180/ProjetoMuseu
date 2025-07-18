<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Projeto Museu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/ProjetoMuseu/static/css/gerencia.css">

  <?php
    if (!isset($pagina_css)) {
        $pagina_css = 'gerencia.css'; // Fallback se não tiver
    }

    if (is_array($pagina_css)) {
        foreach ($pagina_css as $css) {
            echo "<link rel='stylesheet' href='/ProjetoMuseu/static/css/$css'>";
        }
    } else {
        echo "<link rel='stylesheet' href='/ProjetoMuseu/static/css/$pagina_css'>";
    }
  ?>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <div class="container-geral">
    <?php require __DIR__ . '/sidebar.php'; ?>

    <main class="main-content">
      <?php if (isset($conteudo)) echo $conteudo; ?>
    </main>
  </div>
  
</body>
</html>
