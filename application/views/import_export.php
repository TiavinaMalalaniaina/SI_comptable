<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forms / Layouts - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Importation de fichier CSV</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?php bu('CSV/import')?>" method="post" enctype="multipart/form-data">
                <div class="col mb-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">FILE</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="file" id="formFile" name="csv">
                  </div>
                </div>

                <div class="col-mb-12">
                <label for="inputNumber" class="col-sm-2 col-form-label">Table</label>
                <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="table">
                <?php
                  for ($i=0; $i < count($tables); $i++) { 
                    ?>
                      <option value="<?php echo $tables[$i]?>"><?php echo $tables[$i]?></option>
                    <?php
                  }
                ?>
                </select>
              
              </div>
                
                

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>

      </div>

      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Exportation de fichier CSV</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" action="<?php bu('CSV/export')?>" method="post" enctype="multipart/form-data">
                <div class="col-mb-12">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Separator</label>
                    <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="separator">
                        <option value="">,</option>
                        <option value="">;</option>
                    </select>
                </div>
                <div class="col-mb-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Table</label>
                  <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="table">
                  <?php
                    for ($i=0; $i < count($tables); $i++) { 
                      ?>
                        <option value="<?php echo $tables[$i]?>"><?php echo $tables[$i]?></option>
                      <?php
                    }
                  ?>
                  </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End Multi Columns Form -->


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
  <script src="<?php echo site_url('assets/js/main.js') ?>"></script>

</body>

</html>