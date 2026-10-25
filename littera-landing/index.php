<?php
require __DIR__ . '/config/login.php';

$loginDestino = htmlspecialchars($loginUrl, ENT_QUOTES, 'UTF-8');
$atributoLogin = $loginDisponivel ? '' : 'data-login-pendente aria-disabled="true"';
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Conheça o Littera, um espaço para descobrir livros, acompanhar leituras e compartilhar opiniões.">
  <title>Littera — Toda leitura tem uma história</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="cabecalho">
    <a class="marca" href="#inicio" aria-label="Littera, início"><span class="marca-pontos" aria-hidden="true"><i></i><i></i><i></i></span>LITTERA</a>
    <button class="botao-menu" type="button" aria-expanded="false" aria-controls="menu-principal" aria-label="Abrir menu">☰</button>
    <nav class="menu" id="menu-principal" aria-label="Navegação principal">
      <a href="#inicio">Início</a>
      <a href="#sobre">Sobre a plataforma</a>
      <a href="#funcionalidades">Funcionalidades</a>
      <a href="#comunidade">Comunidade</a>
    </nav>
    <div class="acoes-cabecalho">
      <a class="link-entrar" href="<?= $loginDestino ?>" <?= $atributoLogin ?>>Entrar</a>
      <a class="botao botao-claro" href="#funcionalidades">Conhecer o Littera <span aria-hidden="true">↗</span></a>
    </div>
  </header>

  <main>
    <section class="hero" id="inicio">
      <div class="hero-texto">
        <p class="sobretitulo"><span></span> UM ESPAÇO PARA QUEM LÊ</p>
        <h1>Toda leitura tem uma história. <em>Compartilhe a sua.</em></h1>
        <p class="hero-resumo">
          O Littera é um espaço para descobrir livros, registrar suas leituras e compartilhar
          opiniões com pessoas que também encontram nas histórias uma forma de se conectar
          com o mundo.
        </p>
        <div class="hero-acoes">
          <a class="botao botao-verde" href="#funcionalidades">Conhecer a plataforma <span aria-hidden="true">↓</span></a>
          <a class="botao botao-contorno" href="<?= $loginDestino ?>" <?= $atributoLogin ?>>Entrar no Littera <span aria-hidden="true">→</span></a>
        </div>
        <p class="nota-projeto">Um projeto acadêmico para aproximar leitores e histórias.</p>
      </div>

      <div class="hero-arte" aria-label="Composição ilustrativa de livros feita para apresentar o Littera">
        <div class="orbita orbita-um"></div><div class="orbita orbita-dois"></div>
        <span class="brilho brilho-um" aria-hidden="true">✳</span><span class="brilho brilho-dois" aria-hidden="true">✦</span>
        <article class="capa-ilustrada capa-verde"><span>UMA HISTÓRIA<br>COMEÇA AQUI</span><i class="folha"></i><small>LITTERA · LEITURAS</small></article>
        <article class="capa-ilustrada capa-creme"><span>ENTRE<br>PÁGINAS</span><i class="sol"></i><small>DESCOBRIR · LER · TROCAR</small></article>
        <article class="capa-ilustrada capa-laranja"><span>OUTRAS<br>PERSPECTIVAS</span><i class="arco"></i><small>HISTÓRIAS QUE CONECTAM</small></article>
        <p class="arte-legenda">Composição ilustrativa · não representa telas do sistema</p>
      </div>
    </section>

    <section class="sobre secao" id="sobre">
      <div class="sobre-selo" aria-hidden="true"><span>LER</span><b>✳</b><span>JUNTOS</span></div>
      <div class="sobre-texto">
        <p class="sobretitulo">O QUE É O LITTERA?</p>
        <h2>Leituras que continuam <em>depois da última página.</em></h2>
        <p>
          O Littera nasceu da ideia de tornar a leitura uma experiência mais compartilhada.
          Mais do que acompanhar livros, queremos criar um espaço onde leitores possam
          descobrir novas obras, registrar suas experiências e conhecer diferentes
          perspectivas sobre cada história.
        </p>
      </div>
    </section>

    <section class="funcionalidades secao" id="funcionalidades">
      <div class="cabecalho-secao">
        <div>
          <p class="sobretitulo">A SUA JORNADA DE LEITURA</p>
          <h2>Um lugar para cada <em>capítulo.</em></h2>
        </div>
        <p>Da curiosidade pela próxima história até a vontade de conversar sobre a que acabou de ler.</p>
      </div>
      <div class="grade-recursos">
        <a class="cartao-recurso" href="../recomendacoes-e-meus-livros/recomendacoes.php">
          <span class="icone-recurso">⌕</span>
          <p class="numero-recurso">01 / DESCOBRIR</p>
          <h3>Descubra livros</h3>
          <p>Explore obras e encontre novas histórias para levar com você.</p>
          <span class="seta-recurso" aria-hidden="true">↗</span>
        </a>
        <a class="cartao-recurso" href="../recomendacoes-e-meus-livros/meus-livros.php">
          <span class="icone-recurso">▤</span>
          <p class="numero-recurso">02 / ORGANIZAR</p>
          <h3>Meus livros</h3>
          <p>Organize e acompanhe os livros que fazem parte da sua jornada.</p>
          <span class="seta-recurso" aria-hidden="true">↗</span>
        </a>
        <a class="cartao-recurso" href="../recomendacoes-e-meus-livros/livro.php?id=5">
          <span class="icone-recurso">✎</span>
          <p class="numero-recurso">03 / COMPARTILHAR</p>
          <h3>Compartilhe opiniões</h3>
          <p>Registre suas impressões e avaliações sobre as obras que leu.</p>
          <span class="seta-recurso" aria-hidden="true">↗</span>
        </a>
        <a class="cartao-recurso" href="../comunidade/index.php">
          <span class="icone-recurso">✳</span>
          <p class="numero-recurso">04 / CONECTAR</p>
          <h3>Conheça perspectivas</h3>
          <p>Descubra livros pelas experiências e recomendações de outros leitores.</p>
          <span class="seta-recurso" aria-hidden="true">↗</span>
        </a>
      </div>
    </section>

    <section class="comunidade" id="comunidade">
      <div class="comunidade-grafismo" aria-hidden="true"><span class="linha-livro"></span><span class="ponto-comunidade"></span><span class="linha-livro linha-dois"></span></div>
      <div class="comunidade-texto">
        <p class="sobretitulo">A LEITURA CONECTA PESSOAS</p>
        <h2>Uma história. <em>Muitas maneiras de sentir.</em></h2>
        <p>Um livro pode significar coisas diferentes para cada pessoa. No Littera, cada opinião é uma oportunidade de descobrir uma nova perspectiva.</p>
      </div>
      <div class="troca-ilustrada" aria-label="Ilustração de troca de ideias entre leitores">
        <div class="fala fala-um">
          “Eu nunca tinha pensado por esse lado.”
          <span>uma nova perspectiva</span>
        </div>
        <div class="fala fala-dois">
          “Essa história ficou comigo.”
          <span>uma leitura compartilhada</span>
        </div>
        <small>ILUSTRAÇÃO DE UMA CONVERSA ENTRE LEITORES</small>
      </div>
    </section>

    <section class="chamada-final">
      <p class="sobretitulo">ABRA ESPAÇO PARA A PRÓXIMA</p>
      <h2>Sua próxima história <em>começa aqui.</em></h2>
      <p>Descubra livros, compartilhe suas experiências e faça parte de uma comunidade que encontra significado em cada página.</p>
      <a class="botao botao-verde" href="<?= $loginDestino ?>" <?= $atributoLogin ?>>Entrar no Littera <span aria-hidden="true">→</span></a>
      <?php if (!$loginDisponivel): ?><p class="aviso-login" id="login-pendente" role="status">O endereço da tela de login será conectado quando estiver pronto.</p><?php endif; ?>
    </section>
  </main>

  <footer class="rodape">
    <div class="rodape-marca">
      <a class="marca" href="#inicio">
        <span class="marca-pontos" aria-hidden="true"><i></i><i></i><i></i></span>
        LITTERA
      </a>
      <p>Histórias aproximam leitores.<br>Leitores aproximam histórias.</p>
    </div>
    <nav class="rodape-links" aria-label="Links do rodapé">
      <a href="#inicio">Início</a>
      <a href="#sobre">Sobre</a>
      <a href="#funcionalidades">Funcionalidades</a>
      <a href="#comunidade">Comunidade</a>
    </nav>
    <div class="rodape-nota">
      <p>Projeto acadêmico</p>
      <small>© <?= date('Y') ?> Littera · Feito para compartilhar leituras.</small>
    </div>
  </footer>
  <script src="js/script.js" defer></script>
</body>
</html>
