<?php

require_once("conexao.php");

 ?>

<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta6
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo $nome_sistema; ?></title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css" rel="stylesheet"/>
  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">        
        <form class="card card-md" action="autenticar.php" method="post" autocomplete="off">
          <div class="card-body">
             <center><img src="./static/logo_login.png" class="center" width="250px"></center> <br>
            <h2 class="card-title text-center mb-4">Acesso ao sistema.</h2>
            <div class="mb-3">
              <label class="form-label">E-mail</label>
              <input type="email" class="form-control" name="usuario" placeholder="Insira seu email">
            </div>
            <div class="mb-2">
              <label class="form-label">
                Senha               
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="senha" placeholder="Digite sua senha"  autocomplete="off">
                <span class="input-group-text">
                </span>
              </div>
            </div>
            <div class="mb-2">              
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Acessar</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Não tenho cadastro? <a href="./registrar.php" tabindex="-1">Cadastrar</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <script src="./dist/js/demo.min.js"></script>
  </body>
</html>