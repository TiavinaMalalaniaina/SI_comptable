<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / Data - NiceAdmin Bootstrap Template</title>
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
  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?php echo $title ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Ajouter un nouveau compte</h5>
        <!-- No Labels Form -->
        <form class="row g-3" action="<?php echo site_url($insert) ?>" method="post">
        <?php if(isset($tiers)) { ?>
            <div class="col-md-2">
              <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="type">
                <?php foreach ($tiers as $t) { ?>
                  <option value="<?php echo $t['id'] ?>"><?php echo $t['name'] ?></option>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
                              
          <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Code" name="code">
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Intitule" name="intitule">
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </div>
        </form><!-- End No Labels Form -->
      </div>
    </div>



    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Les comptes générales dans la société</h5>
              <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Intitulé</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($compte as $c) { ?>
                    <tr>
                      <th scope="row"><?php echo $c['code'] ?></th>
                      <td><?php echo $c['intitule'] ?></td>
                      <td>

                        <!-- Vertically centered Modal -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered" title="modifier">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <div class="modal fade" id="verticalycentered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Vertically Centered</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <h5 class="card-title">Ajouter un nouveau compte</h5>
                            <!-- No Labels Form -->
                            <form class="row g-3" action="<?php echo site_url($update) ?>" method="post">
                              <input type="hidden" class="form-control" placeholder="id" value="<?php echo $c['code'] ?>" name="id">
                              <?php if(isset($tiers)) { ?>
                              <div class="col-md-2">
                                <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="type">
                                  <?php foreach ($tiers as $t) { ?>
                                    <option value="<?php echo $t['id'] ?>"><?php echo $t['name'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <?php } ?>
                              <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Code" value="<?php echo $c['code'] ?>" name="code">
                              </div>
                              <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Intitule" value="<?php echo $c['intitule'] ?>" name="intitule">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </form><!-- End No Labels Form -->
                            </div>
                          </div>
                        </div>
                      </div><!-- End Vertically centered Modal-->

                    </td>
                    <td>
                      <a href="<?php echo site_url($delete."?code=".$c['code']) ?>">
                        <i class="bi bi-trash-fill"></i>
                      </a>
                    </td>                  </tr>
                  <?php } ?>

                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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