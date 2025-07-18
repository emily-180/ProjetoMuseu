<?php
$sucesso = $_SESSION['sucesso'] ?? null;
$erros = $_SESSION['erros'] ?? [];
$dados = $_SESSION['dados'] ?? [];
$id = $dados['id'] ?? '';
unset($_SESSION['sucesso'], $_SESSION['erros'], $_SESSION['dados']);

ob_start();
?>

<main class="main-content">
  <div class="header">
    <h1>Cadastrar membro</h1>
    <a href="/ProjetoMuseu/routerMembro.php?action=listar" class="btn-add">← Voltar</a>
  </div>

  <form method="POST" action="/ProjetoMuseu/routerMembro.php?action=salvar">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

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
      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required>
      <?php if (isset($erros['senha'])): ?>
        <span class="error-message"><?= htmlspecialchars($erros['senha']) ?></span>
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
      <select id="perfil" name="perfil" required>
        <option value="">-- Selecione --</option>
        <option value="Monitor(a)" <?= ($dados['perfil'] ?? '') === 'Monitor(a)' ? 'selected' : '' ?>>Monitor(a)</option>
        <option value="Professor(a)" <?= ($dados['perfil'] ?? '') === 'Professor(a)' ? 'selected' : '' ?>>Professor(a)</option>
        <option value="Coordenador(a) do Museu" <?= ($dados['perfil'] ?? '') === 'Coordenador(a) do Museu' ? 'selected' : '' ?>>Coordenador(a) do Museu</option>
      </select>
      <?php if (isset($erros['perfil'])): ?>
        <span class="error-message"><?= htmlspecialchars($erros['perfil']) ?></span>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn-add-membro">Cadastrar</button>
  </form>
</main>

<?php
$conteudo = ob_get_clean();
$pagina_css = 'membro.css';
require __DIR__ . '/../includes/layout.php';
?>
