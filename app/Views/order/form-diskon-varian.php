<div class="modal" id="modal-diskon-varian" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Diskon</h3>
      </div>
      <form id="form-diskon-varian" autocomplete="off">
        <input type="hidden" class="form-control" id="diskon-varian-index" readonly>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <label class="form-label" for="diskon-varian-nama">Nama Produk</label>
                <p class="form-control" id="diskon-varian-nama"></p>
              </div>

              <div class="form-group">
                <label class="form-label" for="diskon-varian">Diskon</label>
                <div class="input-group">
                  <select class="form-select" id="diskon-varian" style="flex-grow: 0; width: 5rem;">
                    <option value="nominal" selected>Rp.</option>
                    <option value="percen">%</option>
                  </select>
                  <input type="text" class="form-control d-none thousand" id="diskon-varian-percen" name="diskon_varian_percen" placeholder="0" value="0" onkeypress="return isNumber(event)">
                  <input type="text" class="form-control thousand" id="diskon-varian-nominal" name="diskon_varian_nominal" placeholder="0" value="0" onkeypress="return isNumber(event)">
                </div>

              </div>

            </div>
            <div class="col-md-6">

              <div class="form-group">
                <label class="form-label" for="diskon-varian-harga-awal">Harga Awal</label>
                <p class="form-control" id="diskon-varian-harga-awal"></p>
              </div>

              <div class="form-group">
                <label class="form-label" for="diskon-varian-harga-akhir">Harga Akhir</label>
                <p class="form-control" id="diskon-varian-harga-akhir"></p>
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
