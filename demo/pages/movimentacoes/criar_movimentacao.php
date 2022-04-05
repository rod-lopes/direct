<?php
@session_start();
require_once('conexao.php');
require_once('verificar-permissao.php');

$id = $_SESSION['id_usuario'];
//RECEVER OS DADOS DO FORMULÁRIO
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VERFICAR SE O USUÁRIO CLICOU NO BOTÃO
if (!empty($dados['enviar'])) {
  $tipo = $_POST['tipo'];
  $dhinicio = $_POST['dhinicio'];
  $dhfim = $_POST['dhfim'];
  $idcontainer = $_POST['idcontainer'];

  $erro = array();
  if(empty($tipo))
    $erro[] = "Preencha o tipo de movimentação.";

  if(empty($dhinicio))
    $erro[] = "Preencha a data inicio da movimentação.";

  if(empty($dhfim))
    $erro[] = "Preencha a data fim da movimentação.";


  if(empty($idcontainer))
    $erro[] = "Preencha um contêiner para a movimentação.";

//CONVERTER A DATA E HORA DO FORMATO BRASILEIRO PARA O FORMATO DO BANCO DE DADOS
  $dhinicio = explode(" ", $dhinicio);
  list($date, $hora) = $dhinicio;
  $data_sem_barra = array_reverse(explode("/", $date));
  $data_sem_barra = implode("-", $data_sem_barra);
  $data_sem_barra = $data_sem_barra . " " . $hora . ":" . "00";

//CONVERTER A DATA E HORA DO FORMATO BRASILEIRO PARA O FORMATO DO BANCO DE DADOS
  $dhfim = explode(" ", $dhfim);
  list($date2, $hora2) = $dhfim;
  $data_sem_barra2 = array_reverse(explode("/", $date2));
  $data_sem_barra2 = implode("-", $data_sem_barra2);
  $data_sem_barra2 = $data_sem_barra2 . " " . $hora2 . ":" . "00";

  if(count($erro) == 0) {

    $query = "INSERT INTO movimentacao (tipo, dhinicio, dhfim, idcontainer) VALUES (:tipo, '$data_sem_barra', '$data_sem_barra2', :idcontainer) ";
    $res = $pdo->prepare($query);
    $res->bindParam(':tipo', $dados['tipo'], PDO::PARAM_STR);
    $res->bindParam(':idcontainer', $dados['idcontainer'], PDO::PARAM_STR);
    $res->execute();
    if ($res->rowCount()) {

     die("<script>location.href=\"index.php?m=gerenciar_movimentacao\";</script>");

   } else {
    $erro[] = "Movimentação nâo cadastrada"; 

  }

}

}
?>

