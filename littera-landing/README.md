# Landing page do Littera

Página independente para apresentar o Littera. A ilustração de livros é feita em CSS, é identificada como ilustração e não representa capturas de tela reais. Esta entrega não implementa autenticação.

## Executar

Na pasta raiz do projeto, execute:

```bash
php -S 127.0.0.1:8000
```

Abra `http://127.0.0.1:8000/` no navegador. O arquivo raiz encaminha para esta página.

## Configurar o link de login

Esta versão não implementa autenticação. Os botões de entrada exibem um aviso de que o login ainda não está conectado.

## Arquivos

- `index.php`: conteúdo e estrutura das seções.
- `config/login.php`: endereço centralizado da futura tela de login.
- `css/style.css`: estilos, composição ilustrativa e layout responsivo.
- `js/script.js`: menu para celular e aviso para o login pendente.
