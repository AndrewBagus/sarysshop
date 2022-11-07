<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Garuda Learning System">
  <meta name="keywords" content="Garuda, Learning, System, Education, GLS ">
  <meta name="author" content="Garuda Learning System">
  <title>Home | Penjualan</title>
  <link rel="apple-touch-icon" sizes="60x60" href="app_assets/robust/app-assets/images/ico/apple-icon-60.png">
  <link rel="apple-touch-icon" sizes="76x76" href="app_assets/robust/app-assets/images/ico/apple-icon-76.png">
  <link rel="apple-touch-icon" sizes="120x120" href="app_assets/robust/app-assets/images/ico/apple-icon-120.png">
  <link rel="apple-touch-icon" sizes="152x152" href="app_assets/robust/app-assets/images/ico/apple-icon-152.png">
  <link rel="shortcut icon" type="image/png" href="app_assets/img/logo-mini.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="app_assets/robust/app-assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="app_assets/robust/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css">
  <link rel="stylesheet" type="text/css" href="app_assets/robust/app-assets/vendors/css/file-uploaders/jquery.fileupload.css">
  <link rel="stylesheet" type="text/css" href="app_assets/robust/app-assets/vendors/css/file-uploaders/jquery.fileupload-ui.css">
  <!-- font icons-->
  <link rel="stylesheet" type="text/css" href="app_assets/robust/app-assets/fonts/icomoon.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN ROBUST CSS-->
  <link rel="stylesheet" type="text/css" href="app_assets/robust/app-assets/css/bootstrap-extended.css">
  <!-- END ROBUST CSS-->
  <link rel="stylesheet" type="text/css" href="app_assets/robust/app-assets/vendors/css/extensions/sweetalert.css">

  <!-- BEGIN Custom CSS-->
  <link href="app_assets/css/custom.css" rel="stylesheet" />
  <link href="app_assets/css/colors.css" rel="stylesheet" />
  <link href="app_assets/css/app.css" rel="stylesheet" />
  <!-- END Custom CSS-->
</head>

<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column blank-page blank-page">
  <div id="loading" style="display:none">
    <img id="loading-image" src="app_assets/img/default.gif" data-expand="app_assets/img/default.gif" data-collapse="app_assets/img/default.gif" alt="Loading..." />
  </div>
  <!-- Start Page Loading -->
  <!-- <div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div> -->
  <!-- End Page Loading -->
  <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
              <div class="card-header no-border">
                <div class="card-title text-xs-center">
                  <div class="p-1">
                    <img src="app_assets/img/logo.png" style="width:300px" />
                  </div>
                </div>
                <h6 class="gls-separator"></h6>
              </div>
              <div class="card-body collapse in">
                <div class="card-block">
                  <?= $this->session->flashdata('message'); ?>
                  <form class="form-horizontal form-simple" method="post" action="<?= base_url('auth'); ?>">
                    <fieldset>
                      <h5>Email</h5>
                      <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="icon-head"></i></span>
                        <input id="email" name="email" class="form-control" type="text" value="<?= set_value('email'); ?>" placeholder="Masukkan email" />
                      </div>
                      <?= form_error('email', '<span class="text-danger"></span>'); ?>
                    </fieldset>
                    <br />
                    <fieldset>
                      <h5>Password</h5>
                      <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="icon-key3"></i></span>
                        <input id="password" name="password" class="form-control" type="password" placeholder="Masukkan password" />
                        <span class="input-group-addon btn btn-blue" onmousedown="show_password()" onmouseup="hide_password()"><i class="icon-eye3"></i></span>
                      </div>
                      <?= form_error('password', '<small class="text-danger pl-3"></small>'); ?>
                    </fieldset>

                    <br />
                    <button type="submit" class="btn btn-blue btn-lg btn-block"><i class="icon-unlock2"></i> Login</button>
                  </form>
                </div>
              </div>
              <div class="card-footer">
                <div style="text-align:center">

                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- BEGIN VENDOR JS-->
  <script src="app_assets/robust/app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/js/scripts/forms/switch.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/js/scripts/forms/checkbox-radio.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/ui/jquery-sliding-menu.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/sliders/slick/slick.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/js/scripts/numeric/jquery.numeric.js"></script>
  <script src="app_assets/robust/app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>

  <script src="app_assets/robust/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="app_assets/robust/app-assets/vendors/js/pickers/daterange/daterangepicker.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <script src="app_assets/js/app-menu.js"></script>
  <script src="app_assets/js/custom.js"></script>
  <script src="app_assets/js/app.js"></script>
  <script>
    function show_password() {
      $("#password").attr("type", "text");
    }

    function hide_password() {
      $("#password").attr("type", "password");
    }
  </script>

</body>

</html>