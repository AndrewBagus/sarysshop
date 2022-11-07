<!DOCTYPE html>
<html>

<head>
  <!--this for render header-->
  <?php $this->load->view('main/page_header'); ?>
  <title>
    Shopping
    <!--this for render title-->
  </title>
</head>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns fixed-navbar menu-expanded pace-done">
  <!-- navbar-fixed-top-->
  <div id="loading" style="display:none">
    <img id="loading-image" src="<?= base_url(); ?>app_assets/img/default.gif" data-expand="<?= base_url(); ?>app_assets/img/default.gif" data-collapse="<?= base_url(); ?>app_assetss/img/default.gif" alt="Loading..." />
  </div>
  <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-border navbar-light navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav">
          <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
          <li class="nav-item">
            <a href="Dashboard" class="navbar-brand nav-link">
              <img style="padding:5px;height:65px" alt="branding logo" src="<?= base_url(); ?>app_assets/img/logo.png" data-expand="<?= base_url(); ?>app_assets/img/logo.png" data-collapse="<?= base_url(); ?>app_assets/img/logo-mini.png" class="brand-logo">
            </a>
          </li>
          <li class="nav-item hidden-md-up float-xs-right">
            <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container">
              <i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content container-fluid">
        <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
          <ul class="nav navbar-nav">
            <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>
          </ul>
          <!-- <div class="gls-header">
            <a href="#" class="hidden-xs" onclick="about()"><i class="icon-office"></i> <span id="lable-about">
                
              </span></a>
          </div> -->
          <ul class="nav navbar-nav float-xs-right">
            <li class="dropdown dropdown-user nav-item">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                <span class="avatar avatar-online">
                  <img src="<?= base_url(); ?>app_assets/img/admin.png" />
                  <i></i>
                </span>
                <span class="user-name" id="lbl-username">
                  <!--this for render username-->
                  <?php echo $this->session->userdata('name'); ?>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item"><i class="icon-pencil22"></i> Ubah Password</a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url(); ?>auth/logout" class="dropdown-item"><i class="icon-switch"></i> Logout</a>
              </div>
            </li>
            <!-- <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li> -->
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!--this for render menu-->
  <?php $this->load->view('main/page_menu'); ?>

  <div class="app-content content container-fluid">
    <div class="content-wrapper" style="padding-top:30px;" id="content_body">
      <!--this for render body-->
      <?php $this->load->view("scope/$url/index"); ?>
    </div>
  </div>
  <div id="modal_area" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="padding-left:0px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <span class="txt-lg" id="modal_title"></span><span id="notif_insert" class="pull-right"></span>
        </div>
        <div class="modal-body row">
          <form method="post" id="modal_form" enctype="multipart/form-data" class="form-horizontal" role="form"></form>
        </div>
      </div>
    </div>
  </div>

  <!-- <footer class="footer navbar-fixed-bottom footer-light navbar-border">
    <p class="clearfix text-sm-center mb-0 px-2">
      <span class="float-md-left d-xs-block d-md-inline-block">Copyright &copy; 2017 <a href="https://garudalearning.com" target="_blank" class="text-bold-600 white darken-2">GLS </a> Version 1.5.0.1 , All rights reserved. </span>
      <span class="float-md-right d-xs-block d-md-inline-block">Developed by <a class="text-bold-600 white darken-2" href="http://garudalearning.com/">RENJANA ABI YASA</a></span>
    </p>
  </footer> -->
  <!--this for render footer-->
  <?php $this->load->view('main/page_footer'); ?>
</body>

</html>