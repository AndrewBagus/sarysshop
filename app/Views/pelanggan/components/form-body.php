<div class="card-body">
  <div class="row" style="padding-left: 0; padding-right: 0;">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-label" for="kategori-pelanggan">Kategori Pelanggan</label>
        <select class="form-control select2bs5-nonclear" id="kategori-pelanggan" name="kategori_pelanggan_id" data-placeholder="Kategori Pelanggan" style="width: 100%;"></select>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <label class="form-label" for="nama">Nama Lengkap</label>
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
    <div class="col-md-5">
      <div class="form-group">
        <label class="form-label" for="telp">No. Hp / Telepon</label>
        <input type="text" class="form-control" id="telp" name="telp" placeholder="No. Hp / Telepon" onkeypress="return isNumber(event)">
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
      </div>
    </div>
  </div>
  <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
    <div class="col-md-12">
      <div class="form-group">
        <label class="form-label" for="alamat">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="4"></textarea>
      </div>
    </div>
  </div>
</div>
