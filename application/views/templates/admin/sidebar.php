<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin<sup> UNRL</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('admin');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Unconfirmed list</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/canceledOrder');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Canceled order list</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Manage Items
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link pb-0" href="<?=base_url('admin/newProduk');?>">
          <i class="fas fa-fw fa-fire"></i>
          <span>New Product</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link pb-0" href="<?=base_url('admin/manageproduct');?>">
          <i class="fas fa-fw fa-tshirt"></i>
          <span>Manage Product</span>
        </a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link pb-0" href="<?=base_url('admin/manageLookbook');?>">
          <i class="far fa-fw fa-eye"></i>
          <span>Manage Lookbook</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('admin/manageHeader');?>">
          <i class="fas fa-fw fa-h-square"></i>
          <span>Manage Header</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Transaction
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link pb-0" href="<?=base_url('admin/confirmbayar');?>">
          <i class="fas fa-fw fa-money-check-alt"></i>
          <span>Confirmed Payment</span>
        </a>
      </li> -->

      <li class="nav-item">
        <a class="nav-link pb-0" href="<?=base_url('admin/unprocessedOrder');?>">
          <i class="fas fa-fw fa-times"></i>
          <span>Unprocessed Order</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('admin/processedOrder');?>">
          <i class="fas fa-fw fa-check"></i>
          <span>Processed Order</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Contact
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link pb-0" href="<?=base_url('admin/userHelp');?>">
          <i class="fas fa-fw fa-comments"></i>
          <span>User Help</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('admin/adminNewsletter');?>">
          <i class="fas fa-fw fa-mail-bulk"></i>
          <span>Newsletter</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->