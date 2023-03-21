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

<body>
 

  
<main>
    <div class="container" style="overflow: x;">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create a Society</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                   <!-- Multi Columns Form -->
              <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                <div class="col-md-2">
                  <label for="company" class="form-label">Jour</label>
                  <input type="text" class="form-control" id="company" name="name">
                </div>
                <div class="col-md-2">
                  <label for="company" class="form-label">N° pièce</label>
                  <input type="text" class="form-control" id="company" name="name">
                </div>
                <div class="col-md-2">
                  <label for="leader" class="form-label">Référence pièce</label>
                  <input type="text" class="form-control" id="leader" name="leader">
                </div>
                <div class="col-md-2">
                  <label for="contact" class="form-label">N°compte général</label>
                  <input type="text" class="form-control" id="contact" name="contact">
                </div>
                <div class="col-md-2">
                  <label for="contact" class="form-label">N°compte tiers</label>
                  <input type="text" class="form-control" id="telecopie" name="telecopie">
                </div>
                <div class="col-md-2">
                  <label for="address_social" class="form-label">Libellé écriture</label>
                  <input type="text" class="form-control" id="address_social" name="social">
                </div>
                <div class="col-md-2">
                  <label for="address_exploitation" class="form-label">Echéance</label>
                  <input type="date" class="form-control" id="address_exploitation" name="exploit">
                </div>
                <div class="col-md-2">
                  <label for="address_exploitation" class="form-label">Devise</label>
                  <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="type">
                    <option value="">Tiavina</option>
                    <option value="">Tiavina</option>
                    <option value="">Tiavina</option>
                    <option value="">Tiavina</option>
                  </select>
                </div><div class="col-md-2">
                  <label for="address_exploitation" class="form-label">Devise</label>
                  <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="type">
                    <option value="">Tiavina</option>
                    <option value="">Tiavina</option>
                    <option value="">Tiavina</option>
                    <option value="">Tiavina</option>
                  </select>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Valider</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->


                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

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
  <script src="assets/js/main.js"></script>

</body>

</html>