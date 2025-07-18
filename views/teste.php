<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Área Restrita - Museu</title>
</head>
<body>
    <h1>Bem-vindo à área de gerenciamento, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
    <p>Seu e-mail: <?= htmlspecialchars($_SESSION['usuario_email']) ?></p>
    <p><a href="/ProjetoMuseu/index.php?page=logout">Sair</a></p>
</body>
</html>
