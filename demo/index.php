<?php
@session_start();
require_once('conexao.php');
require_once('verificar-permissao.php');
$hoje = date('d/m/Y');
$ano = date('Y');

//BUSCAR A PÁGINA CORRESPONDENTE
$pagina = "pages/inicial.php";
if (isset($_GET['m'])) {
  $pagina = 'pages/movimentacoes/' . $_GET['m'] . ".php";
}

if (isset($_GET['c'])) {
  $pagina = 'pages/containers/' . $_GET['c'] . ".php";
}


if (isset($_GET['p'])) {
  $pagina = 'pages/perfil/' . $_GET['p'] . ".php";
}

//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * from usuarios WHERE id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_usu = $res[0]['nome'];
$primeiroNome = explode(" ", $nome_usu);
$email = $res[0]['email'];
$id = $res[0]['id'];

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
<body >
  <div class="page">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
      <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
          <a href=".">
            <img src="./static/logo.png" alt="Direct" class="navbar-brand-image">
          </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
          <div class="nav-item d-none d-md-flex me-3">
            <div class="btn-list">         
            </div>
          </div>
          <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
          </a>
          <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
          </a>   
          <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
              <span class="avatar avatar-sm" style="background-image: url(./static/avatars/sem-foto.png)"></span><br>
              <div class="d-none d-xl-block ps-2">
                <div><?php echo current($primeiroNome); ?></div>
                <div class="mt-1 small text-muted"></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <a href="index.php?p=perfil" class="dropdown-item">Perfil</a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item">Sair</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="navbar-expand-md">
      <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
          <div class="container-xl">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="./index.php" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Início
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?c=gerenciar_container" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="9" x2="10" y2="9" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="9" y1="17" x2="15" y2="17" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Gerenciar Containers
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?m=gerenciar_movimentacao" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Movimentações
                  </span>
                </a>
              </li>               
              <li class="nav-item">
                <a class="nav-link" href="./logout.php" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 11 12 14 20 6" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Sair
                  </span>
                </a>
              </li>
            </ul>
            
          </div>
        </div>
      </div>
    </div>
    <?php include($pagina); ?>
    <footer class="footer footer-transparent d-print-none">
      <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
          <div class="col-lg-auto ms-lg-auto">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCLQqypfvqsIzutrqjlmXqdw" class="link-secondary">YouTube</a></li>
              <li class="list-inline-item"><a href="https://github.com/rod-lopes/rod-lopes" target="_blank" class="link-secondary" rel="noopener">Código Fonte</a></li>
              <li class="list-inline-item">
                Rodrigo Basso Lopes 
              </li>
            </ul>
          </div>
          <div class="col-12 col-lg-auto mt-3 mt-lg-0">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item">
                Copyright &copy; 2022
                <a href="." class="link-secondary"><?php echo $nome_sistema; ?></a>.
                Todos os Direitos Reservados.
              </li>
              <li class="list-inline-item">
                V1.0                   
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
</div>
<!-- Libs JS -->
<script src="./dist/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="./dist/libs/jsvectormap/dist/js/jsvectormap.min.js"></script>
<script src="./dist/libs/nouislider/dist/nouislider.min.js"></script>
<script src="./dist/libs/litepicker/dist/litepicker.js"></script> 
<script src="./dist/libs/tom-select/dist/js/tom-select.base.min.js"></script>

<!-- Tabler Core -->

<script src="./dist/js/tabler.min.js"></script>
<script src="./dist/js/demo.min.js"></script>

<!-- GRÁFICO CONTÊINER -->
<script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-combination'), {
          chart: {
            type: "bar",
            fontFamily: 'inherit',
            height: 240,
            parentHeightOffset: 0,
            toolbar: {
              show: false,
            },
            animations: {
              enabled: false
            },
          },
          plotOptions: {
            bar: {
              columnWidth: '50%',
            }
          },
          dataLabels: {
            enabled: false,
          },
          fill: {
            opacity: 1,
          },
          series: [{
            name: "Importações",
            data: [<?php echo $imp; ?>,0,0,0]
          },{
            name: "Exportações",
            data: [<?php echo $exp; ?>,0,0,0]
          }],
          grid: {
            padding: {
              top: -20,
              right: 0,
              left: -4,
              bottom: -4
            },
            strokeDashArray: 4,
          },
          xaxis: {
            labels: {
              padding: 0,
            },
            tooltip: {
              enabled: false
            },
            axisBorder: {
              show: false,
            },
            categories: ['Contêineres'],
          },
          yaxis: {
            labels: {
              padding: 4
            },
          },
          colors: ["#5eba00", "#206bc4"],
          legend: {
            show: false,
          },
        })).render();
      });
      // @formatter:on
    </script>
    
    
    <!-- GRÁFICO MOVIMENTAÇÕES -->
    <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
          chart: {
            type: "donut",
            fontFamily: 'inherit',
            height: 240,
            sparkline: {
              enabled: true
            },
            animations: {
              enabled: false
            },
          },
          fill: {
            opacity: 1,
          },
          series: [<?php echo $cat1; ?>,<?php echo $cat2; ?>,<?php echo $cat3; ?>,<?php echo $cat4; ?>,<?php echo $cat5; ?>,<?php echo $cat6; ?>,<?php echo $cat7; ?>],
          labels: ["<?php echo $soma_cat[0]['tipo']; ?>", "<?php echo $soma_cat[1]['tipo']; ?>", "<?php echo $soma_cat[2]['tipo']; ?>", "<?php echo $soma_cat[3]['tipo']; ?>", "<?php echo $soma_cat[4]['tipo']; ?>", "<?php echo $soma_cat[5]['tipo']; ?>", "<?php echo $soma_cat[6]['tipo']; ?>"],
          grid: {
            strokeDashArray: 5,
          },
          colors: ["#206bc4", "#6495ED", "#483d8b", "#6959CD", "#e9ecf1" , "#191970", "#00BFFF"],
          legend: {
            show: true,
            position: 'bottom',
            offsetY: 12,
            markers: {
              width: 10,
              height: 10,
              radius: 100,
            },
            itemMargin: {
              horizontal: 8,
              vertical: 8
            },
          },
          tooltip: {
            fillSeriesColor: false
          },
        })).render();
      });
      // @formatter:on
    </script>
  </body>
  </html>