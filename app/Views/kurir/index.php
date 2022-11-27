<?php echo $this->extend('layouts/layout'); ?>

<?php echo $this->section('page-content') ?>
<div class="card" id="card-table">
  <div class="card-header">
    <h1>Master Data Kurir</h1>
    <div class="card-tools">
      <button type="button" class="btn btn-outline-primary" id="btn-new" data-bs-toggle="tooltip" data-bs-title="Tambah Data">
        <i class="fa fa-plus"></i> Tambah Data
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="table-list" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th> No </th>
            <th> Nama </th>
            <th> Layanan Pengiriman </th>
            <th data-priority="1"> Aksi </th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?php echo $this->include('kurir/form') ?>
<?php echo $this->include('kurir/form-layanan') ?>
<?php echo $this->include('kurir/table-layanan') ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('page-js') ?>
<script src="<?php echo base_url() ?>/js/kurir/index.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/kurir/form.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/kurir/form-layanan.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/kurir/table-layanan.js?v=<?php echo rand() ?>"></script>
<?php echo $this->endSection() ?>
