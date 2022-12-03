<div class="modal" id="modal-edit-varian" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Edit Produk</h3>
      </div>
      <form id="form-edit-varian" autocomplete="off">
        <input type="hidden" class="form-control" id="edit-varian-index" readonly>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="edit-varian-nama">Nama Produk</label>
                <p class="form-control" id="edit-varian-nama"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="edit-varian-qty">Qty</label>
                <div class="input-group">
                  <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-produk-min"><i class="fa fa-minus"></i></button>
                  <input type="number" class="form-control" id="edit-varian-qty" name="edit_varian_qty" min="1" max="1000" value="1">
                  <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-produk-plus"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
