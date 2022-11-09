<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
  <title>Login | SarysShop</title>
  <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/css/login.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/css/main.css" rel="stylesheet">
</head>

<body>
  <!-- CSRF token -->
  <?= csrf_field() ?>
  <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
      <div class="row d-flex">
        <div class="col-lg-6">
          <div class="card1 pb-5">
            <div class="row">
              <img src="<?= base_url(); ?>/assets/images/web-logo.png" class="logo" style="transform: scale(.85);">
            </div>
            <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
              <img src="https://i.imgur.com/uNGdWHi.png" class="image">
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center">
          <form id="form-data" autocomplete="off">
            <div class="card2 card border-0 px-4 py-5">
              <div class="form-group">
                <label class="mb-1">
                  <h6 class="mb-0">Email</h6>
                </label>
                <div class="input-group mb-3">
                  <span class="input-group-text fs-2" id="email-desc"><i class="ti-user"></i></span>
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Masukkan Email" aria-label="Masukkan Email" aria-describedby="email-desc" autofocus>
                </div>
              </div>
              <div class="form-group">
                <label class="mb-1">
                  <h6 class="mb-0">Password</h6>
                </label>
                <div class="input-group mb-3">
                  <span class="input-group-text fs-2" id="password-desc"><i class="ti-lock"></i></span>
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Masukkan Password" aria-label="Masukkan Password" aria-describedby="password-desc">
                </div>
              </div>
              <div class="row mb-3 px-3 my-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-color fs-5">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="bg-primary text-white py-4">
        <div class="row px-3">
          <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2022. All rights reserved.</small>
        </div>
      </div>
    </div>
  </div>

  <script defer="defer" src="<?= base_url(); ?>/assets/js/main.js"></script>
  <script defer="defer" src="<?= base_url(); ?>/assets/vendors/jquery/jquery.min.js"></script>
  <script defer="defer" src="<?= base_url(); ?>/assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
  <script defer="defer" src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script defer="defer" src="<?= base_url(); ?>/js/core/global.js?v<?= rand() ?>"></script>

  <script defer="defer" src="<?= base_url(); ?>/js/login/index.js?v<?= rand() ?>"></script>
</body>

</html>
