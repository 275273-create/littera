```php
<?php
$erroLogin = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $senha = $_POST["senha"] ?? "";

    if ($usuario === "joaogabriel" && $senha === "1234") {
        header("Location: index.html");
        exit;
    } else {
        $erroLogin = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LITTERA - Login</title>
  
  <style>
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #0b0f14;
      color: #e6edf3;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
    }

    
    .fundo-biblioteca {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1600&auto=format&fit=crop');
      background-size: cover;
      background-position: center;
      z-index: 1;
    }

    
    .fundo-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(11, 15, 20, 0.85);
      z-index: 2;
    }

    
    .cabecalho {
      position: relative;
      z-index: 10;
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      background: rgba(11, 15, 20, 0.6);
      backdrop-filter: blur(8px);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .pontos-logo {
      display: flex;
      gap: 4px;
    }

    .ponto {
      width: 8px;
      height: 8px;
      border-radius: 50%;
    }

    .ponto-laranja { background-color: #f59e0b; }
    .ponto-limao { background-color:  #abc500; }
    .ponto-azul { background-color:#93baf0; }

    .logo-texto {
      color: #ffffff;
      font-size: 18px;
      font-weight: 800;
      letter-spacing: 2px;
    }

    
    .conteudo-principal {
      position: relative;
      z-index: 10;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      flex: 1;
    }

    .caixa-login {
      background-color: #13181e;
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      padding: 40px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .titulo {
      font-size: 24px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 8px;
      text-align: center;
    }

    .subtitulo {
      font-size: 13px;
      color: #8b949e;
      text-align: center;
      margin-bottom: 28px;
      line-height: 1.4;
    }

    .formulario {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .campo-grupo {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .rotulo {
      font-size: 12px;
      font-weight: 600;
      color: #c9d1d9;
    }

    .campo-texto {
      width: 100%;
      background-color: #161c23;
      border: 1px solid #1e2630;
      border-radius: 8px;
      padding: 12px 14px;
      font-size: 13px;
      color: #ffffff;
      outline: none;
      transition: border-color 0.2s;
    }

    .campo-texto:focus {
      border-color: #8cc63f;
    }

    .campo-texto::placeholder {
      color: #484f58;
    }

    .linha-opcoes {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
    }

    .lembrar-me {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #8b949e;
      cursor: pointer;
    }

    .checkbox {
      accent-color: #8cc63f;
      cursor: pointer;
    }

    .link {
      color: #8cc63f;
      text-decoration: none;
      font-weight: 600;
      transition: opacity 0.2s;
    }

    .link:hover {
      text-decoration: underline;
      opacity: 0.9;
    }

    .btn-entrar {
      background-color: #8cc63f;
      color: #0b0f14;
      border: none;
      border-radius: 8px;
      padding: 14px;
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      cursor: pointer;
      transition: background-color 0.2s;
      margin-top: 6px;
    }

    .btn-entrar:hover {
      background-color: #a0da4e;
    }

    .rodape-login {
      text-align: center;
      font-size: 13px;
      color: #8b949e;
      margin-top: 24px;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      padding-top: 20px;
    }

    
    .rodape-pagina {
      position: relative;
      z-index: 10;
      text-align: center;
      padding: 16px;
      font-size: 11px;
      color: #484f58;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      background: rgba(11, 15, 20, 0.6);
    }
  </style>
</head>
<body>

  <div class="fundo-biblioteca"></div>
  <div class="fundo-overlay"></div>

 
  <header class="cabecalho">
    <a href="#" class="logo">
      <div class="pontos-logo">
        <span class="ponto ponto-laranja"></span>
        <span class="ponto ponto-limao"></span>
        <span class="ponto ponto-azul"></span>
      </div>
      <span class="logo-texto">LITTERA</span>
    </a>

  </header>

 
  <main class="conteudo-principal">
    <div class="caixa-login">
      
      <h1 class="titulo">Bem-vindo de volta</h1>
      <p class="subtitulo">Acesse sua conta para ver suas leituras e novidades da comunidade.</p>

      <?php if ($erroLogin): ?>
        <p style="color: #ff6b6b; font-size: 13px; margin-bottom: 16px; text-align: center;">
          Usuário ou senha incorretos.
        </p>
      <?php endif; ?>

      <form class="formulario" method="POST" action="">
       
        <div class="campo-grupo">
          <label for="email" class="rotulo">E-mail ou Usuário</label>
          <input 
            type="text" 
            id="email" 
            name="usuario"
            class="campo-texto" 
            placeholder="seu@email.com" 
            required
          >
        </div>

       
        <div class="campo-grupo">
          <label for="senha" class="rotulo">Senha</label>
          <input 
            type="password" 
            id="senha" 
            name="senha"
            class="campo-texto" 
            placeholder="••••••••" 
            required
          >
        </div>

        <div class="linha-opcoes">
          <label class="lembrar-me">
            <input type="checkbox" class="checkbox">
            <span>Lembrar de mim</span>
          </label>
          <a href="#" class="link">Esqueceu a senha?</a>
        </div>
        <button type="submit" class="btn-entrar">Entrar</button>

      </form>

    
      <div class="rodape-login">
        Ainda não possui conta? <a href="#" class="link">Criar conta</a>
      </div>

    </div>
  </main>


  <footer class="rodape-pagina">
    &copy; 2026 LITTERA. Todos os direitos reservados.
  </footer>

</body>
</html>
```