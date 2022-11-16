<div class="card d-none" id="card-form">
  <div class="card-header">
    <h1><span id="title-form"></span> Gudang</h1>
  </div>
  <form id="form-data" autocomplete="off">
    <div class="card-body">
      <input type="hidden" class="form-control" id="id" name="id" value="" readonly>
      <div class="row" style="padding-left: 0; padding-right: 0;">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="nama">Nama </label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
        <div class="col-md-7">
          <div class="form-group">
            <label class="form-label" for="kelurahan">Kota/Kecamatan</label>
            <select class="form-control" id="kelurahan" name="kelurahan_id" data-placeholder="Kota/Kecamatan" style="width: 100%;"></select>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label class="form-label" for="kode-pos">Kode Pos</label>
            <input type="text" class="form-control" id="kode-pos" name="kode_pos" placeholder="Kode Pos" onkeypress="return isNumber(event)">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="telp">No. Hp / Telepon</label>
            <input type="text" class="form-control" id="telp" name="telp" placeholder="No. Hp / Telepon" onkeypress="return isNumber(event)">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem; margin-bottom: 1.5rem;">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="4"></textarea>
          </div>
        </div>
      </div>
      <?= $this->include('gudang/components/section-admin') ?>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-danger" id="btn-back"><i class="fa fa-arrow-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