<div class="page-wrapper">
  <div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Cadastrar Movimentação <?php echo $datainicio; ?>
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
          <?php if(isset($erro) && count($erro) > 0) {
            ?>
            <div class="alert alert-danger text-danger" role="alert">
              <?php foreach($erro as $e) { echo "$e<br>"; } ?>
            </div>                                                    

            <?php
          }

          ?>
          <form action="" method="post" class="card">

            <div class="card-header">
              <h4 class="card-title">Tipo de Contêiner</h4>
            </div>
            <div class="card-body">
              <div class="row">

                <div class="col-xl-12">
                  <div class="row">
                    <div class="mb-4">
                      <div class="form-selectgroup form-selectgroup-pills">

                        <label class="form-selectgroup-item">
                          <input type="radio" id="tipo" name="tipo" value="Embarque" class="form-selectgroup-input" >
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <circle cx="7" cy="17" r="2"></circle>
                             <circle cx="17" cy="17" r="2"></circle>
                             <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                           </svg> Embarque</span>
                         </label>
                         <label class="form-selectgroup-item">
                          <input type="radio" id="tipo" name="tipo" value="Descarga" class="form-selectgroup-input">
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <circle cx="7" cy="17" r="2"></circle>
                             <path d="M15.585 15.586a2 2 0 0 0 2.826 2.831"></path>
                             <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h1m3.96 0h4.04v4m0 4v4m-4 0h6m6 0v-6h-6m-2 -5h5l3 5"></path>
                             <line x1="3" y1="3" x2="21" y2="21"></line>
                           </svg> Descarga</span>
                         </label>
                         <label class="form-selectgroup-item">
                          <input type="radio" id="tipo" name="tipo" value="Gate In" class="form-selectgroup-input">
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                             <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                           </svg> Gate In</span>
                         </label>
                         <label class="form-selectgroup-item">
                          <input type="radio" id="tipo" name="tipo" value="Gate Out" class="form-selectgroup-input">
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                             <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                           </svg> Gate Out</span>
                         </label>
                         <label class="form-selectgroup-item">
                          <input type="radio" id="tipo" name="tipo" value="Reposicionamento" class="form-selectgroup-input">
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-replace" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <rect x="3" y="3" width="6" height="6" rx="1"></rect>
                             <rect x="15" y="15" width="6" height="6" rx="1"></rect>
                             <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3"></path>
                             <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3"></path>
                           </svg> Reposicionamento</span>
                         </label>
                         <label class="form-selectgroup-item">
                          <input type="radio" id="tipo" name="tipo" value="Pesagem" class="form-selectgroup-input">
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scale" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <line x1="7" y1="20" x2="17" y2="20"></line>
                             <path d="M6 6l6 -1l6 1"></path>
                             <line x1="12" y1="3" x2="12" y2="20"></line>
                             <path d="M9 12l-3 -6l-3 6a3 3 0 0 0 6 0"></path>
                             <path d="M21 12l-3 -6l-3 6a3 3 0 0 0 6 0"></path>
                           </svg> Pesagem</span>
                         </label>
                         <label class="form-selectgroup-item">
                          <input type="radio" id="tipo" name="tipo" value="Scanner" class="form-selectgroup-input">
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                             <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                             <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                             <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                             <line x1="5" y1="12" x2="19" y2="12"></line>
                           </svg> Scanner</span>
                         </label>
                       </div>
                     </div>
                     <div class="col-md-12 col-xl-12">
                       <div class="mb-3">
                        <label class="form-label">Número do Contêiner</label>
                        <select type="text" class="form-select" placeholder="Buscar..." name="idcontainer" id="select-tags">
                          <option  selected  value="" disabled>Selecione um contêiner</option>
                          <?php
                                //LOCALIZANDO O NUMERO DO CONTÊINER
                          $query = $pdo->query("SELECT * from container order by numero asc");
                          $res = $query->fetchAll(PDO::FETCH_ASSOC);
                          $total_reg = @count($res);
                          if($total_reg > 0){ 

                            for($i=0; $i < $total_reg; $i++){
                             foreach ($res[$i] as $key => $value){  }
                              ?>

                            <option <?php if(@$categoria == $res[$i]['id']){ ?> selected <?php } ?>  value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['numero'] ?></option>

                          <?php }

                        }else{ 


                          echo '<option value="0" selected="selected" disabled="disabled">Cadastre um contêiner</option>';

                        }

                        ?>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Data e Hora do Início</label>

                      <div class="row g-2">
                        <div class="col">
                          <input type="datetime-local" name="dhinicio" class="form-control form-control mb-2" placeholder="Data e Hora">
                        </div>
                      </div>
                      
                      <div class="mb-3">
                        <label class="form-label">Data e Hora do Fim</label>

                        <div class="row g-2">
                          <div class="col">
                            <input type="datetime-local" name="dhfim" class="form-control form-control mb-2" placeholder="Data e Hora">
                          </div>
                        </div>                        
                      </div>
                    </div>
                    <div class="form-footer">
                     <!-- <button type="submit" class="btn btn-danger">Deletar</button>-->
                     <button type="submit" name="enviar" value="1" class="btn btn-primary float-right">Enviar</button>
                   </form>
                 </div>
               </div>
             </div>
