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
      <a href="/ProjetoMuseu/routerMembro.php?action=exibirFormCadastro" class="btn">+ Novo Membro</a>
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
              <a href="/ProjetoMuseu/routerMembro.php?action=editar&id=<?= $membro['id'] ?>" class="btn-edit">
                <i class="bi bi-pencil-square"></i> Editar
              </a>
              
              <?php if ($_SESSION['usuario_perfil'] === 'Coordenador(a) do Museu'): ?>
                <a href="#" class="btn-edit btn-excluir" data-id="<?= $membro['id'] ?>">
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

  <script>
    const usuarioLogadoId = <?= json_encode($_SESSION['usuario_id']) ?>;
    
    document.addEventListener('DOMContentLoaded', function () {
      const botoesExcluir = document.querySelectorAll('.btn-excluir');

      botoesExcluir.forEach(botao => {
        botao.addEventListener('click', function () {
          const membroId = this.getAttribute('data-id');

          if (parseInt(membroId) === parseInt(usuarioLogadoId)) {
            Swal.fire({
              icon: 'error',
              title: 'Ação bloqueada',
              text: 'Você não pode se excluir do sistema.',
            });
            return;
          }

          Swal.fire({
            title: 'Tem certeza?',
            text: 'Essa ação não pode ser desfeita!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = `/ProjetoMuseu/routerMembro.php?action=excluir&id=${membroId}`;
            }
          });
        });
      });
    });
  </script>

<?php
$conteudo = ob_get_clean();
$pagina_css = 'membro.css';
require __DIR__ . '/../includes/layout.php';
