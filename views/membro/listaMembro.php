<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /ProjetoMuseu/views/login.php');
    exit();
}

$sucesso = $_SESSION['sucesso'] ?? null;
unset($_SESSION['sucesso']);

ob_start();
?>

<main class="main-content">
  <?php if (!empty($sucesso)): ?>
    <div class="alert alert-success" style="margin-bottom: 20px;">
      <?= htmlspecialchars($sucesso) ?>
    </div>
  <?php endif; ?>

  <div class="header">
    <h1>Gerenciamento da Equipe</h1>
    <a href="/ProjetoMuseu/routerMembro.php?action=exibirFormCadastro" class="btn-add">+ Novo Membro</a>
  </div>

  <section class="secao-tabela">
    <table class="tabela-visitas">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Sobre</th>
          <th>Perfil</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($membros as $membro): ?>
        <tr>
          <td><?= htmlspecialchars($membro['nome']) ?></td>
          <td><?= htmlspecialchars($membro['email']) ?></td>
          <td><?= htmlspecialchars($membro['sobre']) ?></td>
          <td><?= htmlspecialchars($membro['perfil']) ?></td>
          <td>
            <a href="/ProjetoMuseu/template/editaMembro.php?id=<?= $membro['id'] ?>" class="btn-edit">
              <i class="bi bi-pencil-square"></i> Editar
            </a>
            <?php if ($_SESSION['usuario_perfil'] === 'Coordenador(a) do Museu'): ?>
            <a href="/ProjetoMuseu/php/excluir_membro.php?id=<?= $membro['id'] ?>" class="btn-delete">
              <i class="bi bi-trash"></i> Excluir
            </a>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</main>

<?php
$conteudo = ob_get_clean();
$pagina_css = 'membro.css';
require __DIR__ . '/../includes/layout.php';
