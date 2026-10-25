document.addEventListener('DOMContentLoaded', () => {
  const botaoMenu = document.querySelector('.botao-menu');
  const menu = document.querySelector('.menu');

  if (botaoMenu && menu) {
    botaoMenu.addEventListener('click', () => {
      const menuAberto = botaoMenu.getAttribute('aria-expanded') === 'true';
      botaoMenu.setAttribute('aria-expanded', String(!menuAberto));
      botaoMenu.setAttribute('aria-label', menuAberto ? 'Abrir menu' : 'Fechar menu');
      menu.classList.toggle('menu-aberto', !menuAberto);
    });

    menu.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        menu.classList.remove('menu-aberto');
        botaoMenu.setAttribute('aria-expanded', 'false');
        botaoMenu.setAttribute('aria-label', 'Abrir menu');
      });
    });
  }

  document.querySelectorAll('[data-login-pendente]').forEach((link) => {
    link.addEventListener('click', (evento) => {
      evento.preventDefault();
      const aviso = document.querySelector('.aviso-login');
      if (aviso) aviso.classList.add('aviso-visivel');
    });
  });
});
