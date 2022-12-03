<div class="modal" id="modal-pembayaran" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Form Pembayaran</h3>
      </div>
      <form id="form-pembayaran" autocomplete="off">
        <input type="hidden" id="pembayaran-id" value="0" readonly>
        <input type="hidden" id="pembayaran-index" readonly>
        <div class="modal-body">

          <div class="form-group">
            <label class="form-label" for="bank">Bank</label>
            <select class="form-control bank-pembayaran" id="bank" name="bank_id" data-placeholder="Pilih Bank" style="width: 100%;"></select>
          </div>

          <div class="form-group mt-3">
            <label class="form-label" for="tgl-bayar">Tanggal Pembayaran</label>
            <div class="input-group">
              <input type="text" class="form-control" id="tgl-bayar" name="tanggal_pembayaran" data-toggle="datetimepicker" data-target="#tgl-bayar" placeholder="Tanggal Pembayaran" style="border-right: 0;">
              <span class="input-group-text bg-transparent" style="border-left: 0;"><i class="ti-calendar text-muted"></i></span>
            </div>
          </div>

          <div class="form-group mt-3">
            <label class="form-label" for="nominal">Nominal</label>
            <input type="text" class="form-control thousand" id="nominal" name="nominal" placeholder="0" onkeypress="return isNumber(event)">
          </div>

          <div class="form-group mt-3">
            <label class="form-label" for="pembayaran-keterangan">Keterangan</label>
            <textarea class="form-control" id="pembayaran-keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
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
