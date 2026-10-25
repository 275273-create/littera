<?php
require __DIR__ . '/dados/livros-demo.php';

$paginaAtual = 'recomendacoes';
$inicioHref = '../littera-landing/index.php';
$busca = $_GET['busca'] ?? '';
$busca = is_string($busca) ? trim($busca) : '';

$livrosBusca = [];
if ($busca !== '') {
    $livrosBusca = array_values(array_filter(
        $livros,
        fn($livro) => str_contains(
            strtolower($livro['titulo'] . ' ' . $livro['autor']),
            strtolower($busca)
        )
    ));
}

$recomendados = array_slice(array_values(array_filter(
    $livros,
    fn($livro) => in_array($livro['id'], [3, 7, 13, 14, 1], true)
)), 0, 5);

$populares = array_slice(array_values(array_filter(
    $livros,
    fn($livro) => in_array($livro['id'], [8, 6, 2, 11, 4], true)
)), 0, 5);
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recomendações | Littera</title>
  <link rel="stylesheet" href="assets/css/Recomendacao-MeusLivros.css">
</head>
<body>
  <?php require __DIR__ . '/includes/cabecalho.php'; ?>

  <main class="page-wrap recommendations">
    <p class="kicker">SELECIONADO PARA VOCÊ</p>
    <h1>Descubra sua próxima leitura</h1>
    <p class="muted">Sugestões de demonstração inspiradas no protótipo.</p>

    <?php if ($busca !== ''): ?>
      <section class="recommend-section">
        <div class="section-title">
          <h2>Resultados para “<?= escapar($busca) ?>”</h2>
        </div>

        <?php if ($livrosBusca): ?>
          <div class="my-grid">
            <?php foreach ($livrosBusca as $livro): ?>
              <?php require __DIR__ . '/../includes/card-livro.php'; ?>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="empty-state">
            <h2>Não encontramos nenhum livro.</h2>
            <p>Tente buscar por outro título ou autor.</p>
          </div>
        <?php endif; ?>
      </section>
    <?php endif; ?>

    <section class="recommend-section">
      <div class="section-title">
        <div>
          <p class="kicker">A PARTIR DOS SEUS LIVROS AVALIADOS</p>
          <h2>Porque você gostou de O Hobbit</h2>
        </div>
      </div>
      <div class="recommend-grid">
        <?php foreach ($recomendados as $livro): ?>
          <?php require __DIR__ . '/../includes/card-livro.php'; ?>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="recommend-section">
      <div class="section-title">
        <div>
          <p class="kicker">EM MOVIMENTO</p>
          <h2>Populares na comunidade</h2>
        </div>
      </div>
      <div class="recommend-grid">
        <?php foreach ($populares as $livro): ?>
          <?php require __DIR__ . '/../includes/card-livro.php'; ?>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <script src="assets/js/Recomendacao-MeusLivros.js" defer></script>
</body>
</html>
