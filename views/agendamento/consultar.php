<?php 
ob_start();
$pagina_css = 'gerenciaAgendamento.css';
?>

<div class="container-geral">
  <?php require __DIR__ . '/../includes/sidebar.php'; ?>

  <main class="main-content">
    <header class="header">
      <h1>Visão Geral das Visitas</h1>
    </header>

    <section class="secao-lista">
      <?php foreach ($visitas as $index => $visita): ?>
        <div class="card-visita">
           <button class="visita-titulo" onclick="toggleDetalhes(<?= $index ?>)">
            <span class="escola"><?= htmlspecialchars($visita['nome_escola']) ?></span>
            <span class="data"><?= date('d/m/Y', strtotime($visita['data_pretendida'])) ?></span>
          </button>

          <div class="visita-detalhes" id="detalhes-<?= $index ?>">
            <p><strong>Responsável:</strong> <?= htmlspecialchars($visita['nome_responsavel']) ?></p>
            <p><strong>Telefone do Responsável:</strong> <?= htmlspecialchars($visita['telefone_responsavel']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($visita['email_responsavel']) ?></p>
            <p><strong>Telefone da Escola:</strong> <?= htmlspecialchars($visita['telefone_escola']) ?></p>
            <p><strong>Quantidade de Alunos:</strong> <?= htmlspecialchars($visita['quantidade_alunos']) ?></p>
            <p><strong>Perfil dos Alunos:</strong> <?= htmlspecialchars($visita['perfil_alunos']) ?></p>
            <p><strong>Hora Pretendida:</strong> <?= htmlspecialchars($visita['hora_pretendida']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </section>
  </main>
</div>

<?php
$conteudo = ob_get_clean(); // Finaliza a captura
require __DIR__ . '/../includes/layout.php';
?>

<script>
  function toggleDetalhes(index) {
    const detalhe = document.getElementById('detalhes-' + index);
    const todos = document.querySelectorAll('.visita-detalhes');

    // Fecha todos antes de abrir o clicado
    todos.forEach((el, i) => {
      if (i !== index) el.style.display = 'none';
    });

    detalhe.style.display = (detalhe.style.display === 'block') ? 'none' : 'block';
  }
</script>

