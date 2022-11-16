<?= $this->extend('layouts/layout'); ?>

<?= $this->section('page-content') ?>
<div class="card" id="card-table">
  <div class="card-header">
    <h1>Master Data Gudang</h1>
    <div class="card-tools">
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
            <th> Telepon </th>
            <th> Alamat </th>
            <th> Admin </th>
            <th data-priority="1"> Aksi </th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?= $this->include('gudang/form') ?>
<?= $this->include('gudang/form-admin') ?>
<?= $this->endSection() ?>

<?= $this->section('page-js') ?>
<script src="<?= base_url() ?>/js/gudang/index.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/gudang/form.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/gudang/section-admin.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/gudang/form-admin.js?v=<?= rand() ?>"></script>
<?= $this->endSection() ?>
