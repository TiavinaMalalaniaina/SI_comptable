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
    <form>
      <div class="row">
        <div class="col-lg-5">
        <div class="row mb-3">
          <div class="col-sm-6">
            <select class="form-select" aria-label="Default select example">
              <option selected>Choisir un produit</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div class="col-sm-6">
            <select class="form-select" aria-label="Default select example">
              <option selected>Choisir une date</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
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
          <h5 class="card-title">Résultat analytique</h5>
          <table class="table table-bordered" style="font-size: 90%; width: <?php echo 800*4 ?>px">
            <thead>
              <tr>
                <th scope="col" rowspan="2">Rubriques</th>
                <th scope="col" rowspan="2">TOTAL</th>
                <th scope="col" rowspan="2">Unité d'oeuvre</th>
                <th scope="col" rowspan="2">Nature</th>
                <th scope="col" colspan="3">ADM/Dist</th>
                <th scope="col" colspan="3">Usine</th>
                <th scope="col" colspan="3">Plantation</th>
                <th scope="col" colspan="2">TOTAL</th>
              </tr>
              <tr>
                <td>%</td>
                <td>Fixe</td>
                <td>Variable</td>
                <td>%</td>
                <td>Fixe</td>
                <td>Variable</td>
                <td>%</td>
                <td>Fixe</td>
                <td>Variable</td>
                <td>Fixe</td>
                <td>Variable</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Frais de transport</td>
                <td><?php echo format_to_money(3200000) ?></td>
                <td>KG</td>
                <td>V</td>
                <td class="number">100,00%</td>
                <td class="number"> - </td>
                <td class="number"><?php echo format_to_money(3200000) ?></td>
                <td class="number">0,00%</td>
                <td class="number">-</td>
                <td class="number">-</td>
                <td class="number">0,00%</td>
                <td class="number">-</td>
                <td class="number">-</td>
                <th class="number">-</th>
                <th class="number"><?php echo format_to_money(3200000) ?></th>
              </tr>
              <tr>
                <td>Frais de transport</td>
                <td class="number"><?php echo format_to_money(3200000) ?></td>
                <td>KG</td>
                <td>V</td>
                <td class="number">100,00%</td>
                <td class="number"> - </td>
                <td class="number"><?php echo format_to_money(3200000) ?></td>
                <td class="number">0,00%</td>
                <td class="number">-</td>
                <td class="number">-</td>
                <td class="number">0,00%</td>
                <td class="number">-</td>
                <td class="number">-</td>
                <th class="number">-</th>
                <th class="number"><?php echo format_to_money(3200000) ?></th>
              </tr>
              <tr>
                <td>Frais de transport</td>
                <td class="number"><?php echo format_to_money(3200000) ?></td>
                <td>KG</td>
                <td>V</td>
                <td class="number">100,00%</td>
                <td class="number"> - </td>
                <td class="number"><?php echo format_to_money(3200000) ?></td>
                <td class="number">0,00%</td>
                <td class="number">-</td>
                <td class="number">-</td>
                <td class="number">0,00%</td>
                <td class="number">-</td>
                <td class="number">-</td>
                <th class="number">-</th>
                <th class="number"><?php echo format_to_money(3200000) ?></th>
              </tr>
              <tr>
                <td>Frais de transport</td>
                <td><?php echo format_to_money(3200000) ?></td>
                <td>KG</td>
                <td>V</td>
                <td>100,00%</td>
                <td> - </td>
                <td><?php echo format_to_money(3200000) ?></td>
                <td>0,00%</td>
                <td>-</td>
                <td>-</td>
                <td>0,00%</td>
                <td>-</td>
                <td>-</td>
                <th>-</th>
                <th><?php echo format_to_money(3200000) ?></th>
              </tr>
              <tr>
                <td>Frais de transport</td>
                <td><?php echo format_to_money(3200000) ?></td>
                <td>KG</td>
                <td>V</td>
                <td>100,00%</td>
                <td> - </td>
                <td><?php echo format_to_money(3200000) ?></td>
                <td>0,00%</td>
                <td>-</td>
                <td>-</td>
                <td>0,00%</td>
                <td>-</td>
                <td>-</td>
                <th>-</th>
                <th><?php echo format_to_money(3200000) ?></th>
              </tr>
              <tr>
                <td>Frais de transport</td>
                <td><?php echo format_to_money(3200000) ?></td>
                <td>KG</td>
                <td>V</td>
                <td>100,00%</td>
                <td> - </td>
                <td><?php echo format_to_money(3200000) ?></td>
                <td>0,00%</td>
                <td>-</td>
                <td>-</td>
                <td>0,00%</td>
                <td>-</td>
                <td>-</td>
                <th>-</th>
                <th><?php echo format_to_money(3200000) ?></th>
              </tr>
    <!-- TOTAL -->
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th class="number">-</th>
                <th class="number"><?php echo format_to_money(56000000) ?></th>
                <td></td>
                <th class="number">-</th>
                <th class="number"><?php echo format_to_money(56000000) ?></th>
                <td></td>
                <th>-</th>
                <th class="number"><?php echo format_to_money(56000000) ?></th>
                <th class="number"><?php echo format_to_money(56000000) ?></th>
                <th class="number"><?php echo format_to_money(56000000) ?></th>
              </tr>

              <tr>
                <th>TOTAL</th>
                <th class="number"><?php echo format_to_money(5800000) ?></th>
                <th></th>
                <th></th>
                <th class="number" colspan="3"><?php echo format_to_money(5800000) ?></th>
                <th class="number" colspan="3"><?php echo format_to_money(5800000) ?></th>
                <th class="number" colspan="3"><?php echo format_to_money(5800000) ?></th>
                <th class="number" colspan="2"><?php echo format_to_money(5800000) ?></th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

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