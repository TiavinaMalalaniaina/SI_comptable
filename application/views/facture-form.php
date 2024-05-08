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
    <form action="<?php bu("Facture/confirm_facture")?>" method="get" enctype="multipart/form-data">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Addressé à:</h5>
                                <p class="mb-2"><input type="text" name="nom" id="" placeholder="Nom du client" style="width: 350px;" required></p>
                                <p class="mb-1"><input type="text" name="adresse" id="" placeholder="Address du client" style="width: 350px;" required></p>
                                <p class="mb-1"><input type="text" name="tel" id="" placeholder="Telephone du client" style="width: 350px;" required></p>
                                <p class="mb-1"><input type="text" name="mail" id="" placeholder="Email du client" style="width: 350px;" required></p>
                                <p><input type="text" name="nomresp" id="" placeholder="Nom du responsable" style="width: 350px;" required></p>
                            </div>
                            <div class="text-muted">
                                <p class="mb-1"><input type="text" name="obj" id="" placeholder="Objet" style="width: 350px;" required></p>
                                <p class="mb-1"><input type="text" name="ref" id="" placeholder="Reference" style="width: 350px;"></p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                    <p><input type="date" name="dat" id="" value="<?php echo $date?>"></p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Order No:</h5>
                                    <p><input type="text" name="numero" id="" value="<?php echo $numero;?>" style="width: 140px"></p>
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
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody id="t_body">
                                    <tr id="t_r">
                                      <td>
                                      <input type="text" name="designation[]" id="" style="width: 350px;" >
                                      </td>
                                      <td scope="row">
                                        <select name="unite[]" id="">
                                            <?php 
                                            for ($i=0; $i <  count($uo); $i++) { 
                                                ?>
                                                <option value="<?php echo $uo[$i]['id']?>"><?php echo $uo[$i]['nom']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                      </td>
                                      <td scope="row"><input type="text" name="nombre[]" id="" style="width: 100px;" value="10" required></td>
                                      <td scope="row"><input type="text" name="pu[]" id="" style="width: 100px;" value="1000" required></td>
                                    </tr>
                                </tbody><!-- end tbody -->
                                    <tr>
                                        <th colspan="2"></th>
                                        <th style="text-align:right">TVA</th>
                                        <td>
                                            <p class="mb-1"> <input type="text" name="tva" id="" placeholder="" style="width: 100px;" value="20" required></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th style="text-align:right">Avance</th>
                                        <td>
                                            <p class="mb-1"> <input type="text" name="avance" id="" placeholder="Avance" style="width: 100px;" value="0" required></p>
                                        </td>
                                    </tr>
                                    <!-- end tr -->
                                    
                                    <!-- end tr -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <button type="button" class="btn btn-secondary w-md" onclick="add()">Add line</button>
                                <button class="btn btn-primary w-md" type="submit">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    </form>
</div>
 
</main>

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

  <script>
    function add(){
    t_r = document.getElementById('t_r')
    t_body = document.getElementById('t_body')
    t_body.appendChild(t_r.cloneNode(true))
    }
</script>

</body>

</html>