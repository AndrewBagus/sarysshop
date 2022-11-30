<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3>Pembayaran</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">

          <div class="form-group">
            <label class="form-label" for="status-pembayaran">Status Pembayaran</label>
            <select class="form-control select2bs5-nonclear" id="status-pembayaran" name="status_pembayaran" data-placeholder="Status Pembayaran" style="width: 100%;">
              <option value="belum-bayar">Belum Dibayar</option>
              <option value="cicilan">Cicilan</option>
              <option value="lunas">Sudah Bayar (Lunas)</option>
            </select>
          </div>

          <div class="form-group mt-3 d-none belum-bayar-hide lunas-show">
            <label class="form-label" for="bank">Bank</label>
            <select class="form-control" id="bank" name="bank_id" data-placeholder="Pilih Bank" style="width: 100%;"></select>
          </div>
        </div>

        <div class="col-md-6">

          <div class="form-group mt-3 mt-md-0 mt-lg-0 mt-xl-0 d-none belum-bayar-hide lunas-show">
            <label class="form-label" for="tgl-bayar">Tanggal Pembayaran</label>
            <div class="input-group">
              <input type="text" class="form-control" id="tgl-bayar" name="tanggal_pembayaran" data-toggle="datetimepicker" data-target="#tgl-bayar" placeholder="Tanggal Pembayaran" style="border-right: 0;">
              <span class="input-group-text bg-transparent" style="border-left: 0;"><i class="ti-calendar text-muted"></i></span>
            </div>
          </div>

          <div class="form-group mt-3 d-none belum-bayar-hide">
            <label class="form-label" for="nominal">Nominal</label>
            <input type="text" class="form-control thousand" id="nominal" name="nominal" placeholder="0" onkeypress="return isNumber(event)">
          </div>

        </div>

      </div>

    </div>
  </div>
</div>
