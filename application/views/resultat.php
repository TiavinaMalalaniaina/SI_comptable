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
                        BILAN
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
                        <form action="<?php bu('Etat_financier/resultat')?>" method="get">
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
                    <th rowspan="2"></th>
                    <th rowspan="2">Compte</th>
                    <th>DATE FIN EXERCICE N</th>
                    <th>DATE FIN EXERCICE N-1</th>
                  </tr>
                  <tr>
                    <th>MONTANT</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                <?php
                for ($i=0; $i < count($lst[0][0]); $i++) { 
                    ?>
                    <tr>
                        <td><?php echo $lst[0][0][$i]['nom']?></td>
                        <td><?php echo $lst[0][0][$i]['con']?></td>
                        <td><?php echo $lst[0][0][$i]['somme']?></td>
                    </tr>
                    <?php
                }
                ?>

                    <tr>
                        <th>I.PRODUCTION DE L'EXERCICE</th>
                        <td colspan="5"><?php echo $lst[0][1]?></td>
                    </tr>
                    <?php
                for ($i=0; $i < count($lst[1][0]); $i++) { 
                    ?>
                    <tr>
                        <td style="padding-left: 40px;"><?php echo $lst[1][0][$i]['nom']?></td>
                        <td><?php echo $lst[1][0][$i]['con']?></td>
                        <td><?php echo $lst[1][0][$i]['somme']?></td>
                    </tr>
                    <?php
                }
                ?>
                    <tr>
                        <th>II.CONSOMMATION DE L'EXERCICE</th>
                        <td colspan="4"><?php echo $lst[1][1]?></td>
                    </tr>

                    <tr>
                        <th>III.VALEUR AJOUTEE D'EXPLOITATION(I-II)</th>
                        <td colspan="4"><?php echo $lst[0][1]-$lst[1][1]?></td>
                    </tr>
                    <?php
                for ($i=0; $i < count($lst[2][0]); $i++) { 
                    ?>
                    <tr>
                        <td style="padding-left: 40px;"><?php echo $lst[2][0][$i]['nom']?></td>
                        <td><?php echo $lst[2][0][$i]['con']?></td>
                        <td><?php echo $lst[2][0][$i]['somme']?></td>
                    </tr>
                    <?php
                }
                ?>

                    <tr>
                        <th>IV.EXCEDENT BRUT D'EXPLOITATION</th>
                        <td colspan="4"><?php echo $lst[2][1]?></td>
                    </tr>
                    <?php
                for ($i=0; $i < count($lst[3][0]); $i++) { 
                    ?>
                    <tr>
                        <td style="padding-left: 40px;"><?php echo $lst[3][0][$i]['nom']?></td>
                        <td><?php echo $lst[3][0][$i]['con']?></td>
                        <td><?php echo $lst[3][0][$i]['somme']?></td>
                    </tr>
                    <?php
                }
                ?>

                    <tr>
                        <th>V.RESULTAT OPERATIONNEL</th>
                        <td colspan="4"><?php echo $lst[3][1]?></td>
                    </tr>
                    <?php
                for ($i=0; $i < count($lst[4][0]); $i++) { 
                    ?>
                    <tr>
                        <td style="padding-left: 40px;"><?php echo $lst[4][0][$i]['nom']?></td>
                        <td><?php echo $lst[4][0][$i]['con']?></td>
                        <td><?php echo $lst[4][0][$i]['somme']?></td>
                    </tr>
                    <?php
                }
                ?>

                    <tr>
                        <th>VI.RESULTAT FINANCIERS</th>
                        <td colspan="4"><?php echo $lst[4][1]?></td>
                    </tr>

                    <tr>
                        <th>VII.RESULTAT AVANT IMPOTS (V+VI)</th>
                        <td colspan="4"><?php echo $lst[3][1]+$lst[4][1]?></td>
                    </tr>
                    <?php
                for ($i=0; $i < count($lst[5][0]); $i++) { 
                    ?>
                    <tr>
                        <td style="padding-left: 40px;"><?php echo $lst[5][0][$i]['nom']?></td>
                        <td><?php echo $lst[5][0][$i]['con']?></td>
                        <td><?php echo $lst[5][0][$i]['somme']?></td>
                    </tr>
                    <?php
                }
                ?>
                    
                    <tr>
                        <th style="padding-left: 40px;">TOTAL DES PRODUITS DES ACTIVITES ORDINAIRES</th>
                        <td><?php echo $totpo?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 40px;">TOTAL DES CHARGES DES ACTIVITES ORDINAIRES</td>
                        <td><?php echo $totco?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th>VIII.RESULTAT NET DES ACTIVITES ORDINAIRES</th>
                        <td colspan="4"><?php echo $lst[5][1]?></td>
                    </tr>
                    <?php
                for ($i=0; $i < count($lst[6][0]); $i++) { 
                    ?>
                    <tr>
                        <td style="padding-left: 40px;"><?php echo $lst[6][0][$i]['nom']?></td>
                        <td><?php echo $lst[6][0][$i]['con']?></td>
                        <td><?php echo $lst[6][0][$i]['somme']?></td>
                    </tr>
                    <?php
                }
                ?>
                    <tr>
                        <th>IX.RESULTAT EXTRAORDINAIRES</th>
                        <td></td>
                        <td><?php echo $lst[6][1]?></td>
                    </tr>
                    <tr>
                        <th>X.RESULTAT NET DE L'EXERCICE</th>
                        <td></td>
                        <td><?php echo $lst[6][1] + ($totpo-$totco)?></td>
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