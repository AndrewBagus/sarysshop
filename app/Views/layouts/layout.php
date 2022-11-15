<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
  <title><?= $title ?></title>

  <?= $this->include('layouts/css') ?>

  <?= $this->renderSection('page-css') ?>
</head>

<body class="app">
  <div id="loader">
    <div class="spinner"></div>
  </div>
  <div class="wrapper">
    <div>
      <?= $this->include('layouts/sidebar') ?>
      <div class="page-container">
        <?= $this->include('layouts/navbar') ?>
        <main class="main-content bgc-grey-100">
          <!-- CSRF token -->
          <?= csrf_field() ?>
          <div id="mainContent">
            <?= $this->renderSection('page-header') ?>
            <?= $this->renderSection('page-content') ?>
          </div>
        </main>
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2021 Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span></footer>
      </div>
    </div>

    <?= $this->include('layouts/loading') ?>
    <?= $this->include('layouts/js') ?>

    <?= $this->renderSection('page-js') ?>
</body>

</html>
