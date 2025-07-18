<?php
$pagina_css = 'agendamento.css';
require "includes/header.php";
?>

<?php
session_start();
$sucesso = $_SESSION['sucesso'] ?? null;
$erros = $_SESSION['erros'] ?? [];
$dados = $_SESSION['dados'] ?? [];
unset($_SESSION['sucesso']);
unset($_SESSION['erros']);
unset($_SESSION['dados']);
?>

<main class="container my-5 position-relative pt-5">
    <div class="section-label">
        AGENDAMENTO
        <div class="underline"></div>
    </div>

    <div class="content mt-4">
        <div class="form-container">

            <h1>Solicite sua visita</h1>

            <?php if ($sucesso): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($sucesso) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/ProjetoMuseu/static/validaAgendamento.php" method="POST">
                <div class="campo">
                    <label for="telefone_escola">Telefone de contato</label>
                    <input type="text" name="telefone_escola" id="telefone_escola" placeholder="Ex:(35) 99999-9999"
                        value="<?= htmlspecialchars($dados['telefone_escola'] ?? '') ?>" required>
                    <?php if (isset($erros['telefone_escola'])): ?>
                        <span class="text-danger"><?= htmlspecialchars($erros['telefone_escola']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="campo">
                    <label for="nome_escola">Nome da Escola:</label>
                    <input type="text" name="nome_escola" id="nome_escola" placeholder="Ex: Escola Estadual ABC"
                        value="<?= htmlspecialchars($dados['nome_escola'] ?? '') ?>" required>
                    <?php if (isset($erros['nome_escola'])): ?>
                        <span class="text-danger"><?= htmlspecialchars($erros['nome_escola']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="grid-dupla">
                    <div class="campo">
                        <label for="data_pretendida">Data Pretendida:</label>
                        <input type="date" name="data_pretendida" id="data_pretendida"
                            value="<?= htmlspecialchars($dados['data_pretendida'] ?? '') ?>" required>
                        <?php if (isset($erros['data_pretendida'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['data_pretendida']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="campo">
                        <label for="hora_pretendida">Horário Pretendido:</label>
                        <input type="time" name="hora_pretendida" id="hora_pretendida"
                            value="<?= htmlspecialchars($dados['hora_pretendida'] ?? '') ?>" required>
                        <?php if (isset($erros['hora_pretendida'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['hora_pretendida']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid-dupla">
                    <div class="campo">
                        <label for="quantidade_alunos">Número de Visitantes:</label>
                        <input type="number" name="quantidade_alunos" id="quantidade_alunos" placeholder="Ex: 30"
                            value="<?= htmlspecialchars($dados['quantidade_alunos'] ?? '') ?>" required>
                        <?php if (isset($erros['quantidade_alunos'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['quantidade_alunos']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="campo">
                        <label for="perfil_alunos">Faixa Etária ou Escolaridade dos Visitantes:</label>
                        <input type="text" name="perfil_alunos" id="perfil_alunos" placeholder="Ex: 10 a 12 anos"
                            value="<?= htmlspecialchars($dados['perfil_alunos'] ?? '') ?>" required>
                        <?php if (isset($erros['perfil_alunos'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['perfil_alunos']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="campo">
                    <label for="nome_responsavel">Nome do Resposável:</label>
                    <input type="text" name="nome_responsavel" id="nome_responsavel" placeholder="Ex: Bruna Maria"
                        value="<?= htmlspecialchars($dados['nome_responsavel'] ?? '') ?>" required>
                    <?php if (isset($erros['nome_responsavel'])): ?>
                        <span class="text-danger"><?= htmlspecialchars($erros['nome_responsavel']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="grid-dupla">
                    <div class="campo">
                        <label for="telefone_responsavel">Telefone do Resposável:</label>
                        <input type="text" name="telefone_responsavel" id="telefone_responsavel" placeholder="Ex: (35) 99999-9999"
                            value="<?= htmlspecialchars($dados['telefone_responsavel'] ?? '') ?>" required>
                        <?php if (isset($erros['telefone_responsavel'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['telefone_responsavel']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="campo">
                        <label for="email_responsavel">Email do Resposável:</label>
                        <input type="email" name="email_responsavel" id="email_responsavel" placeholder="Ex: exemplo@escola.com"
                            value="<?= htmlspecialchars($dados['email_responsavel'] ?? '') ?>" required>
                        <?php if (isset($erros['email_responsavel'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['email_responsavel']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>



                <button type="submit">Solicitar Visita</button>
            </form>
        </div>
    </div>
</main>

<?php
require "includes/footer.php";
?>