<?php echo $this->extend('layouts/layout'); ?>

<?php echo $this->section('page-content') ?>
<div class="card bg-transparent" id="card-table">
  <div class="card-header bg-transparent">
    <h1>Order</h1>
    <div class="card-tools">
      <button class="btn btn-info" id="btn-new"><i class="fa fa-plus"></i> Tambah Order</button>
    </div>
  </div>

  <?php echo $this->include('order/components/tab-header') ?>
  <?php echo $this->include('order/components/tab-content') ?>
</div>

<?php echo $this->include('order/form') ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('page-js') ?>
<script src="<?php echo base_url() ?>/js/order/form.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-produk.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-pelanggan.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-penerima.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-pembayaran.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-order.js?v=<?php echo rand() ?>"></script>
<?php echo $this->endSection() ?>
