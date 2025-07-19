<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Projeto Museu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/ProjetoMuseu/static/css/sidebar.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php
    if (!isset($pagina_css)) $pagina_css = 'gerenciaAgendamento.css';
    if (is_array($pagina_css)) {
        foreach ($pagina_css as $css) {
            echo "<link rel='stylesheet' href='/ProjetoMuseu/static/css/$css'>";
        }
    } else {
        echo "<link rel='stylesheet' href='/ProjetoMuseu/static/css/$pagina_css'>";
    }
  ?>
</head>

<body>
  <div class="layout">
    <?php require __DIR__ . '/sidebar.php'; ?>
    <main class="content">
      <?php if (isset($conteudo)) echo $conteudo; ?>
    </main>
  </div>

  <script>
    function ajustarSidebar() {
      const sidebar = document.getElementById('sidebar');

      if (window.innerWidth >= 769) {
        
        sidebar.classList.remove('mobile-hidden');
        sidebar.classList.remove('mobile-visible');
      } else {
        
        sidebar.classList.add('mobile-hidden');
        sidebar.classList.remove('mobile-visible');
      }
    }

    window.addEventListener('resize', ajustarSidebar);
    window.addEventListener('load', ajustarSidebar);

    const hamburger = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('sidebar');

    hamburger.addEventListener('click', (e) => {
      e.stopPropagation(); 
      sidebar.classList.toggle('mobile-visible');
      sidebar.classList.toggle('mobile-hidden');
    });

    document.addEventListener('click', function (event) {
      const isMobile = window.innerWidth < 769;
      const sidebarAberta = sidebar.classList.contains('mobile-visible');

      const clicouFora = !sidebar.contains(event.target) && !hamburger.contains(event.target);

      if (isMobile && sidebarAberta && clicouFora) {
        sidebar.classList.remove('mobile-visible');
        sidebar.classList.add('mobile-hidden');
      }
    });
  </script>


</body>

</html>
