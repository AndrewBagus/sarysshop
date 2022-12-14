<?php echo $this->extend('layouts/layout'); ?>

<?php echo $this->section('page-content') ?>
<div class="card bg-transparent" id="card-table">
  <div class="card-header bg-transparent">
    <h1>Order</h1>
    <div class="card-tools">
      <button class="btn btn-info" id="btn-new"><i class="fa fa-plus"></i> Tambah Order</button>
    </div>
  </div>

  <input type="hidden" class="form-control" id="table-status" value="<?php echo $page ?>" readonly>
  <?php echo $this->include('order/components/tab-header') ?>
  <?php echo $this->include('order/components/tab-content') ?>
</div>

<?php echo $this->include('order/form') ?>
<?php echo $this->include('order/form-kurir') ?>
<?php echo $this->include('order/form-pembayaran') ?>
<?php echo $this->include('order/form-wrapper') ?>
<?php echo $this->include('order/form-diskon-varian') ?>
<?php echo $this->include('order/form-edit-varian') ?>
<?php echo $this->include('order/form-pengiriman') ?>
<?php echo $this->include('order/form-penerimaan') ?>
<?php echo $this->include('order/view-produk') ?>
<?php echo $this->include('order/view-pembayaran') ?>
<?php echo $this->include('order/view-pengiriman') ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('page-js') ?>
<script src="<?php echo base_url() ?>/js/order/index.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-produk.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-pelanggan.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-penerima.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-pembayaran.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-order.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-kurir.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-wrapper.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-grand.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-diskon-varian.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-edit-varian.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-pengiriman.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/form-penerimaan.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/view-produk.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/order/view-pembayaran.js?v=<?php echo rand() ?>"></script>
<?php echo $this->endSection() ?>
