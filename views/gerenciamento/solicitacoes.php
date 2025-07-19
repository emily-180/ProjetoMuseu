<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /ProjetoMuseu/views/login.php');
    exit();
}

$abaAtiva = $_SESSION['abaAtiva'] ?? 'Nova';
unset($_SESSION['abaAtiva']);

$sucesso = $_SESSION['sucesso'] ?? null;
unset($_SESSION['sucesso']);

ob_start();
?>

<div class="container-geral">
  <main class="main-content">
    <header class="header">
        <h1>Gerenciamento das Solicitações</h1>
        <?php if ($sucesso): ?>
          <p style="color: green"><?= $sucesso ?></p>
        <?php endif; ?>
    </header>

    <section class="solicitacoes">
      <div class="tabs">
        <?php
        $abas = ['Nova', 'Em análise', 'Agendado', 'Concluído', 'Recusado'];
        foreach ($abas as $aba):
          $idAba = strtolower(str_replace(' ', '', $aba));
        ?>
          <button class="tab-button <?= $aba === $abaAtiva ? 'active' : '' ?>" data-tab="<?= $idAba ?>"><?= $aba ?></button>
        <?php endforeach; ?>
      </div>

      <?php foreach ($abas as $aba):
        $idAba = strtolower(str_replace(' ', '', $aba));
      ?>
        <div class="tab-content<?= $aba === $abaAtiva ? ' active' : '' ?>" id="<?= $idAba ?>">
          <?php if (!empty($dados[$aba])): ?>
            <?php foreach ($dados[$aba] as $solicitacao): ?>
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
                    <?= htmlspecialchars($solicitacao['nome_membro'] ?? 'Nenhum membro responsável') ?>
                  </p>

                  <?php if ($aba === 'Recusado'): ?>
                    <p><strong>Motivo da recusa:</strong> <?= htmlspecialchars($solicitacao['descricao']) ?></p>
                  <?php else: ?>
                    <form class="form-situacao" action="/ProjetoMuseu/routerSolicitacao.php?action=atualizar" method="POST">
                      <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
                      <strong for="situacao">Situação:</strong>
                      <select name="situacao" class="situacao-select" data-id="<?= $solicitacao['id'] ?>">
                        <?php foreach ($abas as $opcao): ?>
                          <option value="<?= $opcao ?>" <?= $solicitacao['situacao'] === $opcao ? 'selected' : '' ?>><?= $opcao ?></option>
                        <?php endforeach; ?>
                      </select>

                      <div class="descricao-recusado" id="descricao-<?= $solicitacao['id'] ?>" style="<?= $solicitacao['situacao'] === 'Recusado' ? 'display: block;' : 'display: none;' ?>">
                          <label for="descricao_<?= $solicitacao['id'] ?>">Motivo da recusa:</label>
                          <textarea name="descricao" class="form-control"><?= htmlspecialchars($solicitacao['descricao'] ?? '') ?></textarea>
                      </div>

                      <button class="button-salvar" type="submit">Salvar</button>
                    </form>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>Nenhuma solicitação <?= strtolower($aba) ?>.</p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </section>
  </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Alternar abas
  document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
      document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

      button.classList.add('active');
      const tabId = button.getAttribute('data-tab');
      document.getElementById(tabId).classList.add('active');
    });
  });

  // Expandir detalhes da solicitação
  document.querySelectorAll('.abrir-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const detalhes = btn.closest('.solicitacao').querySelector('.solicitacao-detalhes');
      detalhes.style.display = (detalhes.style.display === 'none' || detalhes.style.display === '') ? 'block' : 'none';
    });
  });

  // Mostrar/ocultar campo de recusa
  document.querySelectorAll('.situacao-select').forEach(select => {
    select.addEventListener('change', function () {
      const id = this.dataset.id;
      const box = document.getElementById('descricao-' + id);
      if (this.value === 'Recusado') {
        box.style.display = 'block';
      } else {
        box.style.display = 'none';
      }
    });
  });
});
</script>

<?php
$conteudo = ob_get_clean();
$pagina_css = 'solicitacoes.css';
require __DIR__ . '/../includes/layout.php';
