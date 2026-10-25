<?php
require __DIR__ . '/dados/livros-demo.php';

$paginaAtual = 'meus-livros';
$nomesStatus = [
    'quero_ler' => 'Quero ler',
    'lendo' => 'Lendo',
    'lido' => 'Lidos',
];

$statusAtual = $_GET['status'] ?? 'lido';
if (!isset($nomesStatus[$statusAtual])) {
    $statusAtual = 'lido';
}

$livrosFiltrados = array_values(array_filter(
    $livros,
    fn($livro) => $livro['status'] === $statusAtual
));
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meus livros | Littera</title>
  <link rel="stylesheet" href="assets/css/Recomendacao-MeusLivros.css">
</head>
<body>
  <?php require __DIR__ . '/includes/cabecalho.php'; ?>

  <main class="page-wrap my-books">
    <p class="kicker">A SUA ESTANTE</p>
    <h1>Meus livros</h1>

    <nav class="shelf-tabs" aria-label="Filtrar livros por status">
      <?php foreach ($nomesStatus as $chave => $nome): ?>
        <?php
        $contagem = count(array_filter(
            $livros,
            fn($livro) => $livro['status'] === $chave
        ));
        ?>
        <a
          class="<?= $statusAtual === $chave ? 'on' : '' ?>"
          href="?status=<?= escapar($chave) ?>"
          <?= $statusAtual === $chave ? 'aria-current="page"' : '' ?>
        >
          <?= escapar($nome) ?>
          <span><?= $contagem ?></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <?php if ($livrosFiltrados): ?>
      <div class="my-grid">
        <?php foreach ($livrosFiltrados as $livro): ?>
          <?php require __DIR__ . '/includes/card-livro.php'; ?>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty-state">
        <h2>Nenhum livro nesta lista ainda.</h2>
        <p>Quando adicionar livros, eles aparecerão aqui.</p>
        <a class="accent" href="recomendacoes.php">Explorar recomendações →</a>
      </div>
    <?php endif; ?>
  </main>

  <script src="assets/js/Recomendacao-MeusLivros.js" defer></script>
</body>
</html>
