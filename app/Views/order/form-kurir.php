<div class="modal" id="modal-kurir" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Form Kurir</h3>
      </div>
      <form id="form-kurir" autocomplete="off">
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label" for="kurir">Kurir</label>
            <select class="form-control select2bs5" id="kurir" name="kurir_id" data-placeholder="Pilih Kurir" style="width: 100%;"></select>
          </div>
          <div class="form-group mt-3">
            <label class="form-label" for="kurir-biaya">Biaya</label>
            <input type="text" class="form-control thousand" id="kurir-biaya" name="biaya_kurir" placeholder="0" value="0" onkeypress="return isNumber(event)">
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
