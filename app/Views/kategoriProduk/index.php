<?= $this->extend('layouts/layout'); ?>

<?= $this->section('page-content') ?>
<div class="card" id="card-table">
  <div class="card-header">
    <h1>Master Data Kategori Produk</h1>
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
            <th data-priority="1"> Aksi </th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?= $this->include('kategoriProduk/form') ?>
<?= $this->endSection() ?>

<?= $this->section('page-js') ?>
<script src="<?= base_url() ?>/js/kategoriProduk/index.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/kategoriProduk/form.js?v=<?= rand() ?>"></script>
<?= $this->endSection() ?>
