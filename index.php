<?php require_once __DIR__ . "/vendor/autoload.php";  ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/assets/style/style.css">
  <title>SWE 2 - CLARIFIQUEI</title>
</head>
<body class="d-flex flex-column">
  <header class="cabecalho">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-5 py-2">
        <div class="container-fluid py-1">
          <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>

           <div class="collapse navbar-collapse mx-4">
              <h1 class="h2">SWE 2</h1>
              <ul class="navbar-nav ms-auto">
                <li class="__caminho nav-item active"><a href="" class="nav-link">Sobre nós</a></li>
                <li class="__caminho nav-item"><a href="" class="nav-link">Contacto</a></li>
              </ul>
            </div>

        </div>
    </nav>
  </header>

    <div class="conteudo-central container d-flex justify-content-center m-auto p-0 h-75 col-12">
      <form>
        <div class="formulario-conteudo container-fluid col-12">
            <h1 class="__titulo">Seja bem-vindo!</h1>
            <span class="__subtitulo">Seja bem-vindo! Por favor preencha os campos.</span>

            <div class="form-group mt-4">
              <label for="email">E-mail:</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Digite o seu e-mail">
            </div>
            <div class="form-group mt-3">
              <label for="palavra-passe">Palavra-passe</label>
              <input type="password" name="palavra-passe" class="form-control" id="palavra-passe" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
            </div>
        </div>

        <fieldset class="botoes gap-3 row mx-0 mb-4">
          <button class="btn btn-primary col-12 mt-3" type="submit">Entrar</button>
        </fieldset>
      </form>

    </div>

</body>
</html>