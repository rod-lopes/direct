<?php
@session_start();

require_once('conexao.php');
require_once('verificar-permissao.php');

$id = $_SESSION['id_usuario'];
//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuário clicou no botão
if (!empty($dados['enviar'])) {
  $cliente = $_POST['cliente'];
  $numero = $_POST['numero'];
  $verifica = $_POST['numero'];
  $tipo = $_POST['tipo'];
  $status = $_POST['status'];
  $categoria = $_POST['categoria'];
  $string4 = substr("$numero", 0, 4); //COLETA OS 4 PRIMEIROS CARACTERES DO CONTÊINER
  $numero7 = substr("$verifica", 4, 11); //COLETA OS 7 ÚLTIMOS CARACTERES DO CONTÊINER

  $contagem = strlen($numero);

  $erro = array();
  if(empty($cliente))
    $erro[] = "Preencha o nome do cliente.";
  if(empty($numero))
    $erro[] = "Preencha o número do contêiner.";  

  //VERIFICA SE O USUÁRIO DIGITOU NÚMEROS NOS 4 PRIMEIROS CARACTERES
  if(is_numeric($string4)){

    $erro[] = "O valor dos 4 primeiros números do contêiner deve ser letras. (EX.: TEST1234567)";
  }
  //VERIFICA SE O USUÁRIO DIGITOU LETRAS EM QUAQUER DOS 7 ÚLTIMOS CARACTERES
  if(preg_match("/[a-zA-Z]/", $numero7)){
   $erro[] = '"O valor dos 7 últimos números do contêiner deve ser letras. (EX.: TEST1234567)';
 }

//VERIFICA SE O USUÁRIO DIGITOU CARACTERES MENORES QUE 11
 if($contagem!=11){

  $erro[] = "O valor do número do contêiner deve conter 11 caracteres. (EX.: TEST1234567)"; 
}

//VERIFICA SE O USUÁRIO DIGITOU ALGUM CARACTER ESPECIAL OU ESPAÇOS
if (!preg_match("/^[a-zA-Z0-9]+/", $numero )) {
  $erro[] = "O valor do numero do contêiner não deve possuir caracteres especiais, nem espaços. (EX.: TEST1234567)"; 
}


if(empty($tipo))
  $erro[] = "Selecione um tipo de contêiner (20 Pés ou 40 Pés)";

if(empty($status))
  $erro[] = "Preencha o status do contêiner (Vazio ou Cheio)";

if(empty($categoria))
  $erro[] = "Escolha a categoria do contêiner (Exportação ou Importação).";


if(count($erro) == 0) {

  $query = "INSERT INTO container (cliente, numero, tipo, status, categoria) VALUES (:cliente, :numero, :tipo, :status, :categoria) ";
  $res = $pdo->prepare($query);
  $res->bindParam(':cliente', $dados['cliente'], PDO::PARAM_STR);
  $res->bindParam(':numero', $dados['numero'], PDO::PARAM_STR);
  $res->bindParam(':tipo', $dados['tipo'], PDO::PARAM_STR);
  $res->bindParam(':status', $dados['status'], PDO::PARAM_STR);
  $res->bindParam(':categoria', $dados['categoria'], PDO::PARAM_STR);
  $res->execute();
  if ($res->rowCount()) {

   die("<script>location.href=\"index.php?c=gerenciar_container\";</script>");

 } else {
  $erro[] = "Contêiner nâo cadastrado!"; 

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
            Cadastrar Contêiner
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
                          <input type="radio" id="tipo" name="tipo" value="20" class="form-selectgroup-input" checked>
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ship" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <path d="M2 20a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1"></path>
                             <path d="M4 18l-1 -5h18l-2 4"></path>
                             <path d="M5 13v-6h8l4 6"></path>
                             <path d="M7 7v-4h-1"></path>
                           </svg> 20 Pés</span>
                         </label>
                         <label class="form-selectgroup-item">
                          <input type="radio" id="tipo" name="tipo" value="40" class="form-selectgroup-input">
                          <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ship" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <path d="M2 20a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1"></path>
                             <path d="M4 18l-1 -5h18l-2 4"></path>
                             <path d="M5 13v-6h8l4 6"></path>
                             <path d="M7 7v-4h-1"></path>
                           </svg>
                         40 Pés</span>
                       </label>
                     </div>
                   </div>

                   <div class="col-md-12 col-xl-12">

                    <div class="mb-3">
                      <label class="form-label">Cliente</label>

                      <div class="row g-2">
                        <div class="col">
                          <input type="text" name="cliente" class="form-control form-control-rounded mb-2" placeholder="Nome do Cliente">
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-12">
                        <div class="mb-3">
                          <label class="form-label">Número do Contêiner </label>       
                          <div class="input-group">
                            <span class="input-group-text">
                            4 Letras e 7 Números                               </span>
                            <input type="text" name="numero" class="form-control form-control-rounded mb-2" maxlength="11" OnKeyPress=""placeholder="TEST1234567">

                          </div>
                        </div>
                      </div> 
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Status</label>
                      <div class="col-xl-4">
                        <div class="row">
                          <div class="mb-4">
                            <div class="form-selectgroup form-selectgroup-pills">

                              <label class="form-selectgroup-item">
                                <input type="radio" id="status" name="status" value="Vazio" class="form-selectgroup-input" checked>
                                <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M8 4h10a2 2 0 0 1 2 2v10m-.584 3.412a1.994 1.994 0 0 1 -1.416 .588h-12a2 2 0 0 1 -2 -2v-12c0 -.552 .224 -1.052 .586 -1.414"></path>
                                   <path d="M3 3l18 18"></path>
                                 </svg> Vazio</span>
                               </label>
                               <label class="form-selectgroup-item">
                                <input type="radio" id="status" name="status" value="Cheio" class="form-selectgroup-input">
                                <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                 </svg>
                               Cheio</span>
                             </label>
                           </div>
                         </div>
                       </div>
                       <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <div class="col-xl-4">
                          <div class="row">
                            <div class="mb-4">
                              <div class="form-selectgroup form-selectgroup-pills">

                                <label class="form-selectgroup-item">
                                  <input type="radio" id="categoria" name="categoria" value="Importação" class="form-selectgroup-input" checked>
                                  <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packge-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                     <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"></path>
                                     <path d="M12 12l8 -4.5"></path>
                                     <path d="M12 12v9"></path>
                                     <path d="M12 12l-8 -4.5"></path>
                                     <path d="M22 18h-7"></path>
                                     <path d="M18 15l-3 3l3 3"></path>
                                   </svg> Importação</span>
                                 </label>
                                 <label class="form-selectgroup-item">
                                  <input type="radio" id="categoria" name="categoria" value="Exportação" class="form-selectgroup-input">
                                  <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packge-export" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                     <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"></path>
                                     <path d="M12 12l8 -4.5"></path>
                                     <path d="M12 12v9"></path>
                                     <path d="M12 12l-8 -4.5"></path>
                                     <path d="M15 18h7"></path>
                                     <path d="M19 15l3 3l-3 3"></path>
                                   </svg>
                                 Exportação</span>
                               </label>
                             </div>
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
