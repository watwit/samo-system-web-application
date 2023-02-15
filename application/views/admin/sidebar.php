<?php
$uri = $_SERVER['REQUEST_URI'];
$array = explode('/', $uri);
$key = array_search("se", $array);
$name = $array[$key + 1];
?>
<nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-dark fixed-top">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <!-- <a href="#" class="brand-link">
      <span class="brand-text font-weight-light text-center d-block">admin management</span>
    </a> -->

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img class="img-circle elevation-2" src="<?php echo base_url('img'); ?>/samo.png" width="40px">
        <!-- <img src="" class="img-circle elevation-2" alt="User Image"> -->
      </div>
      <div class="info">
        <a href="<?php echo site_url('activity') ?>" class="">Admin Management</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?php echo site_url('activity') ?>" class="nav-link <?php echo $name == 'activity' ? 'active' : '' ?> <?php echo $name == 'schedule' ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            <p>กิจกรรม</p>
          </a>
        </li>
        <?php if ($_SESSION['permisstion'] == 'superadmin') { ?>
          <li class="nav-item">
            <a href="<?php echo site_url('admin') ?>" class="nav-link <?php echo $name == 'admin' ? 'active' : '' ?>">
              <i class="fas fa-users-cog nav-icon"></i>
              <p>จัดการแอดมิน</p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a href="<?php echo site_url('listall') ?>" class=" nav-link <?php echo $name == 'listall' ? 'active' : '' ?>">
            <i class="fas fa-list nav-icon"></i>
            <p>รายชื่อ</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('namenew') ?>" class="nav-link <?php echo $name == 'namenew' ? 'active' : '' ?>">
            <i class="fas fa-chalkboard-teacher nav-icon"></i>
            <p>เช็คชื่อ</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('palace') ?>" class="nav-link <?php echo $name == 'palace' ? 'active' : '' ?>">
            <i class="fas fa-project-diagram nav-icon"></i>
            <p>ทำเนียบ</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('award') ?>" class="nav-link <?php echo $name == 'award' ? 'active' : '' ?><?php echo $name == 'checkaward' ? 'active' : '' ?>">
            <i class="fas fa-award nav-icon"></i>
            <p>ของรางวัล</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('shop') ?>" class="nav-link <?php echo $name == 'shop' ? 'active' : '' ?>">
            <i class="fas fa-store nav-icon"></i>
            <p>ร้านค้า</p>
          </a>
        </li>
        <li class="nav-header">การตั้งค่าบัญชี</li>
        <li class="nav-item">
          <a href="<?php echo site_url('login/logout') ?>" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <p>ออกจากระบบ</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>