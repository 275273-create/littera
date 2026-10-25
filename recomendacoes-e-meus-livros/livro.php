<?php
require __DIR__ . '/dados/livros-demo.php';

$paginaAtual = '';
$inicioHref = '../littera-landing/index.php';
$id = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT) ?: 0;
$livro = null;

foreach ($livros as $item) {
    if ($item['id'] === $id) {
        $livro = $item;
        break;
    }
}

if (!$livro) {
    http_response_code(404);
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $livro ? escapar($livro['titulo']) . ' | Littera' : 'Livro não encontrado | Littera' ?></title>
  <link rel="stylesheet" href="assets/css/Recomendacao-MeusLivros.css">
</head>
<body>
  <?php require __DIR__ . '/includes/cabecalho.php'; ?>

  <main class="detail-page">
    <?php if (!$livro): ?>
      <div class="empty-state">
        <h1>Livro não encontrado.</h1>
        <a href="meus-livros.php">Voltar para Meus livros</a>
      </div>
    <?php else: ?>
      <section class="detail-hero">
        <img
          class="detail-cover"
          src="<?= escapar(urlCapa($livro)) ?>"
          alt="Capa de <?= escapar($livro['titulo']) ?>"
        >

        <div class="detail-copy">
          <p class="kicker">
            <?= escapar(strtoupper($livro['categoria'])) ?> · <?= escapar($livro['ano']) ?>
          </p>
          <h1><?= escapar($livro['titulo']) ?></h1>
          <p class="by">por <?= escapar($livro['autor']) ?></p>

          <div class="book-rating">
            <span class="stars"><?= estrelas((float) $livro['nota']) ?></span>
            <b><?= number_format((float) $livro['nota'], 1, ',', '.') ?></b>
            <span class="muted"><?= (int) $livro['avaliacoes'] ?> avaliações</span>
          </div>

          <p class="detail-about">
            <?= escapar($livro['sinopse']) ?>
            Uma leitura para ser compartilhada, debatida e lembrada.
          </p>

          <p class="library <?= $livro['disponivel'] ? 'available' : '' ?>">
            ● <?= $livro['disponivel'] ? 'Disponível na biblioteca' : 'Indisponível no momento' ?>
          </p>

          <div class="actions">
            <button class="accent" type="button">Avaliar livro</button>
            <a href="meus-livros.php?status=lido">✓ Marcar como lido</a>
            <a href="meus-livros.php?status=quero_ler">＋ Minha lista</a>
          </div>
        </div>

        <aside class="info-card">
          <p class="kicker">INFORMAÇÕES</p>
          <dl>
            <dt>Autor</dt>
            <dd><?= escapar($livro['autor']) ?></dd>
            <dt>Categoria</dt>
            <dd><?= escapar($livro['categoria']) ?></dd>
            <dt>Ano</dt>
            <dd><?= escapar($livro['ano']) ?></dd>
            <dt>Editora</dt>
            <dd>Informação não disponível</dd>
          </dl>

          <p class="kicker">AVALIADO POR</p>
          <div class="avatar-row" aria-label="Leitores que avaliaram">
            <span>A</span><span>R</span><span>B</span><span>C</span><span>M</span><span>L</span>
          </div>
        </aside>
      </section>

      <section class="detail-columns">
        <div>
          <p class="kicker">SOBRE O LIVRO</p>
          <h2>Uma história para atravessar mundos.</h2>
          <p class="synopsis">
            <?= escapar($livro['sinopse']) ?>
            É uma daquelas obras que ganha novas camadas a cada conversa e se transforma
            quando vista pelos olhos de outros leitores.
          </p>
        </div>

        <section class="community-reviews">
          <p class="kicker">CONVERSA EM CURSO</p>
          <h2>Avaliações da comunidade</h2>

          <?php foreach ($resenhasDemo as $indice => $resenha): ?>
            <article class="review">
              <span class="face face-<?= $indice ?>">
                <?= escapar(substr($resenha['nome'], 0, 1)) ?>
              </span>
              <div>
                <b><?= escapar($resenha['nome']) ?></b>
                <small><?= escapar($resenha['data']) ?></small>
                <p class="stars"><?= estrelas((float) $resenha['nota']) ?></p>
                <q><?= escapar($resenha['texto']) ?></q>
                <footer>♡ <?= (int) $resenha['curtidas'] ?> curtidas</footer>
              </div>
            </article>
          <?php endforeach; ?>
        </section>

        <aside>
          <p class="kicker">CONTINUE EXPLORANDO</p>
          <?php foreach (array_slice($livros, 4, 3) as $outro): ?>
            <a class="mini-book" href="livro.php?id=<?= (int) $outro['id'] ?>">
              <img src="<?= escapar(urlCapa($outro)) ?>" alt="">
              <span>
                <b><?= escapar($outro['titulo']) ?></b>
                <small><?= escapar($outro['autor']) ?></small>
              </span>
            </a>
          <?php endforeach; ?>
        </aside>
      </section>
    <?php endif; ?>
  </main>

  <script src="assets/js/Recomendacao-MeusLivros.js" defer></script>
</body>
</html>
