<?php

require_once("conexao.php");
//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuário clicou no botão
if (!empty($dados['enviar'])) {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $rsenha = $_POST['rsenha'];
  $termo = $_POST['terms'];
  

  $erro = array();
  if(empty($nome))
    $erro[] = "Preencha o seu nome completo.";
  if(empty($email))
    $erro[] = "Preencha o seu email.";  

  if(empty($senha))
    $erro[] = "Preencha a sua senha";

  if(!empty($senha!=$rsenha))
    $erro[] = "As senhas não são iguais.";


  if(empty($termo))
    $erro[] = "Para o cadastro, deve-se aceitar os termos de serviços.";
    
    if(count($erro) == 0) {
   
   //VERIFICAR SE O EMAIL EXISTE NO SISTEMA
   $query_con = $pdo->prepare("SELECT * from usuarios WHERE email = :email");
   $query_con->bindValue(":email", $email);
   $query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
	$erro[] = "O email já está cadastrado em nosso sistema.";
        }else{
        
        
    //REALIZA O CADASTRO NO SISTEMA
    
    $user = 'User';
    $query = "INSERT INTO usuarios (nome, email, senha, nivel) VALUES (:nome, :email, :senha, '$user')";
    $res = $pdo->prepare($query);
    $res->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $res->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $res->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
    $res->execute();
    if ($res->rowCount()) {
  
        $sucesso = array();
           $sucesso[] = "Cadastro realizado com sucesso! Clique no botão Acessar, para logar ao sistema! "; 

   } else {
    $erro[] = "Usuário Não Cadastrado"; 
  }
  
}
    
    }   

}
 ?>


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
        <div class="text-center mb-4">
        </div>
        <form class="card card-md" action="" method="post">
          <div class="card-body">
              <center><img src="./static/logo_login.png" class="center" width="350px"></center> <br>
            <h2 class="card-title text-center mb-4">Criar uma conta.</h2>
            
            <?php if(isset($erro) && count($erro) > 0) {
          ?>
          <div class="alert alert-danger text-danger" role="alert">
            <?php foreach($erro as $e) { echo "$e<br>"; } ?>
             </div>                                                    

          <?php
        }
        
        ?>
        
           <?php if(isset($sucesso) && count($sucesso) > 0) {
          ?>
          <div class="alert alert-success text-success" role="alert">
            <?php foreach($sucesso as $s) { echo "$s<br>"; } ?><br>
          </div> 
          <div>
          <a href="login.php" type="button" class="btn btn-primary w-100">Acessar!</a><br>
          </div>

          <?php
        }
        
        ?>
            
            
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control"name="nome" placeholder="Nome Completo">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="senha" placeholder="Senha" autocomplete="off">
                <span class="input-group-text">
                </span>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Repita sua Senha</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="rsenha" placeholder="Repita sua Senha" autocomplete="off">
                <span class="input-group-text">
                </span>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-check">
                <input type="checkbox" name="terms" value="agree" class="form-check-input"/>
                <span class="form-check-label">Estou de acordo com o cadastro.</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" name="enviar" value="1" class="btn btn-primary w-100">Criar uma conta.</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Já possui uma conta? <a href="./login.php" tabindex="-1">Logar</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <script src="./dist/js/demo.min.js"></script>
  </body>
</html>