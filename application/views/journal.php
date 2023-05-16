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
        width: 100px;
    }
    #compteg {
        width: 150px;
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
        width: 100px;
    }
    #devise {
        width: 100px;
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

    input ,select, .select2{
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
              <h5 class="card-title">Entree journal <?php echo $journal['intitule']?></h5>
                <div class="table-journal">
                    <form action="<?php bu('Journal/insertor')?>" method="get" enctype="multipart/form-data">
                    <input type="hidden" name="cj" value="<?php echo $journal['code']?>">
                    <input type="hidden" name="month" value="<?php echo $month?>">
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
                                <th scope="col" id="line-quantite">Unité d'oeuvre</th>
                                <th scope="col" id="line-quantite">PU</th>
                                <th scope="col" id="line-quantite">Quantité</th>
                                <th scope="col" id="line-montant">Montant devise</th>
                                <th scope="col" id="line-debit">Débit</th>
                                <th scope="col" id="line-credit">Crédit</th>
                            
                            </tr>
                        </thead>
                        <tbody id="table-add-journal">

                            <tr class="writing-journal">
                                <td id="line-jour"><input type="date" name="jour" id="jour" required></td>
                                <td id="line-npiece"><input type="text" name="npiece" id="npiece" required></td>
                                <td id="line-rpiece">
                                    <span>
                                        <select name="rpiecetype" id="rpiecetype">
                                            <?php for ($i=0; $i < count($refs); $i++) { 
                                                ?>
                                                <option value="<?php echo $refs[$i]['ref']?>"><?php echo $refs[$i]['ref']?></option>
                                                <?php
                                            }?>
                                        </select>
                                        <input type="text" name="rpiece" id="rpiece" required>                    
                                    </span>
                                </td>
                                <td id="line-compteg">
                                <span>
                                        <select name="compteg[]" id="compteg" class="js-example-basic-single select2">
                                            <?php for ($i=0; $i < count($compte_gen); $i++) { 
                                                ?>
                                                <option value="<?php echo $compte_gen[$i]['code']?>"><?php echo $compte_gen[$i]['code']?> <?php echo $compte_gen[$i]['intitule']?></option>
                                                <?php
                                            }?>
                                        </select>
                                    </span>
                                </td>
                                <td id="line-comptet">
                                <span>
                                        <select name="comptet[]" id="comptet" class="js-example-basic-single">
                                            <option value="" selected></option>
                                            <?php for ($i=0; $i < count($compte_tiers); $i++) { 
                                                ?>
                                                <option value="<?php echo $compte_tiers[$i]['code']?>"><?php echo $compte_tiers[$i]['code']?></option>
                                                <?php
                                            }?>
                                        </select>
                                    </span>
                                </td>
                                <td id="line-libelle"><input type="text" name="libelle" id="libelle"></td>
                                <td id="line-echeance"><input type="date" name="echeance" id="echeance"></td>
                                <td id="line-devise">
                                    <select name="devise" id="devise" class="js-example-basic-single">
                                    <?php for ($i=0; $i < count($devise); $i++) { 
                                                ?>
                                                <option value="<?php echo $devise[$i]['code']?>"><?php echo $devise[$i]['name']?></option>
                                                <?php
                                            }?>
                                    </select>
                                </td>
                                <!-- <td id="line-parite"><input type="text" name="parite" id="parite"></td> -->
                                <td id="line-quantite"><select name="unite[]" id="unite">
                                    <?php for ($w=0; $w < count($uo); $w++) { 
                                        ?>
                                        <option value="<?php echo $uo[$w]['id']?>"><?php echo $uo[$w]['nom']?></option>
                                        <?php
                                    }?>
                                </select></td>
                                <td id="line-quantite"><input type="text" name="pu[]" id="PU"></td>
                                <td id="line-quantite"><input type="text" name="quantite[]" id="quantite"></td>
                                <td id="line-montant"><input type="text" name="montant[]" id="montant"></td>
                                <td id="line-debit"><input type="text" name="debit[]" id="debit" class="debit" oninput="unabilityToValide()" ></td>
                                <td id="line-credit"><input type="text" name="credit[]" id="credit" class="credit" oninput="unabilityToValide()"></td>
                            </tr>
                        </tbody>
                    </table>
                <div class="text-center">
                      <button type="button" class="btn btn-primary" onclick="addLine(co)">Ajouter une ligne</button>
                      <button type="submit" class="btn btn-primary" id="validate" disabled>Valider</button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form>
            </div>
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
              <h5 class="card-title">Liste journal <?php echo $journal['intitule']?> du mois <?php echo $months[$month-1]?></h5>
              <form class="row g-3" action="<?php bu('Journal/')?>" method="get">
              <input type="hidden" name="cj" value="<?php echo $journal['code']?>">
                <label for="address_exploitation" class="form-label">Mois</label>
                <div class="col-md-2">
                    <select class="form-select" aria-label="Default select example" aria-placeholder="type" name="month">
                        <?php for ($i=0; $i < count($months); $i++) { 
                            ?><option value="<?php echo ($i+1)?>"><?php echo $months[$i]?></option><?php
                        }?>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
            <div class="table-journal">
              <table class="table datatable" style="font-size: 90%;">  
              <thead>
                  <tr>
                    <th scope="col">Jour</th>
                    <th scope="col">N° pièce</th>
                    <th scope="col">Référence pièce</th>
                    <th scope="col">N°compte général</th>
                    <th scope="col">N°compte tierce</th>
                    <th scope="col">Libellé écriture</th>
                    <th scope="col">Echéance</th>
                    <th scope="col">Devise</th>
                    <th scope="col">Parité</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Montant devise</th>
                    <th scope="col">Débit</th>
                    <th scope="col">Crédit</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i < count($liste); $i++) { 
                        # code...?>
                  <tr>
                    <th scope="row"><?php echo $liste[$i]['date_journal']?></th>
                    <td><?php echo $liste[$i]['numero_piece']?></td>
                    <td><?php echo $liste[$i]['reference_piece']?></td>
                    <td><?php echo $liste[$i]['compte']?></td>
                    <td><?php echo $liste[$i]['compte_tierce']?></td>
                    <td><?php echo $liste[$i]['libelle']?></td>
                    <td><?php echo $liste[$i]['echeance']?></td>
                    <td><?php echo $liste[$i]['devise']?></td>
                    <td><?php echo $liste[$i]['parite']?></td>
                    <td><?php echo $liste[$i]['quantite']?></td>
                    <td><?php echo $liste[$i]['devise']?></td>
                    <td><?php echo format_to_money($liste[$i]['debit']) ?></td>
                    <td><?php echo format_to_money($liste[$i]['credit'])?></td>
                    <td>
                        <!-- Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                            <a href="<?php bu('Journal/modifior?npiece='.$liste[$i]['numero_piece'].'&cj='.$journal['code'].'&month='.$month)?>"><i class="bi bi-pencil"></i></a>
                        </button>

                       
                        <!-- End modal -->

                    </td>
                  </tr>
                  <?php }?>
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