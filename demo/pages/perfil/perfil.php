<?php 
@session_start();

require_once('conexao.php');
require_once('verificar-permissao.php');
$id_user = $_SESSION[id_usuario];
$query = $pdo->query("SELECT * from usuarios WHERE id = '$id_user'");

while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {

  ?> 

  <div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              Meu Perfil
            </h2>
            <div class="text-muted mt-1">Nome do Usuário</div>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <div class="card-body p-4 text-center">
                <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url(./static/avatars/sem-foto.png)"></span>
                <h3 class="m-0 mb-1"><a href="#"><?php echo $linha['nome']; ?></a></h3>
              </div>
              <div class="card">
                <div class="card-body">
                 <form action="" method="post" class="card">
                  <div class="card-body p-4 ">
                    <div class="col-md-6 col-xl-6">
                      <div class="col-md-6 col-xl-6">
                        <div class="mb-3 text-center">
                          <label class="page-title ">Meus dados</label>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nome</label>
                          <?php echo $linha['nome']; ?>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <?php echo $linha['email']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>