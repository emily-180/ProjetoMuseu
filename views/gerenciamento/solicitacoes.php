<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /ProjetoMuseu/views/login.php');
    exit();
}

$sucesso = $_SESSION['sucesso'] ?? null;
unset($_SESSION['sucesso']);

ob_start();
?>

<div class="container-geral">
  <main class="main-content">
    <header class="header">
        <h1>Gerenciamento das Solicitações</h1>
    </header>

    <section class="solicitacoes">
      <div class="tabs">
        <button class="tab-button active" data-tab="nova">Nova</button>
        <button class="tab-button" data-tab="analise">Em análise</button>
        <button class="tab-button" data-tab="agendado">Agendado</button>
        <button class="tab-button" data-tab="concluido">Concluído</button>
      </div>

      <!-- Aba: Nova -->
      <div class="tab-content active" id="nova">
        <?php foreach ($dados['Nova'] ?? [] as $solicitacao): ?>
        <div class="solicitacao">
          <div class="solicitacao-resumo">
            <div class="escola-info">
              <strong>Escola:</strong> <?= htmlspecialchars($solicitacao['escola']) ?>
            </div>
            <div class="data-hora">
              <strong>Data:</strong> <?= date('d/m/Y', strtotime($solicitacao['data_visita'])) ?> |
              <strong>Hora:</strong> <?= htmlspecialchars($solicitacao['hora_visita']) ?>
            </div>
            <button class="abrir-btn">Abrir</button>
          </div>

          <div class="solicitacao-detalhes" style="display:none;">
            <p><strong>Membro Responsável:</strong>
              <?= htmlspecialchars($solicitacao['nome_membro'] ?: 'Nenhum membro responsável') ?>
            </p>
            <form class="form-situacao" action="/ProjetoMuseu/routerSolicitacao.php?action=atualizar" method="POST">
              <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
              <label for="situacao">Situação:</label>
              <select name="situacao" class="situacao-select">
                <option value="Nova" <?= $solicitacao['situacao'] == 'Nova' ? 'selected' : '' ?>>Nova</option>
                <option value="Em análise" <?= $solicitacao['situacao'] == 'Em análise' ? 'selected' : '' ?>>Em análise</option>
                <option value="Agendado" <?= $solicitacao['situacao'] == 'Agendado' ? 'selected' : '' ?>>Agendado</option>
                <option value="Concluído" <?= $solicitacao['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
              </select>
              <button class="button-salvar" type="submit">Salvar</button>
            </form>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Aba: Em Análise -->
      <div class="tab-content" id="analise">
        <?php foreach ($dados['Em análise'] ?? [] as $solicitacao): ?>
        <div class="solicitacao">
          <div class="solicitacao-resumo">
            <div class="escola-info">
              <strong>Escola:</strong> <?= htmlspecialchars($solicitacao['escola']) ?>
            </div>
            <div class="data-hora">
              <strong>Data:</strong> <?= date('d/m/Y', strtotime($solicitacao['data_visita'])) ?> |
              <strong>Hora:</strong> <?= htmlspecialchars($solicitacao['hora_visita']) ?>
            </div>
            <button class="abrir-btn">Abrir</button>
          </div>

          <div class="solicitacao-detalhes" style="display:none;">
            <p><strong>Membro Responsável:</strong>
              <?= htmlspecialchars($solicitacao['nome_membro'] ?: 'Nenhum membro responsável') ?>
            </p>
            <form class="form-situacao" action="/ProjetoMuseu/routerSolicitacao.php?action=atualizar" method="POST">
              <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
              <label for="situacao">Situação:</label>
              <select name="situacao" class="situacao-select">
                <option value="Nova" <?= $solicitacao['situacao'] == 'Nova' ? 'selected' : '' ?>>Nova</option>
                <option value="Em análise" <?= $solicitacao['situacao'] == 'Em análise' ? 'selected' : '' ?>>Em análise</option>
                <option value="Agendado" <?= $solicitacao['situacao'] == 'Agendado' ? 'selected' : '' ?>>Agendado</option>
                <option value="Concluído" <?= $solicitacao['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
              </select>
              <button class="button-salvar" type="submit">Salvar</button>
            </form>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Aba: Agendado -->
      <div class="tab-content" id="agendado">
        <?php foreach ($dados['Agendado'] ?? [] as $solicitacao): ?>
        <div class="solicitacao">
          <div class="solicitacao-resumo">
            <div class="escola-info">
              <strong>Escola:</strong> <?= htmlspecialchars($solicitacao['escola']) ?>
            </div>
            <div class="data-hora">
              <strong>Data:</strong> <?= date('d/m/Y', strtotime($solicitacao['data_visita'])) ?> |
              <strong>Hora:</strong> <?= htmlspecialchars($solicitacao['hora_visita']) ?>
            </div>
            <button class="abrir-btn">Abrir</button>
          </div>

          <div class="solicitacao-detalhes" style="display:none;">
            <p><strong>Membro Responsável:</strong>
              <?= htmlspecialchars($solicitacao['nome_membro'] ?: 'Nenhum membro responsável') ?>
            </p>
            <form class="form-situacao" action="/ProjetoMuseu/routerSolicitacao.php?action=atualizar" method="POST">
              <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
              <p><strong>Situação:</strong>
              <select name="situacao" class="situacao-select">
                <option value="Nova" <?= $solicitacao['situacao'] == 'Nova' ? 'selected' : '' ?>>Nova</option>
                <option value="Em análise" <?= $solicitacao['situacao'] == 'Em análise' ? 'selected' : '' ?>>Em análise</option>
                <option value="Agendado" <?= $solicitacao['situacao'] == 'Agendado' ? 'selected' : '' ?>>Agendado</option>
                <option value="Concluído" <?= $solicitacao['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
              </select>
              <button class="button-salvar" type="submit">Salvar</button>
              </p>
            </form>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Aba: Concluído -->
      <div class="tab-content" id="concluido">
        <?php foreach ($dados['Concluído'] ?? [] as $solicitacao): ?>
        <div class="solicitacao">
          <div class="solicitacao-resumo">
            <div class="escola-info">
              <strong>Escola:</strong> <?= htmlspecialchars($solicitacao['escola']) ?>
            </div>
            <div class="data-hora">
              <strong>Data:</strong> <?= date('d/m/Y', strtotime($solicitacao['data_visita'])) ?> |
              <strong>Hora:</strong> <?= htmlspecialchars($solicitacao['hora_visita']) ?>
            </div>
            <button class="abrir-btn">Abrir</button>
          </div>

          <div class="solicitacao-detalhes" style="display:none;">
            <p><strong>Membro Responsável:</strong>
              <?= htmlspecialchars($solicitacao['nome_membro'] ?: 'Nenhum membro responsável') ?>
            </p>
            <form class="form-situacao" action="/ProjetoMuseu/routerSolicitacao.php?action=atualizar" method="POST">
              <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
              <label for="situacao">Situação:</label>
              <select name="situacao" class="situacao-select">
                <option value="Nova" <?= $solicitacao['situacao'] == 'Nova' ? 'selected' : '' ?>>Nova</option>
                <option value="Em análise" <?= $solicitacao['situacao'] == 'Em análise' ? 'selected' : '' ?>>Em análise</option>
                <option value="Agendado" <?= $solicitacao['situacao'] == 'Agendado' ? 'selected' : '' ?>>Agendado</option>
                <option value="Concluído" <?= $solicitacao['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
              </select>
              <button class="button-salvar" type="submit">Salvar</button>
            </form>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </section>
  </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
      document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

      button.classList.add('active');
      const tabId = button.getAttribute('data-tab');
      const tab = document.getElementById(tabId);
      if(tab) tab.classList.add('active');
    });
  });

  document.querySelectorAll('.abrir-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const detalhes = btn.closest('.solicitacao').querySelector('.solicitacao-detalhes');
      if(detalhes.style.display === 'none' || detalhes.style.display === '') {
        detalhes.style.display = 'block';
      } else {
        detalhes.style.display = 'none';
      }
    });
  });
});
</script>

<?php
$conteudo = ob_get_clean();
$pagina_css = 'solicitacoes.css';
require __DIR__ . '/../includes/layout.php';

