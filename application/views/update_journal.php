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
    .table-journal{
        width: parent;
        overflow-x: scroll;
    }
    .table-journal table {
    }

    #line-jour{
        width: 110px;
    }
    #jour{
        width: 110px;
    }
    #line-npiece{
        width: 50px;
        
    }
    #npiece {
        width: 80px;
    }
    #line-rpiece{
        width: 110px;
    }
    #line-rpiece span{
        width: 110px;
    }
    #rpiece {
        width: 50px;
    }
    #rpiecetype {
        width: 40px;
    }
    #line-compteg{
        width: 50px;
    }
    #compteg {
        width: 50px;
    }
    #line-comptet{
        width: 120px;
    }
    #comptet {
        width: 120px;
    }
    #line-libelle{
        width: 200px;
    }
    #libelle {
        width: 200px;
    }
    #line-echeance{
        width: 110px;
    }
    #echeance {
        width: 110px;
    }
    #line-devise {
        width: 50px;
    }
    #devise {
        width: 50px;
    }
    #line-parite {
        width: 80px;
    }
    #parite {
        width: 80px;
    }
    #line-quantite {
        width: 80px;
    }
    #quantite {
        width: 80px;
    }
    #line-montant {
        width: 200px;
    }
    #montant {
        width: 200px;
    }
    #line-debit {
        width: 200px;
    }
    #debit {
        width: 200px;
    }
    #line-credit {
        width: 200px;
    }
    #credit {
        width: 200px;
    }

    input ,select{
        background-color: transparent;
        border-left: 0px;
        border-right: 0px;
        border-top: 0px;
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
              <h5 class="card-title">Formulaire pour la société</h5>
                <div class="table-journal">
                    <form action="<?php bu('Journal/update_modified')?>" method="get" enctype="multipart/form-data">
                    
                    <table class="table table-bordered" style="font-size: 80%; width:1700px;">
                        <thead>

                            <tr>
                                <th scope="col" id="line-jour">Jour</th>
                                <th scope="col" id="line-npiece">N° pièce</th>
                                <th scope="col" id="line-rpiece">Référence pièce</th>
                                <th scope="col" id="line-compteg">N°compte général</th>
                                <th scope="col" id="line-comptet">N°compte tierce</th>
                                <th scope="col" id="line-libelle">Libellé écriture</th>
                                <th scope="col" id="line-echeance">Echéance</th>
                                <th scope="col" id="line-devise">Devise</th>
                                <!-- <th scope="col" id="line-parite">Parité</th> -->
                                <th scope="col" id="line-quantite">Quantité</th>
                                <th scope="col" id="line-montant">Montant devise</th>
                                <th scope="col" id="line-debit">Débit</th>
                                <th scope="col" id="line-credit">Crédit</th>
                            
                            </tr>
                        </thead>
                        <tbody id="table-add-journal">
                            <?php for ($i=0; $i < count($data); $i++) { 
                                # code...
                            ?>
                            <input type="hidden" name="id[]" value="<?php echo $data[$i]['id']?>">
                            <tr class="writing-journal">
                                <td id="line-jour"><input type="date" name="jour" id="jour" value="<?php echo $data[$i]['date_journal']?>"></td>
                                <td id="line-npiece"><input type="text" name="npiece" id="npiece" value="<?php echo $data[$i]['numero_piece']?>"></td>
                                <td id="line-rpiece"><input type="text" name="rpiece" id="rpiece" value="<?php echo $data[$i]['reference_piece']?>"></td>
                                <td id="line-compteg">
                                <span>
                                        <select name="compteg[]" id="compteg">
                                            <?php for ($j=0; $j < count($compte_gen); $j++) { 
                                                ?>
                                                <option value="<?php echo $compte_gen[$j]['code']?>" <?php 
                                                if($data[$i]['compte']== $compte_gen[$j]['code']){
                                                    ?>selected<?php
                                                }
                                                ?>><?php echo $compte_gen[$j]['code']?></option>
                                                <?php
                                            }?>
                                        </select>
                                    </span>
                                </td>
                                <td id="line-comptet">
                                <span>
                                        <select name="comptet[]" id="comptet">
                                            <?php for ($j=0; $j < count($compte_tiers); $j++) { 
                                                ?>
                                                <option value="<?php echo $compte_tiers[$j]['code']?>" <?php 
                                                if($data[$i]['compte_tierce']== $compte_tiers[$j]['code']){
                                                    ?>selected<?php
                                                }
                                                ?>><?php echo $compte_tiers[$j]['code']?></option>
                                                <?php
                                            }?>
                                        </select>
                                    </span>
                                </td>
                                <td id="line-libelle"><input type="text" name="libelle" id="libelle" value="<?php echo $data[$i]['libelle']?>"></td>
                                <td id="line-echeance"><input type="date" name="echeance" id="echeance" value="<?php echo $data[$i]['echeance']?>"></td>
                                <td id="line-devise">
                                    <select name="devise" id="devise">
                                    <?php for ($j=0; $j < count($devise); $j++) { 
                                                ?>
                                                <option value="<?php echo $devise[$j]['code']?>" <?php 
                                                if($data[$i]['devise']== $devise[$j]['code']){
                                                    ?>selected<?php
                                                }
                                                ?>><?php echo $devise[$j]['name']?></option>
                                                <?php
                                            }?>
                                    </select>
                                </td>
                                <!-- <td id="line-parite"><input type="text" name="parite" id="parite"></td> -->
                                <td id="line-quantite"><input type="text" name="quantite" id="quantite" value="<?php echo $data[$i]['quantite']?>"></td>
                                <td id="line-montant"><input type="text" name="montant" id="montant" ></td>
                                <td id="line-debit"><input type="text" name="debit[]" id="debit" class="debit" oninput="unabilityToValide()" value="<?php echo $data[$i]['debit']?>" ></td>
                                <td id="line-credit"><input type="text" name="credit[]" id="credit" class="credit" oninput="unabilityToValide()"  value="<?php echo $data[$i]['credit']?>"></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <div class="text-center">
                      <button type="button" class="btn btn-primary" onclick="addLine(co)">Auter une ligne</button>
                      <button type="submit" class="btn btn-primary" id="validate" hidden>Valider</button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                  <input type="hidden" name="cj" value="<?php echo $data[0]['code_journal']?>">
                  <input type="hidden" name="month" value="<?php echo $month?>">
                </form>
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
  <script src="<?php echo bu('assets/js/journal.js') ?>"></script>

</body>

</html>