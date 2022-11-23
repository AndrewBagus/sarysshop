<div class="modal" id="modal-varian" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><span id="varian-title"></span> Produk Varian</h3>
      </div>
      <form id="form-varian" autocomplete="off">
        <div class="modal-body row">
          <input type="hidden" class="form-control" id="varian-id" name="id" readonly>
          <input type="hidden" class="form-control" id="varian-index" readonly>
          <div class="col-md-2">
            <div class="form-group" style="text-align: center;">
              <h5>Thumbnail</h5>
              <img id="image-varian-display" src="<?= base_url('/assets/images/add-image.png') ?>" class="image-uploader image-thumbnail" accept="image/png, image/jpg, image/jpeg">
              <input type="file" class="form-control" id="image-varian" name="image_varian" style="display: none" />
            </div>
          </div>
          <div class="col-md-10">

            <div class="row mt-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label" for="sku">SKU</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="sku" name="code" placeholder="SKU">
                    <button type="button" id="btn-random-sku" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Random SKU"><i class="fa fa-sync"></i> </button>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label" for="berat">Berat (gram)</label>
                  <div class="input-group">
                    <input type="text" class="form-control thousand" id="berat" name="berat" placeholder="0" onkeypress="return isNumber(event)">
                    <span class="input-group-text">gr</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label" for="ukuran">Ukuran</label>
                  <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="Ukuran">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label" for="warna">Warna</label>
                  <input type="text" class="form-control" id="warna" name="warna" placeholder="Warna">
                </div>
              </div>
              <div class="col-md-12 mt-2">
                <div class="form-group">
                  <label class="form-label" for="stok">Stok</label>
                  <input type="text" class="form-control thousand" id="stok" name="stok" placeholder="0" onkeypress="return isNumber(event)">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-varian-wrapper" id="form-varian-left"></div>
              <div class="col-md-6 form-varian-wrapper" id="form-varian-right"></div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
