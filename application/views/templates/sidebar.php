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
</ul>

</aside><!-- End Sidebar-->