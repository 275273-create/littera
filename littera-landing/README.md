# Landing page do Littera

Página independente para apresentar o Littera. A ilustração de livros é feita em CSS, é identificada como ilustração e não representa capturas de tela reais. Esta entrega não implementa autenticação.

## Executar

Na pasta `littera-landing`, execute:

```bash
php -S localhost:8001
```

Abra `http://localhost:8001/` no navegador.

## Configurar o link de login

Quando a tela de login estiver pronta, altere `$loginUrl` em `config/login.php`. Os botões de entrada usam esse valor. Enquanto ele estiver como `#`, a página informa que o login ainda não foi conectado.

## Arquivos

- `index.php`: conteúdo e estrutura das seções.
- `config/login.php`: endereço centralizado da futura tela de login.
- `css/style.css`: estilos, composição ilustrativa e layout responsivo.
- `js/script.js`: menu para celular e aviso para o login pendente.
