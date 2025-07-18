<?php
$erros = $erros ?? [];
$erroLogin = $erroLogin ?? '';
$dados = $dados ?? [];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - Museu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProjetoMuseu/static/css/login.css">
</head>
<body>
    <div class="page-container">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="left-box"></div>
                <div class="right-box">
                    <h2>LOGIN</h2>
                    <p class="text-muted">Entre para continuar</p>

                    <?php if (!empty($erroLogin)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($erroLogin) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="/ProjetoMuseu/routerAuth.php?page=login">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= htmlspecialchars($dados['email'] ?? '') ?>" required>
                            <?php if (isset($erros['email'])): ?>
                                <span class="text-danger"><?= htmlspecialchars($erros['email']) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                            <?php if (isset($erros['senha'])): ?>
                                <div class="text-danger"><?= htmlspecialchars($erros['senha']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-success" type="submit">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
