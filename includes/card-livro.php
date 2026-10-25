<article class="book-tile">
  <a
    class="cover"
    href="livro.php?id=<?= (int) $livro['id'] ?>"
    aria-label="Ver <?= escapar($livro['titulo']) ?>"
  >
    <img
      loading="lazy"
      src="<?= escapar(urlCapa($livro)) ?>"
      alt="Capa de <?= escapar($livro['titulo']) ?>"
    >
  </a>

  <h3>
    <a href="livro.php?id=<?= (int) $livro['id'] ?>">
      <?= escapar($livro['titulo']) ?>
    </a>
  </h3>
  <p><?= escapar($livro['autor']) ?></p>

  <div class="book-rating">
    <span class="stars" aria-label="<?= escapar((string) $livro['nota']) ?> de 5 estrelas">
      <?= estrelas((float) $livro['nota']) ?>
    </span>
    <b><?= number_format((float) $livro['nota'], 1, ',', '.') ?></b>
  </div>
</article>
