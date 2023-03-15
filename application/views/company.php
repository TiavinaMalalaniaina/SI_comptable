<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - NiceAdmin Bootstrap Template</title>
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
  <link href="assets/css/style.css" rel="stylesheet">

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
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?php echo bu('assets/img/'.$company['logo']) ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $company['name'] ?></h2>
              <h3><?php echo $company['leader'] ?></h3>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>
        </div>

        

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">About</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Document">Document</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">
                    <?php echo $company['objet'] ?>
                  </p>

                  <h5 class="card-title">Société Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom de la société</div>
                    <div class="col-lg-9 col-md-8"><?php echo $company['name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nom du dirigeant</div>
                    <div class="col-lg-9 col-md-8"><?php echo $company['leader'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Addresse sociale</div>
                    <div class="col-lg-9 col-md-8"><?php echo $company['address_social'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Addresse exploitation</div>
                    <div class="col-lg-9 col-md-8"><?php echo $company['address_exploitation'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telephone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $company['tel'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telecopie</div>
                    <div class="col-lg-9 col-md-8"><?php echo $company['telecopie'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Devise de tenue de compte</div>
                    <div class="col-lg-9 col-md-8"><?php echo $detail['devise'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Numéro d'identification fiscale</div>
                    <div class="col-lg-9 col-md-8"><?php echo $detail['nif'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Numéro statistique</div>
                    <div class="col-lg-9 col-md-8"><?php echo $detail['ns'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Numéro du registre du commerce</div>
                    <div class="col-lg-9 col-md-8"><?php echo $detail['rcs'] ?></div>
                  </div>

                </div>

                <div class="tab-pane fade Document pt-3" id="Document">
                  <h5 class="card-title">Upload un document</h5>

                  
                  <form class="row g-3" action="<?php echo site_url('Company/saveDocs') ?>" method="post" enctype="multipart/form-data">
                  
                    <div class="col-md-6">
                      <label for="file" class="form-label">File</label>
                      <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <div class="col-md-6">
                      <label for="intitule" class="form-label">Intitule</label>
                      <input type="text" class="form-control" id="intitule" name="intitule">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Valider</button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                  </form>

                  <h5 class="card-title">Document de l'entreprise</h5>

                  <section class="section">
                    <div class="row">
                      <div class="col-lg-12">

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Filename</th>
                              <th scope="col">Intitule</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($docs as $doc) { ?>
                            <tr>
                              <th scope="row"><?php echo $doc['id'] ?></th>
                              <td><?php echo $doc['name'] ?></td>
                              <td><?php echo $doc['intitule'] ?></td>
                              <td><a href="<?php echo bu('company/download?id='.$doc['id']); ?>"><i class="bi bi-download"></i></a></td>
                            </tr>
                          <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </section>
                  
                </div>
              </div><!-- End Bordered Tabs -->

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