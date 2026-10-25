<?php
require __DIR__ . '/dados/livros-demo.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
} else {
    $statusSalvo = $_SESSION['status_livros'][$id] ?? null;
    if (is_string($statusSalvo) && in_array($statusSalvo, ['quero_ler', 'lendo', 'lido'], true)) {
        $livro['status'] = $statusSalvo;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $acao = $_POST['acao'] ?? '';
        $token = $_POST['csrf_token'] ?? '';
        $tokenSessao = $_SESSION['csrf_token'] ?? '';

        if (!is_string($token) || !is_string($tokenSessao) || !hash_equals($tokenSessao, $token)) {
            http_response_code(400);
            $erroAcao = 'A sessão expirou. Atualize a página e tente novamente.';
        } elseif ($acao === 'status') {
            $status = $_POST['status'] ?? '';
            if (!is_string($status) || !in_array($status, ['quero_ler', 'lendo', 'lido'], true)) {
                http_response_code(400);
                $erroAcao = 'Selecione um status válido.';
            } else {
                $_SESSION['status_livros'][$id] = $status;
                header('Location: livro.php?id=' . $id . '&salvo=1', true, 303);
                exit;
            }
        } elseif ($acao === 'avaliar') {
            $nota = filter_var($_POST['nota'] ?? null, FILTER_VALIDATE_INT);
            $texto = $_POST['texto'] ?? '';
            $texto = is_string($texto) ? trim($texto) : '';

            $quantidadeCaracteres = preg_match_all('/./us', $texto);
            if ($nota === false || $nota < 1 || $nota > 5
                || $quantidadeCaracteres === false || $quantidadeCaracteres > 1000) {
                http_response_code(400);
                $erroAcao = 'Escolha uma nota de 1 a 5 e limite o comentário a 1000 caracteres.';
            } else {
                $_SESSION['avaliacoes_livros'][$id][] = [
                    'nota' => $nota,
                    'texto' => $texto,
                    'data' => date('d/m/Y H:i'),
                ];
                header('Location: livro.php?id=' . $id . '&avaliado=1#avaliacoes', true, 303);
                exit;
            }
        } else {
            http_response_code(400);
            $erroAcao = 'Ação inválida.';
        }
    }
}

if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];
$avaliacoesUsuario = $_SESSION['avaliacoes_livros'][$id] ?? [];
if (!is_array($avaliacoesUsuario)) {
    $avaliacoesUsuario = [];
}
$totalAvaliacoes = (int) ($livro['avaliacoes'] ?? 0);
$somaNotas = (float) ($livro['nota'] ?? 0) * $totalAvaliacoes;
foreach ($avaliacoesUsuario as $avaliacao) {
    if (is_array($avaliacao) && isset($avaliacao['nota']) && is_numeric($avaliacao['nota'])) {
        $somaNotas += (int) $avaliacao['nota'];
        $totalAvaliacoes++;
    }
}
$notaMedia = $totalAvaliacoes > 0 ? $somaNotas / $totalAvaliacoes : 0;
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
    <?php if (!empty($erroAcao)): ?>
      <p class="empty-state" role="alert"><?= escapar($erroAcao) ?></p>
    <?php elseif (isset($_GET['salvo'])): ?>
      <p class="empty-state" role="status">Status da leitura atualizado.</p>
    <?php elseif (isset($_GET['avaliado'])): ?>
      <p class="empty-state" role="status">Sua avaliação foi salva nesta sessão.</p>
    <?php endif; ?>

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
            <span class="stars"><?= estrelas($notaMedia) ?></span>
            <b><?= number_format($notaMedia, 1, ',', '.') ?></b>
            <span class="muted"><?= $totalAvaliacoes ?> avaliações</span>
          </div>

          <p class="detail-about">
            <?= escapar($livro['sinopse']) ?>
            Uma leitura para ser compartilhada, debatida e lembrada.
          </p>

          <p class="library <?= $livro['disponivel'] ? 'available' : '' ?>">
            ● <?= $livro['disponivel'] ? 'Disponível na biblioteca' : 'Indisponível no momento' ?>
          </p>

          <div class="actions">
            <a class="accent" href="#form-avaliacao">Avaliar livro</a>
            <form method="post">
              <input type="hidden" name="acao" value="status">
              <input type="hidden" name="csrf_token" value="<?= escapar($csrfToken) ?>">
              <label class="sr-only" for="status-livro">Status da leitura</label>
              <select id="status-livro" name="status">
                <option value="quero_ler" <?= $livro['status'] === 'quero_ler' ? 'selected' : '' ?>>Quero ler</option>
                <option value="lendo" <?= $livro['status'] === 'lendo' ? 'selected' : '' ?>>Lendo</option>
                <option value="lido" <?= $livro['status'] === 'lido' ? 'selected' : '' ?>>Lido</option>
              </select>
              <button type="submit">Salvar na estante</button>
            </form>
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
          <h2 id="avaliacoes">Avaliações da comunidade</h2>

          <?php foreach (array_merge($resenhasDemo, array_map(
              static fn($avaliacao) => [
                  'nome' => 'Você',
                  'nota' => (int) $avaliacao['nota'],
                  'texto' => $avaliacao['texto'],
                  'data' => $avaliacao['data'],
                  'curtidas' => 0,
              ],
              $avaliacoesUsuario
          )) as $indice => $resenha): ?>
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

          <form class="review-form" id="form-avaliacao" method="post">
            <input type="hidden" name="acao" value="avaliar">
            <input type="hidden" name="csrf_token" value="<?= escapar($csrfToken) ?>">
            <label for="nota-avaliacao">Sua nota</label>
            <select id="nota-avaliacao" name="nota" required>
              <option value="">Escolha de 1 a 5 estrelas</option>
              <?php for ($nota = 5; $nota >= 1; $nota--): ?>
                <option value="<?= $nota ?>"><?= $nota ?> estrela<?= $nota === 1 ? '' : 's' ?></option>
              <?php endfor; ?>
            </select>
            <label for="texto-avaliacao">Comentário (opcional, até 1000 caracteres)</label>
            <textarea id="texto-avaliacao" name="texto" maxlength="1000" rows="4"></textarea>
            <button class="accent" type="submit">Salvar avaliação</button>
          </form>
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
