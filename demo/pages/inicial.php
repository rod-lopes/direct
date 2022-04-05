<?php
@session_start();
require_once('conexao.php');
require_once('verificar-permissao.php');
$hoje = date('d/m/Y');

$date = date("Y-m-d");
$dataAtual = strtotime ($date);


//CONSULTAR OS ULTIMOS 7 DIAS
 
   $data_7dias = date('Y-m-d', strtotime($date. ' - 7 days'));
   $data_14dias = date('Y-m-d', strtotime($date. ' - 14 days'));
    $data_30dias = date('Y-m-d', strtotime($date. ' - 30 days'));

function formatDateObj($dateString) {
$dateString = new DateTime($dateString);
$dateString->format('Y-m-d H:i:s.uO'); 
return $dateString;
    
}


//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * from usuarios WHERE id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

//CONTAR A QUANTIDADE DE REGISTROS NA TABELA CONTAINER
$query_qnt_container = "SELECT COUNT(id) AS num_container FROM container";
$result_qnt_container = $pdo->prepare($query_qnt_container);
$result_qnt_container->execute();
$row_qnt_container = $result_qnt_container->fetch(PDO::FETCH_ASSOC);            
//Quantidade de página
$qnt_container = $row_qnt_container['num_container'];
            
//CONTAR A QUANTIDADE DE REGISTROS NA TABELA MOVIMENTAÇÃO
$query_qnt_mov = "SELECT COUNT(id) AS num_mov FROM movimentacao";
$result_qnt_mov = $pdo->prepare($query_qnt_mov);
$result_qnt_mov->execute();
$row_qnt_mov = $result_qnt_mov->fetch(PDO::FETCH_ASSOC);            
//Quantidade de página
$qnt_mov = $row_qnt_mov['num_mov'];

//SELECIONANDO OS O VALOR DAS CATEGORIAS (SOMA DAS MOVIMENTAÇÕES - GRAFICO DONUTS)
$soma_categorias = $pdo->query("SELECT M.tipo, count(M.tipo) as TOTAL FROM movimentacao M GROUP BY M.tipo ORDER BY TOTAL DESC");
$soma_cat = $soma_categorias-> fetchAll(PDO::FETCH_ASSOC);
$total_reg5 = @count($soma_cat);
if($total_reg5 > 0){ 

$cat1 = 0;
$cat2 = 0;
$cat3 = 0;
$cat4 = 0;
$cat5 = 0;
$cat6 = 0;
$cat7 = 0;

$cat1 = $cat1 + $soma_cat[0]['TOTAL'];
$cat2 = $cat2 + $soma_cat[1]['TOTAL'];
$cat3 = $cat3 + $soma_cat[2]['TOTAL'];
$cat4 = $cat4 + $soma_cat[3]['TOTAL'];
$cat5 = $cat5 + $soma_cat[3]['TOTAL'];
$cat6 = $cat6 + $soma_cat[3]['TOTAL'];
$cat7 = $cat7 + $soma_cat[3]['TOTAL'];
}

//SELECIONANDO OS O VALOR DAS CATEGORIAS CONTAINER - IMPORTAÇÃO E EXPORTAÇÃO (SOMA DAS MOVIMENTAÇÕES - GRAFICO BARRAS)

$soma_imp_exp = $pdo->query("SELECT C.categoria, count(C.categoria) as TOTAL2 FROM container C GROUP BY C.categoria ORDER BY TOTAL2 DESC");
$soma_i_e = $soma_imp_exp-> fetchAll(PDO::FETCH_ASSOC);
$total_reg6 = @count($soma_i_e);
if($total_reg6 > 0){ 
    


$imp = (int)($soma_i_e[0]['TOTAL2']);
$exp = (int)($soma_i_e[1]['TOTAL2']);
    

              
}
?>



      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="index.php?m=criar_movimentacao" class="btn btn-white">
                      Nova Movimentação
                    </a>
                  </span>
                  <a href="index.php?c=criar_container" class="btn btn-primary d-none d-sm-inline-block" >
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Cadastrar Container
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              <div class="col-sm-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Containers Registrados</div>
                      <div class="ms-auto lh-1">
                        
                      </div>
                    </div>
                    <div class="h1 mb-3"><?php echo $qnt_container ?></div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Movimentações</div>
                      
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2"><?php echo $qnt_mov ?></div>
                      
                    </div>
                  </div>                  
                </div>
              </div> 
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Gráfico Contânier</h3>
                    <div id="chart-combination"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Tipo De Movimetação</h3>
                    <div class="ratio ratio-21x9">
                      <div>
                         <div id="chart-demo-pie"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>