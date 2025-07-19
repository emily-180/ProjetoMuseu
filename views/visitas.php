<?php
$pagina_css = 'visitas.css';

require "includes/header.php";
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/MembroModel.php';

$membroModel = new Membro($pdo);
$membros = $membroModel->listar();
?>

<main class="container my-5 position-relative pt-5">
  <div class="section-label">
    VISITAS
    <div class="underline"></div>
  </div>

  <div class="content mt-4" id="conteudo">
    <section class="acervo">
      <div class="grid-acervo">
        <div class="item-acervo">
          <img src="/ProjetoMuseu/static/imagens/temporaria.png" alt="Ambiente da Caatinga">
          <div class="info">
            <p class="tag">ambiente</p>
            <h3>Caatinga</h3>
          </div>
        </div>
        <div class="item-acervo">
          <img src="/ProjetoMuseu/static/imagens/temporaria.png" alt="Ambiente do Cerrado">
          <div class="info">
            <p class="tag">ambiente</p>
            <h3>Cerrado</h3>
          </div>
        </div>
        <div class="item-acervo">
          <img src="/ProjetoMuseu/static/imagens/temporaria.png" alt="Ambiente da Amazônia">
          <div class="info">
            <p class="tag">ambiente</p>
            <h3>Mata Atântica</h3>
          </div>
        </div>
        <div class="item-acervo">
          <img src="/ProjetoMuseu/static/imagens/temporaria.png" alt="Ambiente Interno do Museu">
          <div class="info">
            <p class="tag">ambiente</p>
            <h3>Ecossitema Marinho</h3>
          </div>
        </div>
      </div>
    </section>

    <div>
      <h2 class="titulo">Guia de Visitas</h2>
      <p class="texto-guia">Aqui você encontrará as informações sobre como funcionam as visitas ao museu, incluindo horários, informações sobre os ambientes e muito mais. Aproveite a nossa trilha de conhecimento!</p>
    </div>

   <h2 class="titulo mt-5">Equipe</h2>
    <div class="equipe-lista">
      <?php if (!empty($membros)): ?>
        <?php foreach ($membros as $membro): ?>
          <div class="membro-card">
            <strong><?= htmlspecialchars($membro['nome']) ?></strong>
            <span class="perfil"><?= htmlspecialchars($membro['perfil']) ?></span>
            <p><?= nl2br(htmlspecialchars($membro['sobre'])) ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Nenhum membro cadastrado.</p>
      <?php endif; ?>
    </div>


</main>

<?php
require "includes/footer.php";
?>