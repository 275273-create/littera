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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #101619;
            color: #f1f2f1;
            font-family: Arial, sans-serif;
        }

        header {
            min-height: 76px;
            padding: 0 32px;
            display: flex;
            align-items: center;
            gap: 25px;
            border-bottom: 1px solid #293135;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .bolinhas {
            display: flex;
            gap: 3px;
        }

        .bolinhas span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .bolinhas span:nth-child(1) {
            background: #ffbd59;
        }

        .bolinhas span:nth-child(2) {
            background: #ff777d;
        }

        .bolinhas span:nth-child(3) {
            background: #81d5d0;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        nav a {
            color: #a0a5a6;
            text-decoration: none;
            font-size: 12px;
            white-space: nowrap;
        }

        nav a:hover,
        nav a.ativo {
            color: #caff37;
        }

        .perfil {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .busca {
            width: 145px;
            padding: 11px 14px;
            background: #303a40;
            border: none;
            border-radius: 25px;
            color: white;
            outline: none;
        }

        .busca::placeholder {
            color: #92999b;
        }

        .foto-perfil {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #6b838e;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            font-weight: bold;
        }

        .nome-perfil {
            font-size: 14px;
            font-weight: bold;
        }

        .seta {
            color: #a0a5a6;
            font-size: 12px;
        }

        main {
            max-width: 1400px;
            margin: 76px auto;
            padding: 0 60px;
        }

        .subtitulo {
            color: #a0a5a6;
            font-size: 12px;
        }

        h1 {
            margin: 12px 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 34px;
        }

        .descricao {
            margin-bottom: 55px;
            color: #a0a5a6;
            font-size: 13px;
        }

        .conteudo {
            display: grid;
            grid-template-columns: minmax(0, 3fr) minmax(215px, 1fr);
            gap: 65px;
            align-items: start;
        }

        .avaliacao {
            display: grid;
            grid-template-columns: 22px 54px minmax(0, 1fr);
            gap: 4px;
            padding: 0 0 10px;
            margin-bottom: 6px;
            border-bottom: 1px solid #293135;
        }

        .avatar {
            width: 21px;
            height: 21px;
            border-radius: 50%;
            background: #596165;
            background-image: url("data:image/webp;base64,UklGRoYAAABXRUJQVlA4IHoAAAAwBQCdASoWABYAPu1srlKppaQiqAgBMB2JaQDPoA0vK0X85g+5edUHFYd8i8JKv9F+AAD+72MlBKhUHDnBKTJik0MRVYa44J1VhVz/JkfuD5APohrNFRbmgCpGv6XBMj4ddGIqJlLVSabR9tShO6/ErkNkc3pvoAAAAA==");
            background-size: cover;
            color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .capa {
            width: 54px;
            height: 75px;
            object-fit: cover;
            border-radius: 2px;
            background: #293135;
        }

        .dados {
            min-width: 0;
            padding-left: 4px;
        }

        .autor {
            color: #e5e7e6;
            font-size: 11px;
            line-height: 1.5;
        }

        .nome-livro {
            color: #caff37;
        }

        .estrelas {
            margin: 3px 0 17px;
            color: #caff37;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .comentario {
            margin-bottom: 12px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 13px;
            font-weight: bold;
            line-height: 1.4;
        }

        .interacoes {
            color: #92999b;
            font-size: 10px;
        }

        aside h2 {
            margin-bottom: 15px;
            color: #a0a5a6;
            font-size: 12px;
            font-weight: normal;
        }

        .livro {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 12px;
        }

        .livro img {
            width: 38px;
            height: 55px;
            flex-shrink: 0;
            object-fit: cover;
            border-radius: 2px;
            background: #293135;
        }

        .info-livro h3 {
            margin-bottom: 6px;
            font-size: 12px;
            font-weight: normal;
            line-height: 1.4;
        }

        .info-livro p {
            margin-bottom: 4px;
            color: #92999b;
            font-size: 10px;
        }

        .nota {
            color: #a0a5a6;
            font-size: 10px;
        }

    </style>

    <!-- CONEXÃO COM O JAVASCRIPT -->
    <script src="../js/comunidade.js" defer></script>
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
                        src="o hobbit.png"
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
                        src="torto arrado.png"
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
                        src="a biblioteca da meia noite.png"
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
                        src="duna.png"
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
                    src="Ensaio Sobre a Cegueira.png"
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
                    src="A Paciente Silenciosa.png"
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
                        src="o hobbit.png"
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
                    src="Harry Potter e a Pedra Filosofal.png"
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