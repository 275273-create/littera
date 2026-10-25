<?php
// Backend simulado. Os dados ficam na sessão e não usam banco de dados.
session_start();
$paginaAtual = '';
$inicioHref = '../littera-landing/index.php';
$meusLivrosHref = '../recomendacoes-e-meus-livros/meus-livros.php';
$recomendacoesHref = '../recomendacoes-e-meus-livros/recomendacoes.php';
$comunidadeHref = '../comunidade/index.php';
$buscaAction = $recomendacoesHref;

if (!isset($_SESSION['avaliacoes'])) $_SESSION['avaliacoes'] = [];
if (!isset($_SESSION['minha_lista'])) $_SESSION['minha_lista'] = false;
if (!isset($_SESSION['lido'])) $_SESSION['lido'] = false;
if (!isset($_SESSION['curtidas'])) $_SESSION['curtidas'] = [24, 30];

if (isset($_GET['acao'])) {
    header('Content-Type: application/json; charset=utf-8');
    $acao = $_GET['acao'];

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $acao === 'livro') {
        echo json_encode([
            'avaliacoes' => $_SESSION['avaliacoes'],
            'minha_lista' => $_SESSION['minha_lista'],
            'lido' => $_SESSION['lido'],
            'curtidas' => $_SESSION['curtidas']
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = json_decode(file_get_contents('php://input'), true) ?? [];

        if ($acao === 'avaliar') {
            $nota = (int)($dados['nota'] ?? 0);
            $comentario = trim($dados['comentario'] ?? '');
            if ($nota < 1 || $nota > 5) {
                http_response_code(400);
                echo json_encode(['mensagem' => 'Escolha uma nota de 1 a 5.'], JSON_UNESCAPED_UNICODE);
                exit;
            }
            $_SESSION['avaliacoes'][] = ['nome' => 'João Gabriel', 'nota' => $nota, 'comentario' => $comentario];
            echo json_encode(['mensagem' => 'Sua avaliação foi salva nesta sessão.'], JSON_UNESCAPED_UNICODE);
        } elseif ($acao === 'lista') {
            $_SESSION['minha_lista'] = !$_SESSION['minha_lista'];
            echo json_encode(['mensagem' => $_SESSION['minha_lista'] ? 'Livro adicionado à sua lista.' : 'Livro removido da sua lista.'], JSON_UNESCAPED_UNICODE);
        } elseif ($acao === 'lido') {
            $_SESSION['lido'] = !$_SESSION['lido'];
            echo json_encode(['mensagem' => $_SESSION['lido'] ? 'Livro marcado como lido.' : 'Leitura desmarcada.'], JSON_UNESCAPED_UNICODE);
        } elseif ($acao === 'curtir') {
            $indice = (int)($dados['comentario'] ?? -1);
            if ($indice < 0 || $indice > 1) {
                http_response_code(400);
                echo json_encode(['mensagem' => 'Comentário inválido.'], JSON_UNESCAPED_UNICODE);
                exit;
            }
            $_SESSION['curtidas'][$indice]++;
            echo json_encode(['mensagem' => 'Você curtiu o comentário.'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            echo json_encode(['mensagem' => 'Ação não encontrada.'], JSON_UNESCAPED_UNICODE);
        }
        exit;
    }

    http_response_code(404);
    echo json_encode(['mensagem' => 'Endereço não encontrado.'], JSON_UNESCAPED_UNICODE);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LITTERA - O conto da Aia</title>
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Ícones do Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../includes/cabecalho.css">
  
  <!-- CSS Personalizado -->
  <link rel="stylesheet" href="livro.css">
</head>
<body class="bg-outer">

  <!-- FRAME CENTRAL / CARD TEMA ESCURO -->
  <div class="app-container" id="inicio">
    
    <?php require __DIR__ . '/../includes/cabecalho.php'; ?>

    <!-- BLOCO SUPERIOR: CAPA + DETALHES + INFO -->
    <div class="row g-4 mb-4">
      
      <!-- Imagem do Livro -->
      <div class="col-12 col-md-4 col-lg-3">
        <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&q=80" alt="Capa Milk and Honey" class="book-cover">
      </div>

      <!-- Informações Principais do Livro -->
      <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-between">
        <div>
          <span class="text-secondary-custom small">Ficção • 1985</span>
          <h1 class="book-title">O conto da Aia</h1>
          <p class="author-text">por Margaret Atwood</p>

          <!-- Avaliação de Estrelas -->
          <div class="d-flex align-items-center gap-2 mb-3">
            <div class="star-rating" id="estrelasMedia">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
            <span class="fw-bold text-white small" id="mediaNota">4.9</span>
            <span class="text-secondary-custom small ms-1" id="totalAvaliacoes">83</span>
          </div>

          <!-- Descrição -->
          <p class="description-text">
            Uma obra envolvente, cheia de camadas e perguntas que continuam reverberando muito depois da última página. Uma leitura para ser compartilhada, debatida e lembrada.
          </p>

          <!-- Tag Status Indisponível -->
          <div class="mt-3">
            <span class="badge-indisponivel">
              <span class="dot-red"></span> Indiponível no momento
            </span>
          </div>
        </div>

        <!-- Botões de Ação -->
        <div class="d-flex flex-wrap gap-2 mt-4" id="meus-livros">
          <button class="btn btn-green" id="btnAvaliar">Avaliar livro</button>
          <button class="btn btn-outline-custom" id="btnLido">Marcar como lida</button>
          <button class="btn btn-outline-custom" id="btnLista">+ Minha lista</button>
        </div>
      </div>

      <!-- Card Lateral da Direita (Informações) -->
      <div class="col-12 col-lg-3">
        <div class="info-card">
          <h6 class="info-card-title">INFORMAÇÕES</h6>
          
          <div class="info-row">
            <span class="info-label">Autor</span>
            <span class="info-value">Margaret Atwood</span>
          </div>
          <div class="info-row">
            <span class="info-label">Categoria</span>
            <span class="info-value">Ficção</span>
          </div>
          <div class="info-row">
            <span class="info-label">Ano</span>
            <span class="info-value">1985</span>
          </div>
          <div class="info-row">
            <span class="info-label">Editora</span>
            <span class="info-value">Companhia das Letras</span>
          </div>

          <h6 class="info-card-title mt-4">AVALIADO POR</h6>
          <div class="d-flex gap-1 flex-wrap">
            <div class="avatar-circle avatar-u">U</div>
            <div class="avatar-circle avatar-a">A</div>
            <div class="avatar-circle avatar-i">I</div>
            <div class="avatar-circle avatar-g">G</div>
            <div class="avatar-circle avatar-y">Y</div>
            <div class="avatar-circle avatar-k">K</div>
          </div>
        </div>
      </div>

    </div>

    <hr class="section-divider my-4">

    <!-- BLOCO INFERIOR: SOBRE + COMUNIDADE + CONTINUE EXPLORANDO -->
    <div class="row g-4">
      
      <!-- Coluna: Sobre o Livro -->
      <div class="col-12 col-md-4 col-lg-3" id="explorar">
        <span class="section-subtitle">SOBRE O LIVRO</span>
        <h3 class="section-title">Umas história para atravessar mundo.</h3>
        <p class="text-secondary-custom small mt-3">
          Uma obra envolvente, cheia de camadas e perguntas que continuam reverberando muito depois da última página. É uma daquelas obras que ganha novas camadas a cada conversa e se transforma quando vista pelos olhos de outros leitores.
        </p>
      </div>

      <!-- Coluna: Conversa em curso da comunidade -->
      <div class="col-12 col-md-8 col-lg-6" id="comunidade">
        <span class="section-subtitle">COMVERSA EM CURSO</span>
        <h3 class="section-title mb-4">da comunidade</h3>

        <!-- Comentário 1 -->
        <div class="d-flex gap-3 mb-3">
          <div class="avatar-circle avatar-c flex-shrink-0">C</div>
          <div>
            <div class="d-flex align-items-center gap-2">
              <strong class="text-white small">Carolina</strong>
              <span class="text-secondary-custom extra-small">há 2 horas</span>
            </div>
            <div class="star-rating my-1 star-xs">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="comment-text">
              "Uma leitura excelente. A construção do mundo é tão viva que dá vontade de seguir viagem junto com Bilbo."
            </p>
            <button class="like-button" data-comentario="0"><i class="bi bi-heart me-1"></i><span>24</span> curtidas</button>
          </div>
        </div>

        <div id="avaliacoesNovas"></div>
        <hr class="comment-divider">

        <!-- Comentário 2 -->
        <div class="d-flex gap-3 mt-3">
          <div class="avatar-circle avatar-f flex-shrink-0">F</div>
          <div>
            <div class="d-flex align-items-center gap-2">
              <strong class="text-white small">Fernanda Moura</strong>
              <span class="text-secondary-custom extra-small">há 5 horas</span>
            </div>
            <div class="star-rating my-1 star-xs">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="comment-text">
              "A linguagem é muito bonita e a história prende pela delicadeza. Foi uma das leituras mais marcantes do semestre."
            </p>
            <button class="like-button" data-comentario="1"><i class="bi bi-heart me-1"></i><span>30</span> curtidas</button>
          </div>
        </div>
      </div>

      <!-- Coluna: Continue Explorando -->
      <div class="col-12 col-lg-3" id="recomendacoes">
        <span class="section-subtitle">CONTINUE EXPLORANDO</span>

        <div class="d-flex flex-column gap-3 mt-3" id="listaRecomendacoes">
          
          <div class="d-flex gap-3 align-items-center recommendation-item" role="button" tabindex="0">
            <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=100&q=80" class="mini-cover" alt="Capa">
            <div>
              <h6 class="mb-0 text-white fw-bold small">O conto da Aia</h6>
              <span class="text-secondary-custom extra-small">Margaret Atwood</span>
            </div>
          </div>

          <div class="d-flex gap-3 align-items-center recommendation-item" role="button" tabindex="0">
            <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=100&q=80" class="mini-cover" alt="Capa">
            <div>
              <h6 class="mb-0 text-white fw-bold small">Hábitos Attons</h6>
              <span class="text-secondary-custom extra-small">James Clear</span>
            </div>
          </div>

          <div class="d-flex gap-3 align-items-center recommendation-item" role="button" tabindex="0">
            <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?w=100&q=80" class="mini-cover" alt="Capa">
            <div>
              <h6 class="mb-0 text-white fw-bold small">O Problema dos Três...</h6>
              <span class="text-secondary-custom extra-small">Cixin Liu</span>
            </div>
          </div>

        </div>
        <p id="semResultado" class="text-secondary-custom small mt-2" hidden>Nenhum livro encontrado.</p>
      </div>

    </div>

    <p id="mensagemBackend" class="status-message" aria-live="polite"></p>
  </div>

  <div class="rating-modal" id="modalAvaliacao" aria-hidden="true">
    <div class="rating-box" role="dialog" aria-modal="true" aria-labelledby="tituloAvaliacao">
      <button type="button" class="modal-close" id="fecharAvaliacao" aria-label="Fechar">&times;</button>
      <span class="section-subtitle">SUA OPINIÃO</span>
      <h2 id="tituloAvaliacao">Avaliar livro</h2>
      <p>O que você achou de O conto da Aia?</p>
      <div class="rating-stars" role="group" aria-label="Escolha uma nota em estrelas">
        <button type="button" data-nota="1" aria-label="1 estrela">★</button>
        <button type="button" data-nota="2" aria-label="2 estrelas">★</button>
        <button type="button" data-nota="3" aria-label="3 estrelas">★</button>
        <button type="button" data-nota="4" aria-label="4 estrelas">★</button>
        <button type="button" data-nota="5" aria-label="5 estrelas">★</button>
      </div>
      <label for="comentarioAvaliacao">Comentário (opcional)</label>
      <textarea id="comentarioAvaliacao" rows="3" placeholder="Escreva o que achou do livro..."></textarea>
      <div class="rating-actions">
        <button type="button" class="btn btn-outline-custom" id="cancelarAvaliacao">Cancelar</button>
        <button type="button" class="btn btn-green" id="enviarAvaliacao">Enviar avaliação</button>
      </div>
      <p id="erroAvaliacao" class="rating-error" aria-live="polite"></p>
    </div>
  </div>

  <!-- Bootstrap JS (para funcionar o menu do celular) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>
  <script>
    const mensagem = document.getElementById('mensagemBackend');

    function mostrarMensagem(texto) {
      mensagem.textContent = texto;
      mensagem.classList.add('visivel');
    }

    async function enviarAcao(acao, dados = {}) {
      try {
        const resposta = await fetch('livro.php?acao=' + acao, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(dados)
        });
        const resultado = await resposta.json();
        if (!resposta.ok) throw new Error(resultado.mensagem);
        mostrarMensagem(resultado.mensagem);
        carregarDados();
      } catch (erro) {
        mostrarMensagem(erro.message || 'Não foi possível conectar ao PHP. Abra livro.php pelo servidor PHP.');
      }
    }

    async function carregarDados() {
      try {
        const resposta = await fetch('livro.php?acao=livro');
        const dados = await resposta.json();
        document.getElementById('btnLista').textContent = dados.minha_lista ? '✓ Na minha lista' : '+ Minha lista';
        document.getElementById('btnLista').classList.toggle('selecionado', dados.minha_lista);
        document.getElementById('btnLido').textContent = dados.lido ? '✓ Livro lido' : 'Marcar como lida';
        document.getElementById('btnLido').classList.toggle('selecionado', dados.lido);
        document.querySelectorAll('.like-button').forEach(function(botao) {
          botao.querySelector('span').textContent = dados.curtidas[botao.dataset.comentario];
        });
        if (dados.avaliacoes.length > 0) {
          const notas = dados.avaliacoes.map(function(item) { return Number(item.nota); });
          const media = (4.9 * 83 + notas.reduce((a, b) => a + b, 0)) / (83 + notas.length);
          document.getElementById('mediaNota').textContent = media.toFixed(1);
          document.getElementById('totalAvaliacoes').textContent = String(83 + notas.length);
          const area = document.getElementById('avaliacoesNovas');
          area.innerHTML = '';
          dados.avaliacoes.slice().reverse().forEach(function(item) {
            const cartao = document.createElement('div');
            cartao.className = 'review-card';
            const nome = document.createElement('strong');
            nome.textContent = item.nome + ' · ' + '★'.repeat(item.nota);
            const texto = document.createElement('p');
            texto.textContent = item.comentario || 'Avaliação sem comentário.';
            cartao.append(nome, texto);
            area.appendChild(cartao);
          });
        }
      } catch (erro) {
        mostrarMensagem('Abra esta página em um servidor PHP para ativar as funções.');
      }
    }

    let notaEscolhida = 0;
    const modalAvaliacao = document.getElementById('modalAvaliacao');
    const botoesEstrela = document.querySelectorAll('.rating-stars button');

    function fecharModalAvaliacao() {
      modalAvaliacao.classList.remove('aberto');
      modalAvaliacao.setAttribute('aria-hidden', 'true');
    }

    function atualizarEstrelas(nota) {
      botoesEstrela.forEach(function(estrela) {
        estrela.classList.toggle('ativa', Number(estrela.dataset.nota) <= nota);
      });
    }

    document.getElementById('btnAvaliar').addEventListener('click', function() {
      modalAvaliacao.classList.add('aberto');
      modalAvaliacao.setAttribute('aria-hidden', 'false');
      document.getElementById('erroAvaliacao').textContent = '';
    });
    botoesEstrela.forEach(function(estrela) {
      estrela.addEventListener('click', function() {
        notaEscolhida = Number(estrela.dataset.nota);
        atualizarEstrelas(notaEscolhida);
        document.getElementById('erroAvaliacao').textContent = '';
      });
    });
    document.getElementById('enviarAvaliacao').addEventListener('click', function() {
      if (notaEscolhida === 0) {
        document.getElementById('erroAvaliacao').textContent = 'Selecione as estrelas para avaliar.';
        return;
      }
      const comentario = document.getElementById('comentarioAvaliacao').value.trim();
      fecharModalAvaliacao();
      enviarAcao('avaliar', { nota: notaEscolhida, comentario: comentario });
      notaEscolhida = 0;
      atualizarEstrelas(0);
      document.getElementById('comentarioAvaliacao').value = '';
    });
    document.getElementById('fecharAvaliacao').addEventListener('click', fecharModalAvaliacao);
    document.getElementById('cancelarAvaliacao').addEventListener('click', fecharModalAvaliacao);
    modalAvaliacao.addEventListener('click', function(evento) {
      if (evento.target === modalAvaliacao) fecharModalAvaliacao();
    });
    document.getElementById('btnLido').addEventListener('click', function() { enviarAcao('lido'); });
    document.getElementById('btnLista').addEventListener('click', function() { enviarAcao('lista'); });
    document.querySelectorAll('.like-button').forEach(function(botao) {
      botao.addEventListener('click', function() { enviarAcao('curtir', { comentario: Number(botao.dataset.comentario) }); });
    });
    document.getElementById('buscarLivros').addEventListener('input', function() {
      const busca = this.value.toLowerCase().trim();
      let encontrados = 0;
      document.querySelectorAll('.recommendation-item').forEach(function(item) {
        const combina = item.textContent.toLowerCase().includes(busca);
        item.hidden = !combina;
        if (combina) encontrados++;
      });
      document.getElementById('semResultado').hidden = encontrados > 0;
    });
    document.querySelectorAll('.recommendation-item').forEach(function(item) {
      function selecionar() {
        document.querySelectorAll('.recommendation-item').forEach(function(outro) { outro.classList.remove('livro-selecionado'); });
        item.classList.add('livro-selecionado');
        mostrarMensagem('Livro selecionado: ' + item.querySelector('h6').textContent);
      }
      item.addEventListener('click', selecionar);
      item.addEventListener('keydown', function(evento) { if (evento.key === 'Enter' || evento.key === ' ') selecionar(); });
    });
    carregarDados();
  </script>
</body>
</html>