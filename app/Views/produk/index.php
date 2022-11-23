<?= $this->extend('layouts/layout'); ?>

<?= $this->section('page-content') ?>
<div class="card" id="card-table">
  <div class="card-header">
    <h1>Daftar Produk</h1>
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
            <th> Produk </th>
            <th> Supplier </th>
            <th> Stok </th>
            <th> Varian </th>
            <th> Kategori </th>
            <th> Jenis </th>
            <th> Tempo Kedatangan</th>
            <th data-priority="1"> Aksi </th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?= $this->include('produk/form') ?>
<?= $this->include('produk/form-varian') ?>
<?= $this->include('produk/form-supplier') ?>
<?= $this->include('produk/form-kategori') ?>
<?= $this->include('produk/form-gudang') ?>
<?= $this->include('gudang/form-admin') ?>
<?= $this->endSection() ?>

<?= $this->section('page-js') ?>
<script src="<?= base_url() ?>/js/produk/index.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/produk/table-varian.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/produk/form.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/produk/form-supplier.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/produk/form-kategori.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/produk/form-gudang.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/gudang/section-admin.js?v=<?= rand() ?>"></script>
<script src="<?= base_url() ?>/js/gudang/form-admin.js?v=<?= rand() ?>"></script>
<?= $this->endSection() ?>
