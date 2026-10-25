# Littera

Projeto acadêmico para aproximar estudantes universitários da leitura e de outros leitores.

## Executar localmente

Requer PHP 8.0 ou superior. Na pasta raiz do projeto, execute:

```bash
php -S 127.0.0.1:8000
```

Mantenha o terminal aberto e acesse `http://127.0.0.1:8000/`.

Rotas principais:

- `http://127.0.0.1:8000/recomendacoes-e-meus-livros/meus-livros.php`
- `http://127.0.0.1:8000/recomendacoes-e-meus-livros/recomendacoes.php`
- `http://127.0.0.1:8000/comunidade/index.php`
- `http://127.0.0.1:8000/pag-livro/livro.php`

Os dados de livros, avaliações e usuários são de demonstração. Algumas alterações ficam na sessão do navegador e não são gravadas em banco de dados.
O acesso de demonstração usa `joaogabriel` como usuário e `1234` como senha; não use essas credenciais em um sistema real.

## Publicação

O GitHub Pages não executa PHP. Para usar as páginas PHP, execute o projeto com PHP localmente ou publique-o em uma hospedagem que ofereça suporte a PHP.
