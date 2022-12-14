<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
  <title><?php echo $title ?></title>

  <?php echo $this->include('layouts/css') ?>

  <?php echo $this->renderSection('page-css') ?>
</head>

<body class="app">
  <!-- <div id="loader"> -->
  <!--   <div class="spinner"></div> -->
  <!-- </div> -->
  <div class="wrapper">
    <div>
      <?php echo $this->include('layouts/sidebar') ?>
      <div class="page-container">
        <?php echo $this->include('layouts/navbar') ?>
        <main class="main-content bgc-grey-100">
          <!-- CSRF token -->
          <?php echo csrf_field() ?>
          <div id="mainContent">
            <?php echo $this->renderSection('page-header') ?>
            <?php echo $this->renderSection('page-content') ?>
          </div>
        </main>
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2021 Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span></footer>
      </div>
    </div>

    <?php echo $this->include('layouts/loading') ?>
    <?php echo $this->include('layouts/js') ?>

    <?php echo $this->renderSection('page-js') ?>
</body>

</html>
