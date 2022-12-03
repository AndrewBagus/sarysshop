<div class="col-md-4" style="position: relative;">
  <div class="card">
    <div class="card-header">
      <h3>Pelanggan</h3>
    </div>
    <div class="card-body">

      <div class="form-group">
        <label class="form-label" for="pemesan">Nama Pemesan</label>
        <input type="hidden" class="form-control" id="kategori-pelanggan">
        <div class="input-group">
          <select class="form-control select2bs5" id="pemesan" name="pelanggan_id" data-placeholder="Nama Pemesan"></select>
          <button type="button" id="btn-add-pemesan" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tambah Pelanggan jika tidak ada di list"><i class="fa fa-plus"></i> </button>
        </div>
        <div id="pemesan-alamat"></div>
      </div>

      <div class="form-group mt-3">
        <label class="form-label" for="penerima">Dikirim Kepada</label>
        <div class="input-group">
          <select class="form-control select2bs5" id="penerima" name="pelanggan_kirim" data-placeholder="Dikirim Kepada"></select>
          <button type="button" id="btn-add-penerima" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tambah Pelanggan jika tidak ada di list"><i class="fa fa-plus"></i> </button>
        </div>
        <div id="penerima-alamat"></div>
      </div>

      <div class="form-group mt-3">
        <label class="form-label" for="tgl-order">Tanggal Order</label>
        <div class="input-group">
          <input type="text" class="form-control" id="tgl-order" name="tgl_order" placeholder="Tanggal Order" data-toggle="datetimepicker" data-target="#tgl-order">
          <span class="input-group-text bg-transparent" style="border-left: 0;"><i class="ti-calendar text-muted"></i></span>
        </div>
      </div>

      <div class="form-group mt-3">
        <label class="form-label" for="keterangan">Keterangan</label>
        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
      </div>

    </div>
  </div>
</div>
