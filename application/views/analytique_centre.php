<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forms / Layouts - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo site_url('assets/img/favicon.png') ?>" rel="icon">
  <link href="<?php echo site_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo site_url('assets/css/style.css') ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
  .number {
    text-align: right;
  }
</style>
<body>
 


<main id="main" class="main">

<div class="pagetitle">
  <h1>A propos de la société</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Forms</li>
      <li class="breadcrumb-item active">Layouts</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
    
<div class="card">
  <div class="card-body">
    <h5 class="card-title">General Form Elements</h5>

    <!-- General Form Elements -->
    <form action="<?php bu('Analytique/index2')?>" method="get">
      <div class="row">
        <div class="col-lg-5">
        <div class="row mb-3">
          <div class="col-sm-6">
            <select class="form-select" aria-label="Default select example" name="centre">
              <?php
                for ($i=0; $i < count($centres) ; $i++) { 
                  ?>
                    <option value="<?php echo $centres[$i]['id']?>"><?php echo $centres[$i]['nom']?></option>
                  <?php
                }
              ?>
            </select>
          </div>
          <div class="col-sm-6">
            <input type="date" name="date" id="">
          </div>
        </div>
      </div>
      

      <div class="row mb-3">
        <label class="col-sm-5 col-form-label"></label>
        <div class="col-sm-7">
          <button type="submit" class="btn btn-primary">Valider</button>
        </div>
      </div>

    </form><!-- End General Form Elements -->

  </div>
</div>
  </div>
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body" style="overflow-x: auto;">
          <h5 class="card-title">Résultat analytique <?php echo $centre['nom']?> du <?php echo $daty?></h5>
          <table class="table table-bordered" style="font-size: 90%; width:max-content">
            <thead>
              <tr>
                <th rowspan="2">Rubriques</th>
                <th rowspan="2">Pourcentage</th>
                <th rowspan="2">Unité d'oeuvre</th>
                <th rowspan="2">Nature</th>
                <th colspan="2">P1</th>
                <th colspan="2">P2</th>
                <th colspan="2">TOTAL</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Fixe</td>
                <td>Variable</td>
                <td>Fixe</td>
                <td>Variable</td>
                <td>Fixe</td>
                <td>Variable</td>
              </tr>
              <?php
              for ($i=0; $i < count($charges); $i++) { 
                ?>
                <tr>
                <td><?php echo $charges[$i]['nom']?></td>
                <td><?php echo $charges[$i]['pour_p']?>%</td>
                <td><?php echo $charges[$i]['unite_oeuvre']?></td>
                <td><?php echo $charges[$i]['nature']?></td>
                <?php for ($j=0; $j < count($produits); $j++) { 
                    ?>
                    <td><?php echo $charges[$i]['fixe'][$j]?></td>
                    <td><?php echo $charges[$i]['variable'][$j]?></td>
                    <?php
                }?>
                <td><?php echo $charges[$i]['sum_fix']?></td>
                <td><?php echo $charges[$i]['sum_var']?></td>
              </tr>
                <?php
              }
              ?>
              <tr>
                <td colspan="4">TOTAL</td>
                <?php 
                for ($i=0; $i < count($produits); $i++) { 
                   ?>
                   <td><?php echo $produits[$i]['sum_fix']?></td>
                   <td><?php echo $produits[$i]['sum_var']?></td>
                   <?php
                }
                ?>
                <td><?php echo $last[0]?></td>
                <td><?php echo $last[1]?></td>
              </tr>
              <tr>
                <td colspan="4"></td>
                <?php 
                for ($i=0; $i < count($produits); $i++) { 
                   ?>
                   <td colspan="2"><?php echo $produits[$i]['sum_sum']?></td>
                   <?php
                }
                ?>
                <td colspan="2"><?php echo $last[2]?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

    </div>
  </div>
</section>

<section>
<div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Part par produit</h5>

          <!-- Pie Chart -->
          <div id="pieChart"></div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              new ApexCharts(document.querySelector("#pieChart"), {
                series: <?php echo json_encode($perc[0])?>,
                chart: {
                  height: 350,
                  type: 'pie',
                  toolbar: {
                    show: true
                  }
                },
                labels:  <?php echo json_encode($perc[1])?>
              }).render();
            });
          </script>
          <!-- End Pie Chart -->

        </div>
      </div>
      </div>
</section>


</main><!-- End #main -->





 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo site_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/chart.js/chart.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/echarts/echarts.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/quill/quill.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/php-email-form/validate.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>