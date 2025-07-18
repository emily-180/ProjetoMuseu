<?php 
ob_start();
$pagina_css = 'gerenciaAgendamento.css';
?>
<div class="header-page">
  <h2>Visão Geral das Visitas</h2>
</div>

<section class="visitas">
  <?php foreach ($visitas as $index => $visita): ?>
    <div class="card">
      <button onclick="toggleDetalhes(<?= $index ?>)" class="card-header">
        <span><?= htmlspecialchars($visita['nome_escola']) ?></span>
        <span><?= date('d/m/Y', strtotime($visita['data_pretendida'])) ?></span>
      </button>
      <div class="card-body" id="detalhes-<?= $index ?>">
        <p><strong>Responsável:</strong> <?= htmlspecialchars($visita['nome_responsavel']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($visita['email_responsavel']) ?></p>
        <p><strong>Telefone:</strong> <?= htmlspecialchars($visita['telefone_responsavel']) ?></p>
        <p><strong>Telefone Escola:</strong> <?= htmlspecialchars($visita['telefone_escola']) ?></p>
        <p><strong>Qtd. Alunos:</strong> <?= htmlspecialchars($visita['quantidade_alunos']) ?></p>
        <p><strong>Perfil:</strong> <?= htmlspecialchars($visita['perfil_alunos']) ?></p>
        <p><strong>Hora:</strong> <?= htmlspecialchars($visita['hora_pretendida']) ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</section>

<?php
$conteudo = ob_get_clean();
require __DIR__ . '/../includes/layout.php';
?>

<script>
  function toggleDetalhes(index) {
    const detalhe = document.getElementById('detalhes-' + index);
    detalhe.style.display = detalhe.style.display === 'block' ? 'none' : 'block';
  }
</script>
