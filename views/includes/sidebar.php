<button class="hamburger" id="hamburgerBtn">
  <i class="bi bi-list"></i>
</button>

<aside class="sidebar mobile-hidden" id="sidebar">
  <div class="sidebar-header">
    <img src="/ProjetoMuseu/static/imagens/logo.png" alt="Logo do Museu" class="logo">
    <h1>Museu José Alencar de Carvalho</h1>
  </div>
  <nav class="menu">
     <a href="/ProjetoMuseu/views/gerenciamento/gerenciamento.php"><i class="bi bi-book-half"></i> Painel</a>
    <a href="/ProjetoMuseu/routerMembro.php?action=listar"><i class="bi bi-people-fill"></i> Membros</a>
    <a href="/ProjetoMuseu/routerSolicitacao.php?action=index"><i class="bi bi-calendar"></i> Solicitações</a>
  </nav>
  <a href="/ProjetoMuseu/routerAuth.php?page=logout" class="logout">
    <i class="bi bi-box-arrow-right"></i> Sair
  </a>
</aside>
