<div class="card d-none" id="card-form">
  <div class="card-header">
    <h1><span id="title-form"></span> Produk</h1>
  </div>
  <form id="form-data" autocomplete="off">
    <div class="card-body">
      <?= $this->include('produk/components/form-header') ?>
      <?= $this->include('produk/components/table-varian') ?>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-danger" id="btn-back"><i class="fa fa-arrow-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
