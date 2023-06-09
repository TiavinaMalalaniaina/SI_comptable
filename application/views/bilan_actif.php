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
  <link href="<?php echo site_url('assets/css/lib/select2.min.css') ?>" rel="stylesheet">
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
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    SOCIETE: 
                </div>
                <div class="col-lg-10">
                  <?php echo $con['company']['name'] ?>
                </div>
                <div class="col-lg-2">
                    ADRESSE:
                </div>
                <div class="col-lg-10">
                    <?php echo $con['company']['address_social'] ?>
                </div>
                <div class="col-lg-2">
                    CAPITAL:
                </div>
                <div class="col-lg-10">
                    ...
                </div>
                <div class="col-lg-2">
                    CIF:
                </div>
                <div class="col-lg-10">
                    ...
                </div>
                <div class="col-lg-2">
                    STAT:
                </div>
                <div class="col-lg-10">
                  <?php echo $con['detail']['ns'] ?>
                </div>
            </div>
            
          </div>

        </div>

        </div>
      </div>
    </section>

    <section class="section" style="text-align: center;">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-title">
                        BILAN <a href="<?php bu('Etat_financier/actif_pdf')?>">pdf</a>
                    </div>
                    <div class="card-body">
                        EXERCICE CLOS AU: <?php echo $exo['fin']?>
                        <br>
                        Unité monétaire: Ariary
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="section" style="text-align: center;">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-title">
                        Date
                    </div>
                    <div class="card-body">
                        <form action="<?php bu('Etat_financier/index')?>" method="get">
                        <input type="date" name="date" id="">
                        <button type="submit">OK</button>  
                      </form>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

            <div class="table-journal">
              <table class="table table-bordered">  
              <thead>
                  <tr>
                    <th rowspan="3">Actif</th>
                    <th rowspan="3">COMPTE</th>
                    <th colspan="3">DATE FIN EXERCICE N</th>
                    <th colspan="3">DATE FIN EXERCICE N-1</th>
                  </tr>
                  <tr>
                    <th colspan="3">MONTANT</th>
                  </tr>
                  <tr>
                    <th>Brute</th>
                    <th>Ammortissement</th>
                    <th>Net</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>ACTIF NON COURANT</th>
                    </tr>
                    
                    <?php for ($i=0; $i < count($anc[0]); $i++) { 
                      ?>
                      <tr>
                        <td style="padding-left: 40px;text-transform:uppercase"><?php echo $anc[0][$i]['nom']?></td>
                        <td><?php echo $anc[0][$i]['con']?></td>
                        <td><?php echo $anc[0][$i]['brut']?></td>
                        <td><?php echo $anc[0][$i]['ap']?></td>
                        <td><?php echo $anc[0][$i]['net']?></td>
                        <td></td>
                      </tr>
                      <?php
                      for ($j=0; $j < count($anc[0][$i]['subs']); $j++) { 
                        ?>
                        <tr>
                        <td style="padding-left: 40px;text-transform:capitalize"><?php echo $anc[0][$i]['subs'][$j]['nom']?></td>
                        <td><?php echo $anc[0][$i]['subs'][$j]['con']?></td>
                        <td><?php echo $anc[0][$i]['subs'][$j]['brut']?></td>
                        <td><?php echo $anc[0][$i]['subs'][$j]['ap']?></td>
                        <td><?php echo $anc[0][$i]['subs'][$j]['net']?></td>
                        <td></td>
                        </tr>
                        <?php
                      }
                    }?>

                    <tr style="text-align: right;">
                        <th>TOTAL ACTIF NON COURANT</th>
                        <td colspan="4"> <?php echo $anc[1][2]?></td>
                    </tr>

                    <tr>
                        <th>ACTIF COURANT</th>
                        <td colspan="4"></td>
                    </tr>
                    <?php for ($i=0; $i < count($ac[0]); $i++) { 
                      ?>
                      <tr>
                        <td style="padding-left: 40px;text-transform:uppercase"><?php echo $ac[0][$i]['nom']?></td>
                        <td><?php echo $ac[0][$i]['con']?></td>
                        <td><?php echo $ac[0][$i]['brut']?></td>
                        <td><?php echo $ac[0][$i]['ap']?></td>
                        <td><?php echo $ac[0][$i]['net']?></td>
                        <td></td>
                      </tr>
                      <?php
                      for ($j=0; $j < count($ac[0][$i]['subs']); $j++) { 
                        ?>
                        <tr>
                        <td style="padding-left: 60px;text-transform:capitalize"><?php echo $ac[0][$i]['subs'][$j]['nom']?></td>
                        <td><?php echo $ac[0][$i]['subs'][$j]['con']?></td>
                        <td><?php echo $ac[0][$i]['subs'][$j]['brut']?></td>
                        <td><?php echo $ac[0][$i]['subs'][$j]['ap']?></td>
                        <td><?php echo $ac[0][$i]['subs'][$j]['net']?></td>
                        <td></td>
                        </tr>
                        <?php
                      }
                    }?>

                    <tr style="text-align: right;">
                        <th>TOTAL  NON COURANT</th>
                        <td colspan="4"> <?php echo $ac[1][2]?></td>
                    </tr>
                    <tr style="text-align: right;">
                        <th>TOTAL ACTIF</th>
                        <td colspan="4"> <?php 
                        $tot = $anc[1][2]+$ac[1][2];
                        echo $tot?></td>
                    </tr>
                </tbody>
              </table>
              </div>
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
  <script src="<?php echo bu('assets/js/main.js') ?>"></script>
  <script src="<?php echo bu('assets/js/lib/jquery.js') ?>"></script>
  <script src="<?php echo bu('assets/js/journal.js') ?>"></script>
  <script src="<?php echo bu('assets/js/lib/select2.min.js') ?>"></script>

</body>

</html>