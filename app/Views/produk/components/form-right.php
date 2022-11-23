<div class="col-md-6">
  <div class="form-group">
    <label class="form-label" for="jenis-produk">Jenis Produk</label>
    <select class="form-control select2bs5" id="jenis-produk" name="jenis_produk_id" data-placeholder="Jenis Produk"></select>
  </div>
  <div class="form-group mt-3">
    <label class="form-label" for="tempo-kedatangan">Tempo Kedatangan</label>
    <div class="input-group">
      <input type="text" class="form-control thousand" id="tempo-kedatangan" name="tempo_kedatangan" placeholder="0" onkeypress="return isNumber(event)">
      <span class="input-group-text">Hari</span>
    </div>
  </div>
  <div class="form-group mt-3">
    <label class="form-label" for="gudang">Gudang</label>
    <div class="input-group">
      <select class="form-control select2bs5" id="gudang" name="gudang_id" data-placeholder="Gudang"></select>
      <button type="button" id="btn-add-gudang" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tambah Gudang jika tidak ada di list"><i class="fa fa-plus"></i> </button>
    </div>
  </div>
</div>
