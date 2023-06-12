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
 
<link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.css">
<style>
  body{
    margin-top:20px;
    background-color:#eee;
  }

  .card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
  }
  .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
  }
</style>
<main class="main" id="main">

<div class="container">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Addressé à:</h5>
                                <h5 class="font-size-15 mb-2"><?php echo $client['nom']?></h5>
                                <p class="mb-1"><?php echo $client['adresse']?></p>
                                <p class="mb-1"><?php echo $client['telephone']?></p>
                                <p class="mb-1"><?php echo $client['email']?></p>
                                <p><?php echo $client['nom_responsable']?></p>
                            </div>
                            <div class="text-muted">
                                <p class="mb-1"><?php echo $facture['objet']?></p>
                                <p class="mb-1"><?php echo $facture['reference']?></p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                    <p><?php echo $facture['date_facture']?></p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Order No:</h5>
                                    <p><?php echo $facture['numero']?></p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Unité</th>
                                        <th>Nombre</th>
                                        <th>PU</th>
                                        <th class="text-end" style="width: 120px;">Montant</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <?php 
                                    for ($i=0; $i < count($liste); $i++) { 
                                        ?>
                                             <tr>
                                      <td>
                                          <div>
                                              <h5 class="text-truncate font-size-14 mb-1"><?php echo $liste[$i]['designation']?></h5>
                                          </div>
                                      </td>
                                        <th scope="row"><?php echo $liste[$i]['nom']?></th>
                                        <td><?php echo $liste[$i]['nombre']?></td>
                                        <td><?php echo format_to_money($liste[$i]['prix_unitaire']) ?></td>
                                        <td class="text-end"><?php echo format_to_money($liste[$i]['montant']) ?></td>
                                    </tr>
                                        <?php
                                    }
                                    ?>
                                   
                                   
                                    <tr>
                                        <th scope="row" colspan="3" class="text-end">Montant Hors Taxes</th>
                                        <td class="text-end"><?php echo format_to_money($facture['montant_ht']) ?></td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end">TVA 20% </th>
                                        <td class="border-0 text-end"><?php echo format_to_money($facture['montant_ht']*$facture['montant_tva']/100) ?></td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end"> TTC</th>
                                        <td class="border-0 text-end"><?php echo format_to_money($facture['monntant_ttc'])?></td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                      <th scope="row" colspan="3" class="border-0 text-end">Avance</th>
                                      <td class="border-0 text-end"><?php echo format_to_money($facture['montant_avance'])?></td>
                                  </tr>
                                  
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="3" class="border-0 text-end">Net a payer</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold"><?php echo format_to_money($facture['net_payer'])?></h4></td>
                                    </tr>
                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <p>Facture arrete a la somme de <?php echo (new NumberFormatter("fr",NumberFormatter::SPELLOUT))->format($facture['monntant_ttc']);
?> Ariary</p>
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="#" class="btn btn-danger w-md">Supprimer</a>
                                <a href="<?php bu('Facture/export_facture?id='.$facture['id_facture'])?>" class="btn btn-success w-md">Exporter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

    </div>
</div>
</main>

  <a href="" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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