<?php
$sucesso = $_SESSION['sucesso'] ?? null;
$erros = $_SESSION['erros'] ?? [];
$dados = $_SESSION['dados'] ?? [];
unset($_SESSION['sucesso'], $_SESSION['erros'], $_SESSION['dados']);

$dados = array_merge($membro, $dados); 

$usuarioLogado = [
  'id' => $_SESSION['usuario_id'] ?? null,
  'perfil' => $_SESSION['usuario_perfil'] ?? null
];

ob_start();
?>

<main class="main-content">
  <div class="header">
    <h1>Editar membro</h1>
    <a href="/ProjetoMuseu/routerMembro.php?action=listar" class="btn">← Voltar</a>
  </div>

  <form method="POST" action="/ProjetoMuseu/routerMembro.php?action=atualizar">
    <input type="hidden" name="id" value="<?= htmlspecialchars($dados['id'] ?? '') ?>">

    <?php if (!empty($sucesso)): ?>
      <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <?php if (!empty($erros['geral'])): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($erros['geral']) ?></div>
    <?php endif; ?>

    <div class="form-group">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dados['nome'] ?? '') ?>" required>
      <?php if (isset($erros['nome'])): ?>
        <span class="error-message"><?= htmlspecialchars($erros['nome']) ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($dados['email'] ?? '') ?>" required>
      <?php if (isset($erros['email'])): ?>
        <span class="error-message"><?= htmlspecialchars($erros['email']) ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="sobre">Sobre:</label>
      <textarea id="sobre" name="sobre" required><?= htmlspecialchars($dados['sobre'] ?? '') ?></textarea>
      <?php if (isset($erros['sobre'])): ?>
        <span class="error-message"><?= htmlspecialchars($erros['sobre']) ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="perfil">Perfil:</label>

        <?php if ($usuarioLogado['id'] == $dados['id']): ?>
            <input type="text" readonly class="form-control" value="<?= htmlspecialchars($dados['perfil']) ?>">
            <input type="hidden" name="perfil" value="<?= htmlspecialchars($dados['perfil']) ?>">
        <?php else: ?>
            <select id="perfil" name="perfil" required>
            <option value="">-- Selecione --</option>
            <option value="Monitor(a)" <?= ($dados['perfil'] ?? '') === 'Monitor(a)' ? 'selected' : '' ?>>Monitor(a)</option>
            <option value="Professor(a)" <?= ($dados['perfil'] ?? '') === 'Professor(a)' ? 'selected' : '' ?>>Professor(a)</option>
            <option value="Coordenador(a) do Museu" <?= ($dados['perfil'] ?? '') === 'Coordenador(a) do Museu' ? 'selected' : '' ?>>Coordenador(a) do Museu</option>
            </select>
        <?php endif; ?>

        <?php if (isset($erros['perfil'])): ?>
            <span class="error-message"><?= htmlspecialchars($erros['perfil']) ?></span>
        <?php endif; ?>
    </div>

    <?php if ($usuarioLogado['id'] == ($dados['id'] ?? null)): ?>
      <div class="form-group">
        <label for="senha_atual">Senha atual:</label>
        <input type="password" id="senha_atual" name="senha_atual">
        <?php if (isset($erros['senha_atual'])): ?>
          <span class="error-message"><?= htmlspecialchars($erros['senha_atual']) ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="nova_senha">Nova senha:</label>
        <input type="password" id="nova_senha" name="nova_senha">
        <?php if (isset($erros['nova_senha'])): ?>
          <span class="error-message"><?= htmlspecialchars($erros['nova_senha']) ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="confirmar_senha">Confirmar nova senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha">
        <?php if (isset($erros['confirmar_senha'])): ?>
          <span class="error-message"><?= htmlspecialchars($erros['confirmar_senha']) ?></span>
        <?php endif; ?>
      </div>
    <?php endif; ?>



    <button type="submit" class="btn">Salvar Alterações</button>
  </form>
</main>

<?php
$conteudo = ob_get_clean();
$pagina_css = 'membro.css';
require __DIR__ . '/../includes/layout.php';
?>
