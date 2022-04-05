<?php

@session_start();
require_once('conexao.php');
require_once('verificar-permissao.php');

//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * from movimentacao ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

//CONTAR A QUANITDADE DE REGISTROS NA TABELA CONTAINER
            $query_qnt_movimentacao = "SELECT COUNT(id) AS num_movimentacao FROM movimentacao";
            $result_qnt_movimentacao = $pdo->prepare($query_qnt_movimentacao);
            $result_qnt_movimentacao->execute();
            $row_qnt_movimentacao = $result_qnt_movimentacao->fetch(PDO::FETCH_ASSOC);            
            //Quantidade de página
            $qnt_movimentacao = $row_qnt_movimentacao['num_movimentacao'];

?>

<div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Gerenciar Movimentações
                </h2>
              </div>
            </div>
          </div>
        </div>
        
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
                
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lista de Movimentações</h3>
                  </div>
                  <div class="col-12">
               
                  <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                      <div class="text-muted">
                       Total de Movimentações: <strong> <?php echo $qnt_movimentacao; ?> </strong>
                      </div>
                      <div class="ms-auto text-muted">
                        <div class="ms-2 d-inline-block">
                          <a href="index.php?m=criar_movimentacao" class="btn btn-outline-success w-100">Cadastrar Movimentação
                        </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  
          <?php 
          //RECEBER O NUMERO DA PAGINA
          $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
          $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
          
          //SETAR A QUANTIDADE DE REGISTROS POR PÁGINA
          $limite_resultado = 20;
          $início_contagem = 19;
          
        // CALCULAR O INICIO DA VISUALIZAÇÃO
            $inicio = ($limite_resultado * $pagina) - $limite_resultado;
          
  $query = $pdo->query("SELECT * from movimentacao ORDER BY idcontainer ASC LIMIT $inicio, $limite_resultado");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg = @count($res);
  if($total_reg > 0){ 
    ?>
                  
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          
                          <th class="w-1"><strong>#</strong> <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                         
                       <!--    
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
                        -->
                          </th>
                          <th>Cliente</th>
                          <th>Contêiner</th>
                          <th>Movimentação</th>
                          <th>Data/Hora Início</th>
                          <th>Data/Hora Fim</th>
                          <th>Gerenciar</th> 
                          </tr>
                      </thead>
                      <tbody>
                           <?php 
                    //SELECIONA A MOVIMENTAÇÃO DOS CONTÂINER NA TABELA
            for($i=0; $i < $total_reg; $i++){
            foreach ($res[$i] as $key => $value){ }
            $id = $res[$i]['id'];
          $tipo = $res[$i]['tipo'];
          $tipo = strtoupper($tipo);
            $dhinicio = $res[$i]['dhinicio'];
            $dhfim = $res[$i]['dhfim'];
            $idcontainer = $res[$i]['idcontainer'];
            ?>
                        <tr>
                        <?php
                        //RELACIONANDO O CONTÊINER COM O LANÇAMENTO
                        $query_conteiner = $pdo->query("SELECT * from container WHERE id = '$idcontainer' ");
                        $res2 = $query_conteiner->fetchAll(PDO::FETCH_ASSOC);
                        $total_reg2 = @count($res2);
                      if($total_reg2 > 0){ 
                          
                          
                            for($i2=0; $i2 < $total_reg2; $i2++){
                          foreach ($res2[$i] as $key2 => $value2){  }
                                $id_container = $res2[$i2]['id'];
                          $numero = $res2[$i2]['numero'];
                          $numero = strtoupper($numero );
                                $cliente = $res2[$i2]['cliente'];
                                $cliente = strtoupper($cliente);
                                
                          
                      ?>
                          
                          <td><span class="text-muted"><a href="#" class="text-reset" tabindex="-1"><?php echo $id; ?></a></span></td>
                          <td><?php echo $cliente; ?></td>
                          <td><a href="index.php?c=editar_container&id=<?php echo $id_container; ?>" class="text-reset" tabindex="-1"><?php echo $numero; ?></a></td>
                          <td><?php echo $tipo; ?></td>
                          <td><?php echo date('d/m/Y H:i', strtotime($dhinicio)); ?></td>
                         <td><?php echo date('d/m/Y H:i', strtotime($dhfim)); ?></td>
                         

                          <td><a href="index.php?m=editar_movimentacao&id=<?php echo $res[$i]['id']; ?>">Editar </a> / <a href="index.php?m=excluir_movimentacao&id=<?php echo $res[$i]['id']; ?>">Excluir </a></td>
                          <?php
                            }
                      }
                        ?>  
                        </tr>
                         <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  
                   
               <?php }else{ ?>
                    <div class="alert alert-danger" role="alert">
                    <?php echo 'Não existem movimentações para serem exibidas'; ?>
                    </div>                                         
            
              <?php } ?>
              
              <?php
              
              //CONTAR A QUANITDADE DE REGISTROS NO BD
            $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM movimentacao";
            $result_qnt_registros = $pdo->prepare($query_qnt_registros);
            $result_qnt_registros->execute();
            $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);
            
            //Quantidade de página
            $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);
            
            // Maximo de link
            $maximo_link = 1;
            
            $registros_pagina = $limite_resultado * $pagina;
            if ($registros_pagina>$row_qnt_registros['num_result']){
            $registros_pagina = $row_qnt_registros['num_result'];
            }else {
                $registros_pagina = $limite_resultado * $pagina;
            }
            $registros_pagina_final = $registros_pagina - $início_contagem;
            if ($registros_pagina_final<0){
                $registros_pagina_final=1;
            }

            
            ?>
                  <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Mostrando: <span><?php echo $registros_pagina_final; ?></span> a <span><?php echo $registros_pagina; ?></span> de <span><?php echo $row_qnt_registros['num_result']; ?></span> registros</p>
                    <ul class="pagination m-0 ms-auto">
                      <li class="page-item">
                        <a class="page-link" href="index.php?page=1&m=gerenciar_movimentacao" >
                          <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>
                          Primeira
                        </a>
                      </li>
                      <?php
                      
                      for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
                if ($pagina_anterior >= 1) { ?>
                
                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $pagina_anterior; ?>&m=gerenciar_movimentacao"><?php echo $pagina_anterior; ?></a></li>
               
                <?php
                }
                
                      }
                      ?>
                      <li class="page-item active"><a class="page-link" href="#"><?php echo $pagina; ?></a></li>
                      
                      <?php
                      
                      for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
                if ($proxima_pagina <= $qnt_pagina) {
                      ?>
                      <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $proxima_pagina; ?>&m=gerenciar_movimentacao"><?php echo $proxima_pagina; ?></a></li>
                       <?php
                }
                
                      }
                      ?>
                      <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $qnt_pagina; ?>&c=gerenciar_container">
                          Última <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>