<div class="card d-none" id="card-form-supplier">
  <div class="card-header">
    <h1>Tambah Supplier</h1>
  </div>
  <form id="form-supplier" autocomplete="off">
    <div class="card-body">
      <div class="row" style="padding-left: 0; padding-right: 0;">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="nama-supplier">Nama Supplier</label>
            <input type="text" class="form-control" id="nama-supplier" name="nama" placeholder="Nama Lengkap">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
        <div class="col-md-7">
          <div class="form-group">
            <label class="form-label" for="kelurahan-supplier">Kota/Kecamatan</label>
            <select class="form-control" id="kelurahan-supplier" name="kelurahan_id" data-placeholder="Kota/Kecamatan" style="width: 100%;"></select>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label class="form-label" for="kode-pos-supplier">Kode Pos</label>
            <input type="text" class="form-control" id="kode-pos-supplier" name="kode_pos" placeholder="Kode Pos" onkeypress="return isNumber(event)">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
        <div class="col-md-5">
          <div class="form-group">
            <label class="form-label" for="telp-supplier">No. Hp / Telepon</label>
            <input type="text" class="form-control" id="telp-supplier" name="telp" placeholder="No. Hp / Telepon" onkeypress="return isNumber(event)">
          </div>
        </div>
        <div class="col-md-7">
          <div class="form-group">
            <label class="form-label" for="email-supplier">Email</label>
            <input type="email" class="form-control" id="email-supplier" name="email" placeholder="Email">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="alamat-supplier">Alamat</label>
            <textarea class="form-control" id="alamatLengkap" name="alamat" placeholder="Alamat" rows="4"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-danger" id="btn-back-supplier"><i class="fa fa-arrow-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>

