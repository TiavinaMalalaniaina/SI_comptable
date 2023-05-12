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
  <h1>Form Elements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Forms</li>
      <li class="breadcrumb-item active">Elements</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Seuil de rentabilité</h5>

          <!-- General Form Elements -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td>p1</td>
                  <td>p2</td>
                  <td>p3</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="number">
                    <?php echo format_to_money(3600000) ?>
                  </td>
                  <td class="number">
                    <?php echo format_to_money(3600000) ?>
                  </td>
                  <td class="number">
                    <?php echo format_to_money(3600000) ?>
                  </td>
                </tr>
              </tbody>
            </table>

        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Seuil de rentabilité</h5>

          <!-- General Form Elements -->
            <table class="table table-bordered">
                <tr>
                  <th>Chiffre d'affaire</th>
                  
                  <td class="number">
                    <?php echo format_to_money($ca) ?>
                  </td>
                </tr>
                <tr>
                  <th>Cout de variable</th>
                  
                  <td class="number">
                    <?php echo format_to_money($cv) ?>
                  </td>
                <tr>
                  <tr>
                    <th>Cout de Fixe</th>
                    
                  <td class="number">
                    <?php echo format_to_money($cf) ?>
                  </td>
                  <tr>
                  <tr>
                    <th>Marge globale</th>
                    
                  <td class="number">
                    <?php echo format_to_money($mg) ?>
                  </td>
                  <tr>
                  <tr>
                    <th>Marge sur cout variable</th>
                    
                  <td class="number">
                    <?php echo format_to_money($mcv) ?>
                  </td>
                  <tr>
                  <tr>
                    <th>Marge sur cout fixe</th>
                    
                  <td class="number">
                    <?php echo format_to_money($mcf) ?>
                  </td>
                  <tr>
                  <tr>
                    <th>Seuil</th>
                    
                  <td class="number">
                    <?php echo format_to_money($seuil) ?>
                  </td>
                  <tr>
            </table>

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