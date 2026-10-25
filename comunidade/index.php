<?php
$paginaAtual = 'comunidade';
$inicioHref = '../littera-landing/index.php';
$meusLivrosHref = '../recomendacoes-e-meus-livros/meus-livros.php';
$recomendacoesHref = '../recomendacoes-e-meus-livros/recomendacoes.php';
$comunidadeHref = 'index.php';
$buscaAction = $recomendacoesHref;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Littera | Comunidade</title>
    <link rel="stylesheet" href="../includes/cabecalho.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CONEXÃO COM O JAVASCRIPT -->
    <script src="assets/js/comunidade.js" defer></script>
</head>

<body>

    <?php require __DIR__ . '/../includes/cabecalho.php'; ?>

    <main>

        <span class="subtitulo">A REDE LITTERA</span>

        <h1>O que a comunidade está lendo</h1>

        <p class="descricao">
            Avaliações, listas e encontros que fazem as histórias continuarem.
        </p>

        <div class="conteudo">

            <section class="avaliacoes">

                <!-- AVALIAÇÃO 1 -->

                <article class="avaliacao">

                    <div class="avatar">●</div>

                    <img
                        class="capa"
                        src="assets/images/o-hobbit.png"
                        alt="Capa de O Hobbit"
                    >

                    <div class="dados">

                        <p class="autor">
                            Ana Luísa avaliou
                            <span class="nome-livro">O Hobbit</span>
                        </p>

                        <div class="estrelas">★★★★★</div>

                        <p class="comentario">
                            "Uma leitura excelente. A construção do mundo é tão
                            viva que dá vontade de seguir viagem junto com Bilbo".
                        </p>

                        <p class="interacoes">
                            há 2 horas · ♡ 24 curtidas
                        </p>

                    </div>

                </article>

                <!-- AVALIAÇÃO 2 -->

                <article class="avaliacao">

                    <div class="avatar">●</div>

                    <img
                        class="capa"
                        src="assets/images/torto-arrado.png"
                        alt="Capa de Torto Arado"
                    >

                    <div class="dados">

                        <p class="autor">
                            Rafael Moura avaliou
                            <span class="nome-livro">Torto Arado</span>
                        </p>

                        <div class="estrelas">★★★★★</div>

                        <p class="comentario">
                            "A linguagem é muito bonita e a história prende
                            pela delicadeza. Foi uma das leituras mais
                            marcantes do semestre."
                        </p>

                        <p class="interacoes">
                            há 5 horas · ♡ 17 curtidas
                        </p>

                    </div>

                </article>

                <!-- AVALIAÇÃO 3 -->

                <article class="avaliacao">

                    <div class="avatar">●</div>

                    <img
                        class="capa"
                        src="assets/images/a-biblioteca-da-meia-noite.png"
                        alt="Capa de A Biblioteca da Meia-Noite"
                    >

                    <div class="dados">

                        <p class="autor">
                            Beatriz Lima avaliou
                            <span class="nome-livro">A Biblioteca da Meia-Noite</span>
                        </p>

                        <div class="estrelas">★★★★★</div>

                        <p class="comentario">
                            "Me fez pensar muito sobre escolhas, sem perder
                            a leveza. Perfeito para conversar depois da aula."
                        </p>

                        <p class="interacoes">
                            ontem · ♡ 31 curtidas
                        </p>

                    </div>

                </article>

                <!-- AVALIAÇÃO 4 -->

                <article class="avaliacao">

                    <div class="avatar">●</div>

                    <img
                        class="capa"
                        src="assets/images/duna.png"
                        alt="Capa de Duna"
                    >

                    <div class="dados">

                        <p class="autor">
                            Caio Reis avaliou
                            <span class="nome-livro">Duna</span>
                        </p>

                        <div class="estrelas">★★★★★</div>

                        <p class="comentario">
                            "É grandioso, político e estranhamente atual.
                            Demorei para entrar, mas depois não consegui largar."
                        </p>

                        <p class="interacoes">
                            ontem · ♡ 19 curtidas
                        </p>

                    </div>

                </article>

            </section>

            <aside class="destaques">

                <h2>DESTAQUES DA SEMANA</h2>

                <div class="livro">

                    <img
                    src="assets/images/ensaio-sobre-a-cegueira.png"
                    alt="Capa do livro Ensaio Sobre a Cegueira"
                    >

                    <div class="info-livro">
                        <h3>Ensaio Sobre a Cegueira</h3>
                        <p>José Saramago</p>
                        <div class="nota">★★★★★ 4.8</div>
                    </div>

                </div>

                <div class="livro">

                    <img
                    src="assets/images/a-paciente-silenciosa.png"
                    alt="Capa de A Paciente Silenciosa"
                    >

                    <div class="info-livro">
                        <h3>A Paciente Silenciosa</h3>
                        <p>Alex Michaelides</p>
                        <div class="nota">★★★★★ 4.3</div>
                    </div>

                </div>

                <div class="livro">

                    <img
                        src="assets/images/o-hobbit.png"
                        alt="Capa de O Hobbit"
                    >

                    <div class="info-livro">
                        <h3>O Hobbit</h3>
                        <p>J. R. R. Tolkien</p>
                        <div class="nota">★★★★★ 4.9</div>
                    </div>

                </div>

                <div class="livro">

                    <img
                    src="assets/images/harry-potter-e-a-pedra-filosofal.png"
                    alt="Capa de Harry Potter e a Pedra Filosofal"
                    >

                    <div class="info-livro">
                        <h3>Harry Potter e a Pedra Filosofal</h3>
                        <p>J. K. Rowling</p>
                        <div class="nota">★★★★★ 4.9</div>
                    </div>

                </div>

            </aside>

        </div>

    </main>

</body>
</html>