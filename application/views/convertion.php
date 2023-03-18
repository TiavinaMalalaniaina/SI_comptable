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
              <h5 class="card-title">Convertir Ar en d'autre devise</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?php echo bu('convertion/convertion_compte_devise') ?>" method="post">
                <div class="col mb-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Argent</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="number" id="formFile" name="argent">
                  </div>
                </div>

                <div class="col-mb-12">
                <label for="inputNumber" class="col-sm-5 col-form-label">Devise d'equivalence</label>
                <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="devise">
                <?php foreach ($devise as $d) { ?>
                  <option value="<?php echo $d['code'] ?>"><?php echo $d['name'] ?>(<?php echo $d['code'] ?>)</option>
                <?php } ?> 
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
            <h5 class="card-title">Convertir d'autre devise en Ar</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" action="<?php echo bu('convertion/convertion_devise_compte') ?>" method="post">
                <div class="col mb-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Argent</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="number" id="formFile" name="argent">
                  </div>
                </div>

                <div class="col-mb-12">
                <label for="inputNumber" class="col-sm-5 col-form-label">Devise d'equivalence</label>

                <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="devise">
                <?php foreach ($devise as $d) { ?>
                  <option value="<?php echo $d['code'] ?>"><?php echo $d['name'] ?>(<?php echo $d['code'] ?>)</option>
                <?php } ?> 
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

    <div class="offset-2 col-lg-8">
      <?php if (isset($convert)) { ?>
        <div class="card">
          <div class="card-body">
            <center>
              <h5 class="card-title">Convertion</h5>
              <p> <?php echo $convert['argent1']." ".$convert['devise1'] ?> <span> <i class="bi bi-arrow-right"></i> </span> <?php echo $convert['argent2']." ".$convert['devise2'] ?></p>
            </center>
          </div>
        </div>
      <?php } ?>

        </div>

        </div>
      </div>

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