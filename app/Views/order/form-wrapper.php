<div class="modal" id="modal-wrapper" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Form <span id="wrapper-title"></span></h3>
      </div>
      <form id="form-wrapper" autocomplete="off">
        <input type="hidden" id="wrapper-index">
        <input type="hidden" id="wrapper-type">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="wrapper-name">Nama</label>
                <input type="text" class="form-control" id="wrapper-name" name="wrapper_name" placeholder="Nama">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="wrapper-nominal">Biaya</label>
                <div class="input-group">
                  <select class="form-select" id="nominal-type">
                    <option value="nominal" selected>Rp.</option>
                    <option value="percen">%</option>
                  </select>
                  <input type="text" class="form-control d-none thousand" id="wrapper-percen" name="wrapper_percen" placeholder="0" value="0" onkeypress="return isNumber(event)">
                  <input type="text" class="form-control thousand" id="wrapper-nominal" name="wrapper_nominal" placeholder="0" value="0" onkeypress="return isNumber(event)">
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
