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
    <form action="<?php bu('Analytique/index')?>" method="get">
      <div class="row">
        <div class="col-lg-5">
        <div class="row mb-3">
          <div class="col-sm-6">
            <select class="form-select" aria-label="Default select example" name="produit">
              <?php
                for ($i=0; $i < count($produits) ; $i++) { 
                  ?>
                    <option value="<?php echo $produits[$i]['id']?>"><?php echo $produits[$i]['nom']?></option>
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
          <h5 class="card-title">Résultat analytique <?php echo $prod['nom']?> du <?php echo $daty?></h5>
          <table class="table table-bordered" style="font-size: 90%; width: <?php echo 800*4 ?>px">
            <thead>
              <tr>
                <th scope="col" rowspan="2">Rubriques</th>
                <th scope="col" rowspan="2">TOTAL</th>
                <th scope="col" rowspan="2">Unité d'oeuvre</th>
                <th scope="col" rowspan="2">Nature</th>
                <?php 
                for ($i=0; $i < count($centres) ; $i++) { 
                  ?>
                    <th scope="col" colspan="3"><?php echo $centres[$i]['nom'] ?></th>
                  <?php
                }
                ?>
                <th scope="col" colspan="2">TOTAL</th>
              </tr>
              <tr>
              <?php 
                for ($i=0; $i < count($centres) ; $i++) { 
                  ?>
                <td>%</td>
                <td>Fixe</td>
                <td>Variable</td>
                                  <?php
                }
                ?>
                <td>Fixe</td>
                <td>Variable</td>
              </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i < count($charges); $i++) { 
                   ?>
              <tr>
                <td><?php echo $charges[$i]['nom']?></td>
                <td><?php echo $charges[$i]['somme'] ?></td>
                <td><?php echo $charges[$i]['unite_oeuvre']?></td>
                <td><?php echo $charges[$i]['nature'] ?></td>
                <?php 
                for ($j=0; $j < count($centres); $j++) { 
                   ?>
                    <td><?php echo $centres[$j]['charges'][$i]['p']?>%</td>
                    <td><?php echo $centres[$j]['charges'][$i]['fixe']?></td>
                    <td><?php echo $centres[$j]['charges'][$i]['variable']?></td>
                   <?php
                }
                ?>
                
                <th><?php echo $total['charges'][$i]['fixe']?></th>
                <th><?php echo $total['charges'][$i]['variable']?></th>
              </tr>
                   <?php
                }?>
    <!-- TOTAL -->
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php 
                for ($i=0; $i < count($centres); $i++) { 
                    ?>
                    <td></td>
                    <th class="number"><?php echo $centres[$i]['fixe']?></th>
                    <th class="number"><?php echo $centres[$i]['variable']?></th>
                    <?php
                }
                ?>
                <th class="number"><?php echo $total['fixe'] ?></th>
                <th class="number"><?php echo $total['variable'] ?></th>
              </tr>

              <tr>
                <th>TOTAL</th>
                <th class="number"><?php echo $total['somme'] ?></th>
                <th></th>
                <th></th>
                <?php 
                for ($i=0; $i < count($centres); $i++) { 
                    ?>
                        <th class="number" colspan="3"><?php echo ($centres[$i]['fixe']+$centres[$i]['variable']) ?></th>
                    <?php
                }
                ?>
                <th class="number" colspan="2"><?php echo ($total['fixe']+$total['variable']) ?></th>
              </tr>
            </tbody>
          </table>
        </div>
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
              <h5 class="card-title">Cout du KG mais grain</h5>

              <!-- General Form Elements -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>REPARTITION ADM/DISTR</th>
                      <th>Cout direct</th>
                      <th>CLES</th>
                      <th>ADM/DIST</th>
                      <th>Cout total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $pl = $centres[2]['fixe']+$centres[2]['variable'];
                    $us = $centres[1]['fixe']+$centres[1]['variable'];
                    $tot = $pl+$us;
                    if($tot==0){
                      $tot = 1;
                    }
                    $ppl = $pl/$tot;
                    $pus = $us/$tot;
                    $adm = $centres[0]['fixe']+$centres[0]['variable'];
                    $admppl = ($adm * $ppl)/100;
                    $admpus = ($adm * $pus)/100;
                    $ctpl = $admppl + $ppl;
                    $ctus = $admpus + $pus;
                    $lt = $ctpl + $ctus;
                    ?>
                    <tr>
                      <td>TOTAL PLANTATION</td>
                      <td class="number"><?php echo format_to_money($pl) ?></td>
                      <td><?php echo $ppl?>%</td>
                      <td class="number"><?php echo format_to_money($admppl) ?></td>
                      <th class="number"><?php echo format_to_money($ctpl) ?></th>
                    </tr>
                    <tr>
                      <td>TOTAL USINE</td>
                      <td class="number"><?php echo format_to_money($us) ?></td>
                      <td><?php echo $pus?>%</td>
                      <td class="number"><?php echo format_to_money($admpus) ?></td>
                      <th class="number"><?php echo format_to_money($ctus) ?></th>
                    </tr>
                    <tr>
                      <td colspan="5"></td>
                    </tr>
                    <tr>
                      <th>TOTAL GENERAL</th>
                      <td class="number"><?php echo format_to_money($tot) ?></td>
                      <th></th>
                      <td class="number"><?php echo format_to_money($adm) ?></td>
                      <th class="number"><?php echo format_to_money($lt) ?></th>
                    </tr>
                  </tbody>
                </table>

            </div>
          </div>

        </div>

        
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cout du KG mais grain</h5>

              <!-- General Form Elements -->
                <table class="table table-bordered">
                  <thead></thead>
                    <tr>
                      <th>Unite d'oeuvre</th>
                      <td>Kg de grain de mais entrant</td>
                    </tr>
                    <tr>
                      <th>
                        Nombre
                      </th>
                      <td>
                        461000
                      </td>
                    </tr>
                    <tr>
                      <th>
                        Cout
                      </th>
                      <td>
                        298320
                      </td>
                    </tr>
                    <tr><td colspan="2"></td></tr>
                    <tr>
                      <th>Cout du kg de mais grain</th>
                      <th>210</th>
                    </tr>
                </table>

            </div>
          </div>

        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cout du KG de mais concasse</h5>

              <!-- General Form Elements -->
                <table class="table table-bordered">
                    <tr>
                      <th>Unite d'oeuvre</th>
                      <td>Kg du mais concasse</td>
                    </tr>
                    <tr>
                      <th>
                        Nombre
                      </th>
                      <td>
                        461000
                      </td>
                    </tr>
                    <tr>
                      <th>
                        Cout
                      </th>
                      <td>
                        298320
                      </td>
                    </tr>
                    <tr><td colspan="2"></td></tr>
                    <tr>
                      <th>Cout du kg de mais grain</th>
                      <th>210</th>
                    </tr>
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