<?php
$paginaAtual = $paginaAtual ?? '';
$baseNavegacao = $baseNavegacao ?? '';
$inicioHref = $inicioHref ?? $baseNavegacao . 'index.php';
$meusLivrosHref = $meusLivrosHref ?? $baseNavegacao . 'meus-livros.php';
$recomendacoesHref = $recomendacoesHref ?? $baseNavegacao . 'recomendacoes.php';
$comunidadeHref = $comunidadeHref ?? $baseNavegacao . '../comunidade/index.php';
$buscaAction = $buscaAction ?? $recomendacoesHref;
?>
<header class="site-head">
  <a class="wordmark" href="<?= htmlspecialchars($inicioHref, ENT_QUOTES, 'UTF-8') ?>" aria-label="Littera, início">
    <span class="logo-dots" aria-hidden="true"><i></i><i></i><i></i></span>
    LITTERA
  </a>

  <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="navegacao">
    ☰ <span class="sr-only">Abrir navegação</span>
  </button>

  <nav id="navegacao" class="main-nav">
    <a href="<?= htmlspecialchars($inicioHref, ENT_QUOTES, 'UTF-8') ?>">INÍCIO</a>
    <a href="#" aria-label="Explorar (página a integrar)">EXPLORAR</a>
    <a class="<?= $paginaAtual === 'meus-livros' ? 'on' : '' ?>" href="<?= htmlspecialchars($meusLivrosHref, ENT_QUOTES, 'UTF-8') ?>">MEUS LIVROS</a>
    <a class="<?= $paginaAtual === 'recomendacoes' ? 'on' : '' ?>" href="<?= htmlspecialchars($recomendacoesHref, ENT_QUOTES, 'UTF-8') ?>">RECOMENDAÇÕES</a>
    <a class="<?= $paginaAtual === 'comunidade' ? 'on' : '' ?>" href="<?= htmlspecialchars($comunidadeHref, ENT_QUOTES, 'UTF-8') ?>">COMUNIDADE</a>
  </nav>

  <form class="header-search" action="<?= htmlspecialchars($buscaAction, ENT_QUOTES, 'UTF-8') ?>" method="get">
    <label class="sr-only" for="busca">Buscar livros</label>
    <input id="busca" name="busca" placeholder="Buscar livros">
    <button type="submit" aria-label="Buscar">⌕</button>
  </form>

  <button class="notice" type="button" aria-label="Notificações">♧<i></i></button>
  <span class="user"><span class="user-avatar">JG</span><b>João Gabriel</b></span>
</header>
