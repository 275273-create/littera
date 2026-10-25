document.addEventListener('DOMContentLoaded', () => {
  const botao = document.querySelector('.menu-toggle');
  const navegacao = document.querySelector('.main-nav');

  if (!botao || !navegacao) return;

  botao.addEventListener('click', () => {
    const aberto = botao.getAttribute('aria-expanded') === 'true';
    botao.setAttribute('aria-expanded', String(!aberto));
    navegacao.classList.toggle('open', !aberto);
  });

  navegacao.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      botao.setAttribute('aria-expanded', 'false');
      navegacao.classList.remove('open');
    });
  });
});
