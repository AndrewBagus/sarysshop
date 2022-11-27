<div class="modal" id="modal-layanan" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">List Layanan<span id="layanan-title"></span></h3>
      </div>
      <form id="form-layanan" autocomplete="off">
        <div class="modal-body">
          <input type="hidden" class="form-control" id="layanan-id" name="id">
          <input type="hidden" class="form-control" id="layanan-index">
          <div class="form-group">
            <label class="form-label" for="nama">Nama Layanan</label>
            <input type="text" class="form-control" id="layanan-nama" name="nama" placeholder="Nama Layanan">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
