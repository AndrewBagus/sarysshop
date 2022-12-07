<div class="modal" id="modal-penerimaan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Form Penerimaan Transaksi: <span id="penerimaan-title"></span></h3>
      </div>
      <form id="form-penerimaan" autocomplete="off">
        <div class="modal-body">
          <input type="hidden" id="penerimaan-id" value="0" readonly>

          <div class="form-group">
            <label class="form-label" for="penerimaan-kurir">Kurir</label>
            <p class="form-control" id="penerimaan-kurir" data-placeholder="Kurir"></p>
          </div>

          <div class="form-group mt-3">
            <label class="form-label" for="penerimaan-resi">Resi Pengiriman</label>
            <p class="form-control" id="penerimaan-resi" data-placeholder="Resi Pengiriman"></p>
          </div>

          <div class="form-group mt-3">
            <label class="form-label" for="penerimaan-pengiriman">Tanggal Pengiriman</label>
            <p class="form-control" id="penerimaan-pengiriman" data-placeholder="Tanggal Pengiriman"></p>
          </div>

          <div class="form-group mt-3">
            <label class="form-label" for="penerimaan-tgl">Tanggal Penerimaan</label>
            <div class="input-group">
              <input type="text" class="form-control" id="penerimaan-tgl" name="penerimaan_tgl" data-toggle="datetimepicker" data-target="#penerimaan-tgl" placeholder="Tanggal Pengiriman" style="border-right: 0;">
              <span class="input-group-text bg-transparent" style="border-left: 0;"><i class="ti-calendar text-muted"></i></span>
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
