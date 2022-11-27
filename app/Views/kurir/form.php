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
          <div class="form-group">
            <label class="form-label" for="nama">Nama Kurir</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kurir">
          </div>
        </div>
        <div class="col-md-12 mt-3">
          <div class="card" id="card-table">
            <div class="card-header">
              <h1>Layanan Pengiriman</h1>
              <div class="card-tools">
                <button type="button" class="btn btn-outline-primary" id="btn-new-layanan" data-bs-toggle="tooltip" data-bs-title="Tambah Layanan">
                  <i class="fa fa-plus"></i> Tambah Layanan
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table-layanan-list" class="table table-bordered table-hover" cellspacing="0" width="100%">
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
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-danger" id="btn-back"><i class="fa fa-arrow-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
