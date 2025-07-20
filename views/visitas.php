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
          <img src="/ProjetoMuseu/static/imagens/caatinga.jpeg" alt="Ambiente da Caatinga">
          <div class="info">
            <p class="tag">ambiente</p>
            <h3>Caatinga</h3>
          </div>
        </div>
        <div class="item-acervo">
          <img src="/ProjetoMuseu/static/imagens/cerrado.jpeg" alt="Ambiente do Cerrado">
          <div class="info">
            <p class="tag">ambiente</p>
            <h3>Cerrado</h3>
          </div>
        </div>
        <div class="item-acervo">
          <img src="/ProjetoMuseu/static/imagens/mata.jpeg" alt="Ambiente da Amazônia">
          <div class="info">
            <p class="tag">ambiente</p>
            <h3>Mata Atântica</h3>
          </div>
        </div>
        <div class="item-acervo">
          <img src="/ProjetoMuseu/static/imagens/marinho.jpeg" alt="Ambiente Interno do Museu">
          <div class="info">
            <p class="tag">ambiente</p>
            <h3>Ecossitema Marinho</h3>
          </div>
        </div>
      </div>
    </section>

   <p class="intro-equipe">
      Conheça as pessoas dedicadas que fazem o Museu de Ciências José Alencar de Carvalho acontecer. Nossa equipe é formada por docentes, bolsistas e voluntários apaixonados pela educação e preservação da memória da região.
  </p>

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