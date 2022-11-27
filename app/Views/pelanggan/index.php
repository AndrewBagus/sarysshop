<?php echo $this->extend('layouts/layout'); ?>

<?php echo $this->section('page-content') ?>
<div class="card" id="card-table">
  <div class="card-header">
    <h1>Master Data Pelanggan</h1>
    <div class="card-tools">
      <button type="button" class="btn btn-outline-info" id="btn-filter" data-bs-toggle="tooltip" data-bs-title="Filter Data" style="margin-right: 0.5rem;">
        <i class="fa fa-search"></i> Filter
      </button>
      <button type="button" class="btn btn-outline-primary mt-1 mt-lg-0" id="btn-new" data-bs-toggle="tooltip" data-bs-title="Tambah Data">
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
            <th> Kategori </th>
            <th> Telepon </th>
            <th> Alamat </th>
            <th data-priority="1"> Aksi </th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?php echo $this->include('pelanggan/form') ?>
<?php echo $this->include('pelanggan/form-filter') ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('page-js') ?>
<script src="<?php echo base_url() ?>/js/pelanggan/index.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/pelanggan/filter.js?v=<?php echo rand() ?>"></script>
<script src="<?php echo base_url() ?>/js/pelanggan/form.js?v=<?php echo rand() ?>"></script>
<?php echo $this->endSection() ?>
