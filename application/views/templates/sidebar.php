 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Journal</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <?php
      for ($i=0; $i < count($lst); $i++) { 
        ?>
        <li>
        <a href="<?php echo site_url('journal?cj='.$lst[$i]['code']) ?>">
          <i class="bi bi-circle"></i><span>Journal <?php echo $lst[$i]['intitule']?></span>
        </a>
      </li>
        <?php
      }
      ?>
      <li>
        <a href="<?php echo site_url('code_journaux') ?>">
          <i class="bi bi-circle"></i><span>Code journal</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Plan comptable</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php echo site_url('Compte_general') ?>">
          <i class="bi bi-circle"></i><span>Compte général</span>
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Compte_tiers') ?>">
          <i class="bi bi-circle"></i><span>Compte tiers</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo site_url('grand_livre') ?>">
      <i class="bi bi-grid"></i>
      <span>Grand livre</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo site_url('charge_supp') ?>">
      <i class="bi bi-grid"></i>
      <span>Suppletive</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php bu('balance') ?>">
      <i class="bi bi-grid"></i>
      <span>Balance</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo site_url('Company') ?>">
      <i class="bi bi-grid"></i>
      <span>About</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php bu('csv') ?>">
      <i class="bi bi-grid"></i>
      <span>CSV</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php bu('convertion') ?>">
      <i class="bi bi-grid"></i>
      <span>Convertion de devise</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Etats financiers</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php bu('Etat_financier') ?>">
          <i class="bi bi-circle"></i><span>Actif</span>
        </a>
      </li>
      <li>
        <a href="<?php bu('Etat_financier/passif') ?>">
          <i class="bi bi-circle"></i><span>Passif</span>
        </a>
      </li>
      <li>
        <a href="<?php bu('Etat_financier/resultat') ?>">
          <i class="bi bi-circle"></i><span>Resultat</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Production</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php bu('Produit/index') ?>">
          <i class="bi bi-circle"></i><span>Nouveau produit</span>
        </a>
      </li>
      <li>
        <a href="<?php bu('Produit/equilibre') ?>">
          <i class="bi bi-circle"></i><span>Equilibrage pourcentage</span>
        </a>
      </li>
      <li>
        <a href="<?php bu('Produit/production') ?>">
          <i class="bi bi-circle"></i><span>Ajout production</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Centre</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav4" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php bu('Centre/index') ?>">
          <i class="bi bi-circle"></i><span>Nouveau centre</span>
        </a>
      </li>
      <li>
        <a href="<?php bu('Centre/equilibre') ?>">
          <i class="bi bi-circle"></i><span>Equilibrage pourcentage</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Analytiques</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav5" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php bu('Analytique/index') ?>">
          <i class="bi bi-circle"></i><span>Par produit</span>
        </a>
      </li>
      <li>
        <a href="<?php bu('Analytique/index2') ?>">
          <i class="bi bi-circle"></i><span>Par centre</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav6" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Facture</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav6" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?php bu('Facture/input_facture') ?>">
          <i class="bi bi-circle"></i><span>Nouveau facture</span>
        </a>
      </li>
      <li>
        <a href="<?php bu('Facture/see_facture') ?>">
          <i class="bi bi-circle"></i><span>Recherche facture</span>
        </a>
      </li>
    </ul>
  </li>
</ul>

</aside><!-- End Sidebar-->