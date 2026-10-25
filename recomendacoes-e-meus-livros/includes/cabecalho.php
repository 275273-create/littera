<?php
$paginaAtual = $paginaAtual ?? '';
?>
<header class="site-head">
  <a class="wordmark" href="index.php" aria-label="Littera, início">
    <span class="logo-dots" aria-hidden="true"><i></i><i></i><i></i></span>
    LITTERA
  </a>

  <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="navegacao">
    ☰ <span class="sr-only">Abrir navegação</span>
  </button>

  <nav id="navegacao" class="main-nav">
    <a href="#" aria-label="Início (página a integrar)">INÍCIO</a>
    <a href="#" aria-label="Explorar (página a integrar)">EXPLORAR</a>
    <a class="<?= $paginaAtual === 'meus-livros' ? 'on' : '' ?>" href="meus-livros.php">MEUS LIVROS</a>
    <a class="<?= $paginaAtual === 'recomendacoes' ? 'on' : '' ?>" href="recomendacoes.php">RECOMENDAÇÕES</a>
    <a href="#" aria-label="Comunidade (página a integrar)">COMUNIDADE</a>
  </nav>

  <form class="header-search" action="recomendacoes.php" method="get">
    <label class="sr-only" for="busca">Buscar livros</label>
    <input id="busca" name="busca" placeholder="Buscar livros">
    <button type="submit" aria-label="Buscar">⌕</button>
  </form>

  <button class="notice" type="button" aria-label="Notificações">♧<i></i></button>
  <span class="user"><span class="user-avatar">JG</span><b>João Gabriel</b></span>
</header>
