document.addEventListener('DOMContentLoaded', () => {
  const botao = document.querySelector('.menu-toggle');
  const navegacao = document.querySelector('.main-nav');
  if (botao && navegacao) {
    botao.addEventListener('click', () => {
      const aberto = botao.getAttribute('aria-expanded') === 'true';
      botao.setAttribute('aria-expanded', String(!aberto));
      navegacao.classList.toggle('open', !aberto);
    });
  }
});
