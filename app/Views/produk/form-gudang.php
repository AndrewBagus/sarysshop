<div class="card d-none" id="card-form-gudang">
  <div class="card-header">
    <h1>Tambah Gudang</h1>
  </div>
  <form id="form-gudang" autocomplete="off">
    <div class="card-body">
      <div class="row" style="padding-left: 0; padding-right: 0;">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="nama-gudang">Nama </label>
            <input type="text" class="form-control" id="nama-gudang" name="nama" placeholder="Nama Lengkap">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
        <div class="col-md-7">
          <div class="form-group">
            <label class="form-label" for="kelurahan-gudang">Kota/Kecamatan</label>
            <select class="form-control" id="kelurahan-gudang" name="kelurahan_id" data-placeholder="Kota/Kecamatan" style="width: 100%;"></select>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label class="form-label" for="kode-pos-gudang">Kode Pos</label>
            <input type="text" class="form-control" id="kode-pos-gudang" name="kode_pos" placeholder="Kode Pos" onkeypress="return isNumber(event)">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="telp-gudang">No. Hp / Telepon</label>
            <input type="text" class="form-control" id="telp-gudang" name="telp" placeholder="No. Hp / Telepon" onkeypress="return isNumber(event)">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem; margin-bottom: 1.5rem;">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="alamat-gudang">Alamat</label>
            <textarea class="form-control" id="alamat-gudang" name="alamat" placeholder="Alamat" rows="4"></textarea>
          </div>
        </div>
      </div>
      <?= $this->include('gudang/components/section-admin') ?>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-danger" id="btn-back-gudang"><i class="fa fa-arrow-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
