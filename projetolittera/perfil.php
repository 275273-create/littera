<?php

$nome = "João Gabriel";
$bio = "Estudante de Publicidade e Propaganda, leitor de ficção e fã de Clarice Lispector.";
$ano_cadastro = 2024;

$total_lidos = 18;
$total_avaliacoes = 15;
$media = 4.6;


$livros_lidos = array(
    array("titulo" => "A Hora da Estrela", "autor" => "Clarice Lispector", "capa" => "img/claricelivro.jpg", "nota" => 5.0),
    array("titulo" => "Não é como nos filmes", "autor" => "Lynn Painter", "capa" => "img/naoelivro.png", "nota" => 3.2),
    array("titulo" => "Carta ao Pai", "autor" => "Franz Kafka", "capa" => "img/livrofrankkafka.jpg", "nota" => 4.2),
    array("titulo" => "Harry Potter e a Câmara Secreta", "autor" => "J.K. Rowling", "capa" => "img/harrylivro.avif", "nota" => 4.6),
    array("titulo" => "A Empregada", "autor" => "Freida McFadden", "capa" => "img/livroempregada.jpg", "nota" => 4.9)
);

$avaliacoes = array(
    array("titulo" => "Verity", "nota" => 5, "texto" => "Um suspense psicológico perturbador, viciante e cheio de reviravoltas chocantes que te prendem do início ao fim. Impossível parar de ler!"),
    array("titulo" => "Torto Arado", "nota" => 5, "texto" => "A linguagem é muito bonita e a história prende pela delicadeza. Foi uma das leituras mais marcantes do semestre.")
);


$partes = explode(" ", $nome);
$iniciais = strtoupper(substr($partes[0], 0, 1));
if (count($partes) > 1) {
    $iniciais = $iniciais . strtoupper(substr($partes[1], 0, 1));
}


function mostrarEstrelas($nota) {
    $cheias = round($nota);
    $texto = "";
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $cheias) {
            $texto = $texto . "★";
        } else {
            $texto = $texto . "☆";
        }
    }
    return $texto;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - LITTERA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="perfil.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark border-bottom border-secondary border-opacity-25 py-3">
        <div class="container">

            <span class="logo-dots">
                <span class="dot-green">●</span><span class="dot-orange">●</span><span class="dot-blue">●</span>
            </span> LITTERA

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase small tracking-wide ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="inicio.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="explorar.php">Explorar</a></li>
                    <li class="nav-item"><a class="nav-link" href="meus-livros.php">Meus Livros</a></li>
                    <li class="nav-item"><a class="nav-link" href="recomendacoes.php">Recomendações</a></li>
                    <li class="nav-item"><a class="nav-link" href="comunidade.php">Comunidade</a></li>
                </ul>

              <div class="d-flex align-items-center gap-3">
    <div class="d-flex align-items-center gap-3">
    <div class="position-relative">
        <input type="text" class="form-control form-control-sm search-input text-white pe-4" placeholder="Buscar Livros">
        <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-secondary small"></i>
    </div>
    <a href="perfil.php" class="user-profile-link d-flex align-items-center gap-2 text-white text-decoration-none">
        <div class="avatar-sm rounded-circle d-flex align-items-center justify-content-center text-dark fw-bold"><?php echo $iniciais; ?></div>
        <span class="fw-semibold small"><?php echo $nome; ?></span>
    </a>
</div>
    </nav>

    <main class="container my-5">

        <section class="row align-items-center pb-4 mb-4 border-bottom border-secondary border-opacity-25">

            <div class="col-auto">
                <div class="avatar-lg rounded-circle d-flex align-items-center justify-content-center fw-bold">
                    <?php echo $iniciais; ?>
                </div>
            </div>

            
            <div class="col">
                <span class="text-uppercase text-secondary tracking-widest xsmall">Leitor desde <?php echo $ano_cadastro; ?></span>
                <h1 class="font-serif fw-bold text-white mb-2"><?php echo $nome; ?></h1>
                <p class="text-secondary small mb-3 max-w-lg">
                    <?php echo $bio; ?>
                </p>

                
                <div class="d-flex gap-4 align-items-center text-center text-md-start">
                    <div>
                        <div class="fs-5 fw-bold text-white"><?php echo $total_lidos; ?></div>
                        <div class="text-secondary xsmall">Livros Lidos</div>
                    </div>
                    <div>
                        <div class="fs-5 fw-bold text-white"><?php echo $total_avaliacoes; ?></div>
                        <div class="text-secondary xsmall">Avaliações</div>
                    </div>
                    <div>
                        <div class="fs-5 fw-bold text-white"><?php echo number_format($media, 1); ?></div>
                        <div class="text-secondary xsmall">Média</div>
                    </div>
                </div>
            </div>
        </section>

      
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-baseline mb-4">
                <h2 class="font-serif fw-bold text-white fs-3">Livros lidos</h2>
                <a href="meus-livros.php" class="link-secondary text-decoration-none xsmall text-lowercase font-monospace">ver todos →</a>
            </div>

           
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">

                <?php foreach ($livros_lidos as $livro) { ?>
                <div class="col">
                    <div class="card h-100 book-card bg-transparent border-0">
                        <img src="<?php echo $livro["capa"]; ?>" class="card-img-top rounded book-cover" alt="<?php echo $livro["titulo"]; ?>">
                        <div class="card-body px-0 pt-2 pb-0">
                            <h6 class="card-title text-white fw-bold mb-0 text-truncate"><?php echo $livro["titulo"]; ?></h6>
                            <p class="card-text text-secondary xsmall mb-1"><?php echo $livro["autor"]; ?></p>
                            <div class="stars text-accent small"><?php echo mostrarEstrelas($livro["nota"]); ?> <span class="text-secondary xsmall"><?php echo number_format($livro["nota"], 1); ?></span></div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </section>

        <section>
            <h2 class="font-serif fw-bold text-white fs-3 mb-4">Últimas avaliações</h2>

            <?php foreach ($avaliacoes as $av) { ?>
            <div class="py-3 border-bottom border-secondary border-opacity-25">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="avatar-xs rounded-circle d-flex align-items-center justify-content-center text-dark fw-bold"><?php echo $iniciais; ?></div>
                    <span class="text-secondary small">Você avaliou <a href="#" class="text-accent text-decoration-none fw-semibold"><?php echo $av["titulo"]; ?></a></span>
                </div>
                <div class="stars text-accent small mb-2"><?php echo mostrarEstrelas($av["nota"]); ?></div>
                <p class="font-serif text-white fs-6 fst-italic mb-0">
                    "<?php echo $av["texto"]; ?>"
                </p>
            </div>
            <?php } ?>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
