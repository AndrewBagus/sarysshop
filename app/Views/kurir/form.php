<div class="card d-none" id="card-form">
  <div class="card-header">
    <h1><span id="title-form"></span> Kurir</h1>
  </div>
  <form id="form-data" autocomplete="off">
    <div class="card-body">
      <input type="hidden" class="form-control" id="id" name="id" value="" readonly>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group" style="text-align: center;">
            <h5>Logo Kurir</h5>
            <img id="image-display" src="<?php echo base_url('/assets/images/kurir.jpg') ?>" class="image-uploader image-thumbnail" accept="image/png, image/jpg, image/jpeg">
            <input type="file" class="form-control" id="image" name="image" style="display: none" />
          </div>
        </div>
        <div class="col-md-9">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="nama">Nama Kurir</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kurir">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="kategori">Kategori Layanan</label>
                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori Layanan">
              </div>
            </div>

            <div class="col-md-12 mt-3">
              <div class="form-group">
                <label class="form-label" for="eta-awal">Estimasi Pengiriman (Hari)</label>
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="eta-awal" name="eta_awal" placeholder="Estimasi Awal" onkeypress="return isNumber(event)">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="eta-akhir" name="eta_akhir" placeholder="Estimasi Akhir" onkeypress="return isNumber(event)">
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-danger" id="btn-back"><i class="fa fa-arrow-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
