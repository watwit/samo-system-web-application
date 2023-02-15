<?php
$uri = $_SERVER['REQUEST_URI'];
$array = explode('/', $uri);
$key = array_search("se", $array);
$name = $array[$key + 1];
?>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark  fixed-top " >
    <!-- <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #FFB6B9;"> -->
    <a class="navbar-brand" href="<?php echo site_url('activity')?>"><img src="<?php echo base_url('img');?>/samo.png" width="40px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item  <?php echo $name == 'activity' ? 'active' : '' ?> <?php echo $name == 'schedule' ? 'active' : '' ?>">
          <a class="nav-link" href="<?php echo site_url('activity')?>">กิจกรรม</a>
        </li>
        <li class="nav-item <?php echo $name == 'palace' ? 'active' : '' ?>">
          <a class="nav-link" href="<?php echo site_url('palace')?>">ทำเนียบ</a>
        </li>
        <li class="nav-item <?php echo $name == 'award' ? 'active' : '' ?>">
          <a class="nav-link" href="<?php echo site_url('award')?>">ของรางวัล</a>
        </li>
        <li class="nav-item <?php echo $name == 'namenew' ? 'active' : '' ?>">
          <a class="nav-link" href="<?php echo site_url('namenew')?>">เช็คชื่อ</a>
        </li>
        <li class="nav-item <?php echo $name == 'listall' ? 'active' : '' ?>">
          <a class="nav-link" href="<?php echo site_url('listall')?>">รายชื่อ</a>
        </li>
        <?php if ($_SESSION['permisstion'] == 'superadmin') { ?>
          <li class="nav-item <?php echo $name == 'admin' ? 'active' : '' ?>">
          <a class="nav-link" href="<?php echo site_url('admin')?>">จัดการเเอดมิน</a>
        </li>
        <?php } ?>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="<?php echo site_url('login/logout')?>">
        <a class="nav-link d-block  text-light" href="#" >
          ยินดีตอนรับคุณ  <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?>
        </a>
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="submit">ออกจากระบบ</button>
      </form>
    </div>
  </nav>