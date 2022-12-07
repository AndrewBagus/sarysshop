<div class="modal" id="modal-pengiriman" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Form Pengiriman Transaksi: <span id="pengiriman-title"></span></h3>
      </div>
      <form id="form-pengiriman" autocomplete="off">
        <div class="modal-body">
          <input type="hidden" id="pengiriman-id" value="0" readonly>

          <div class="form-group">
            <label class="form-label" for="pengiriman-kurir">Kurir</label>
            <p class="form-control" id="pengiriman-kurir" data-placeholder="Kurir"></p>
          </div>

          <div class="form-group mt-3">
            <label class="form-label" for="pengiriman-resi">Resi Pengiriman</label>
            <input type="text" class="form-control" id="pengiriman-resi" name="pengiriman_resi" placeholder="Resi Pengiriman">
          </div>

          <div class="form-group mt-3">
            <label class="form-label" for="pengiriman-tgl">Tanggal Pengiriman</label>
            <div class="input-group">
              <input type="text" class="form-control" id="pengiriman-tgl" name="pengiriman_tgl" data-toggle="datetimepicker" data-target="#pengiriman-tgl" placeholder="Tanggal Pengiriman" style="border-right: 0;">
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
