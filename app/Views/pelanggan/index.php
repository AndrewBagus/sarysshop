<?= $this->extend('layouts/layout'); ?>

<?= $this->section('page-content') ?>
<div class="card" id="card-table">
  <div class="card-header">
    <h1>Master Data Pelanggan</h1>
    <div class="card-tools">
      <button type="button" class="btn btn-outline-info" id="btn-filter" data-bs-toggle="tooltip" data-bs-title="Filter Data">
        <i class="fa fa-search"></i> Filter Data
      </button>

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
            <th> Kategori </th>
            <th> Telepon </th>
            <th> Alamat </th>
            <th> Aksi </th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?= $this->include('pelanggan/form') ?>
<?= $this->include('pelanggan/form-filter') ?>
<?= $this->endSection() ?>

<?= $this->section('page-js') ?>
<script src="<?= base_url() ?>/js/pelanggan/index.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/pelanggan/filter.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/pelanggan/form.js?v=<?= rand() ?>"></script>
<?= $this->endSection() ?>
